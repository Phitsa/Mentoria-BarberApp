<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\View\View;

class LoginController
{
    public function __invoke(): View
    {
        return view('admin.auth.login');
    }
}
