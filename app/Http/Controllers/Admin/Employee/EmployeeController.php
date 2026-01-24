<?php

namespace App\Http\Controllers\Admin\Employee;

use App\Http\Controllers\Controller;
class EmployeeController extends Controller
{
    public function __invoke()
    {
        return view("admin.employees.index");
    }
}
