<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Status;
use \Illuminate\View\View;
use Illuminate\Http\Response;
use App\Jobs\ManageUserActivated;
use Illuminate\Support\Collection;
use App\Http\Resources\UserResource;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;

use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\User\FetchRequest;
use App\Http\Resources\SearchCollection;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\User\StoreUserRequest;
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
        $users = User::all()->load(['roles','status']);
        // TODO
        // make UserRessource collection lighter
        //$users = UserResource::collection($users);
        return $users;
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
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     * @return UserResource|Builder|Model|Response
     */
    public function store(StoreUserRequest $request)
    {
        $status_active = Status::active()->first();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'is_local' => $request->is_local,
            'is_ldap' => $request->is_ldap,
            'password' => bcrypt($request->password),
        ]);

        // sync roles
        $user->syncRoles($request->roles);

        // set status
        $user->setStatus($request->status);

        // launch userActivated event
        if ( $request->status->code === $status_active->code ) {
            ManageUserActivated::dispatch($user);
        }

        $user->load(['roles','status']);

        return new UserResource($user);
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
     * @return UserResource|User
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $status_active = Status::active()->first();
        $old_user = User::with('status')->where('id', $user->id)->first();

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
        if ( $old_user && $old_user->status->code !== $request->status->code && $request->status->code === $status_active->code ) {
            //\Log::info("ManageUserActivated dispatched : " . json_encode( $user ) );
            ManageUserActivated::dispatch($user);
        }

        $user->load(['roles','status']);

        return new UserResource($user);
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
