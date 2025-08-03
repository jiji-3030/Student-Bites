<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class UserRoleController extends Controller
{
    public function promote(User $user): RedirectResponse
    {
        $user->role = 'admin';
        $user->save();

        return redirect()->route('admin.dashboard')->with('success', 'User promoted to admin.');
    }
}


