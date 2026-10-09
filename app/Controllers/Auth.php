<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        // Already logged in? No need to see the form again.
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/sales/new');
        }

        return view('auth/login', ['title' => 'Staff Login', 'active' => 'login']);
    }

    public function attempt()
    {
        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $user = (new UserModel())
            ->where('username', $this->request->getPost('username'))
            ->first();

        // One generic message for "no such user" and "wrong password", so the
        // form doesn't reveal which usernames exist.
        if (! $user || ! password_verify((string) $this->request->getPost('password'), $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Invalid username or password.');
        }

        // New session ID after login prevents session fixation
        session()->regenerate();
        session()->set([
            'isLoggedIn' => true,
            'userId'     => (int) $user['id'],
            'username'   => $user['username'],
            'fullName'   => $user['full_name'],
        ]);

        return redirect()->to('/sales/new')->with('success', 'Welcome back, ' . $user['full_name'] . '.');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login')->with('success', 'You have been logged out.');
    }
}
