<?php

namespace App\Http\Controllers\User;

use App\Enums\WebshopEnum;
use App\Http\Controllers\Controller;
use App\Models\Webshop;
use App\Services\Api\BolService;
use Illuminate\Http\Request;

class DashbaordController extends Controller
{
    public function dashboard()
    {
        return view('user.dashboard');
    }
}
