<?php

namespace App\Http\Controllers\Admin\Services;

use App\Http\Controllers\Controller;

class ListServicesController extends Controller
{
    public function __invoke()
    {
        return view('admin.services.index');
    }
}
