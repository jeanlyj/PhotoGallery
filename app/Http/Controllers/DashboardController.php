<?php

namespace App\Http\Controllers;

use App\User;
use App\Gallery;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $galleries = Gallery::get();
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        return view('dashboard')->with('galleries', $user->galleries);
    }
}