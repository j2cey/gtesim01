<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Adldap\Laravel\Facades\Adldap;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|string',//|email',
            'password' => 'required|string',
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate()
    {
        $this->ensureIsNotRateLimited();

        //if (Auth::attempt(['email' => $email, 'password' => $password, 'active' => 1])) {
        $input = $this->input();
        $username = explode('@', $input['email'])[0];

        // Get the user details from database and check if user is exist and active.
        if (filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
            $user = User::where('email',$input['email'])->first();
        } else {
            $user = User::where('username',$input['email'])->first();
        }

        if($user){
            if (!$user->isActive()) {
                throw ValidationException::withMessages([ 'email' => __('User has been desactivated.') ]);
            }
            if (!$user->is_ldap && !$user->is_local) {
                throw ValidationException::withMessages([ 'email' => __('User has no Connection Mode.') ]);
            }
        } else {
            throw ValidationException::withMessages([ 'email' => __('Infos de connexion non valides !') ]);
        }

        $credentials = [
            'username' => $user->username,
            'email' => $user->username . '' . config('app.ldap_domain'),
            'password' => $input['password']
        ];

        if ($user->is_ldap) {
            if ( $this->attemptLdap($credentials) ) {
                $this->saveLoginType($user,"ldap");
                Auth::login($user);
                // Update du PWD LDAP local
                $ldapaccount = $user->ldapaccount;
                $ldapaccount->password = Hash::make($credentials['password']);
                $ldapaccount->saveQuietly();

                //return redirect()->intended('/');
                // return redirect(session('url.intended'));
               RateLimiter::clear($this->throttleKey());
            }
        }

        // Or using the default guard you've configured, likely "users"
        if ($user->is_local) {
            // set password to local_password
            $user->switchLocalPassword();

            if (! Auth::attempt($this->only('email', 'password'), $this->filled('remember'))) {
                RateLimiter::hit($this->throttleKey());

                throw ValidationException::withMessages([
                    'email' => __('auth.failed'),
                ]);
            }

            RateLimiter::clear($this->throttleKey());
        }
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited()
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * @return string
     */
    public function throttleKey()
    {
        return Str::lower($this->input('email')).'|'.$this->ip();
    }

    private function attemptLdap($credentials) {
        try {
            Adldap::connect();
        } catch (\Exception $e) {
            // Can't connect.

            // By default, the timeout for connectivity is 5 seconds. A user
            // will have to wait this length of time if there is issues
            // connecting to your AD server. You can configure
            // this in your `config/adldap.php` file.

            // Try connect with ldap locally stored password
            //return Auth::guard('ldaplocal')->attempt($credentials);
            \Log::info("LDAP error: " . $e->getMessage() );
            throw ValidationException::withMessages([ 'email' => __('There is something wrong with LDAP.') ]);
        }
        return Auth::guard('ldap')->attempt($credentials);
    }

    private function saveLoginType($user, $login_type) {
        $user->login_type = $login_type;
        $user->saveQuietly();
    }
}
