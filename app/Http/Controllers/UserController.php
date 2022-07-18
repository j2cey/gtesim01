<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Status;
use \Illuminate\View\View;
use App\Jobs\ManageUserActivated;
use Illuminate\Support\Collection;
use App\Http\Resources\UserResource;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;

use App\Http\Requests\User\FetchRequest;
use App\Http\Resources\SearchCollection;
use App\Http\Requests\User\UpdateUserRequest;
use Illuminate\Contracts\Foundation\Application;
use App\Repositories\Contracts\IUserRepositoryContract;

class UserController extends Controller
{
    /**
     * @var IUserRepositoryContract
     */
    private $repository;

    /**
     * UserController constructor.
     *
     * @param IUserRepositoryContract $repository [description]
     */
    public function __construct(IUserRepositoryContract $repository) {
        $this->repository = $repository;
    }

    /**
     * Display products page.
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View|View
     */
    public function index()
    {
        return view('users.index')
            ->with('perPage', new Collection(config('system.per_page')))
            ->with('defaultPerPage', config('system.default_per_page'));
    }

    /**
     * Fetch records.
     *
     * @param  FetchRequest     $request [description]
     * @return SearchCollection          [description]
     */
    public function fetch(FetchRequest $request): SearchCollection
    {
        return new SearchCollection(
            $this->repository->search($request), UserResource::class
        );
    }

    public function fetchall() {
        return User::all();
    }

    public function onlineusers() {
        $users = User::select("*")
            ->whereNotNull('last_seen')
            ->orderBy('last_seen', 'DESC')
            ->paginate(10);

        return view('users.online', compact('users'));
    }

    public function sendMail($id)
    {
        $user = User::where('id', $id)->first();

        $response = $user->sendMailAccountInfos();

        dd($response);
    }

    /**
     * [edit description]
     * @param  User $user [description]
     * @return Application|Factory|\Illuminate\Contracts\View\View|View
     */
    public function edit(User $user)
    {
        $user->load(['ldapaccount','status','roles']);
        return view('users.details')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param User $user
     * @return User
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $status_active = Status::active()->first();

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'is_local' => $request->is_local,
            'is_ldap' => $request->is_ldap,
        ]);

        // sync roles
        $user->syncRoles($request->roles);

        // set status
        $user->setStatus($request->status);

        // launch userActivated event
        if ( $request->status->code === $status_active->code ) {
            //\Log::info("ManageUserActivated dispatched : " . json_encode( $user ) );
            ManageUserActivated::dispatch($user);
        }

        return $user->load(['roles','status']);
    }

    /**
     * [destroy description]
     * @param  User          $user [description]
     * @return RedirectResponse          [description]
     * @throws Exception
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return new RedirectResponse(route('users'));
    }
}
