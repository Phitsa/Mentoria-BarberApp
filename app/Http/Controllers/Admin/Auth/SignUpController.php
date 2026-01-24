<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\View\View;

class SignUpController
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Invoke the class instance.
     */
    public function __invoke(): View
    {
        return view('admin.auth.signup');
    }
}
