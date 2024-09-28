<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\Menu;
use App\Models\Privilege;

class AuthorizationService
{
    public function isAuthorized()
    {
        $user = Auth::guard('admin')->user();
        $is_superadmin = Role::find($user->type)->is_superadmin;

        if (!$is_superadmin) {
            $currentRoute = \Route::current()->getName();
            $routes = Menu::whereNotNull('route')->pluck('route')->toArray();

            if (in_array($currentRoute, $routes)) {
                $privileges = Privilege::join('menus', 'menus.id', '=', 'privileges.menu_id')
                    ->where('privileges.role_id', $user->type)
                    ->whereNotNull('menus.route')
                    ->pluck('menus.route')
                    ->toArray();
                // if (!in_array($currentRoute, $privileges)) {
                //     return redirect()->back()->with('alert', ['messageType' => 'danger', 'message' => 'Access denied!']);
                // }
            }
        }
    }

    public function hasMenuAccess($menu_id)
    {
        $user_role_id = Auth::guard('admin')->user()->type;
        $is_superadmin = Role::find($user_role_id)->is_superadmin;

        $privileges = Privilege::join('menus', 'menus.id', '=', 'privileges.menu_id')
            ->where('privileges.role_id', Auth::guard('admin')->user()->type)
            ->pluck('menu_id')->toArray();
        return $is_superadmin || in_array($menu_id, $privileges);
    }
}
