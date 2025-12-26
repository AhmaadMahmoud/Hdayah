<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
        * Display a listing of users.
        */
    public function index(): View
    {
        $users = User::orderBy('created_at', 'desc')->get();

        return view('dashboard.users.index', compact('users'));
    }

    /**
        * Update a user's role.
        */
    public function updateRole(Request $request, User $user): RedirectResponse
    {
        $data = $request->validate([
            'role' => ['required', 'in:user,admin'],
        ]);

        $user->update(['role' => $data['role']]);

        return back()->with('status', 'تم تحديث صلاحيات المستخدم.');
    }
}
