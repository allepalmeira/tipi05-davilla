<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\View\View;

class DashController extends Controller
{
    public function index(){


        return View('admin/dash/dashboard');


    }
}