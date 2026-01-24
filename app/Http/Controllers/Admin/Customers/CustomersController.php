<?php

namespace App\Http\Controllers\Admin\Customers;

use App\Http\Controllers\Controller;

class CustomersController extends Controller
{
    public function __invoke()
    {
        return view("admin.customers.index");
    }
}
