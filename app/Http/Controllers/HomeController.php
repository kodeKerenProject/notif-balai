<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persyaratan_dalam_negeri;
use App\Persyaratan_luar_negeri;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $user = new User;
        return redirect($user->home());
    }
}
