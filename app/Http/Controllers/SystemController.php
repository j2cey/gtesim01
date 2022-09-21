<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Http\Controllers\Authorization\PermissionController;
use App\Models\User;
use App\Models\Status;
use App\Models\Setting;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\File;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class SystemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        $statuses = Status::all();
        $settings = Setting::whereNotNull('value')->get()->load('group');
        $settings_grouped = Setting::getAllGrouped();
        $permissions = (new PermissionController())->fetchall();
        $roles = Role::all()->load('permissions');
        $users = User::all()->load(['roles','status']);//UserResource::collection(User::all());

        return view('systems.index')
            ->with('statuses', $statuses)
            ->with('settings', $settings)
            ->with('settings_grouped', $settings_grouped)
            ->with('permissions', $permissions)
            ->with('roles', $roles)
            ->with('users', $users)
            ;
    }
}
