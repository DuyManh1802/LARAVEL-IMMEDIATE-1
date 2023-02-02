<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use Exception;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $userService;

    public function __construct()
    {
        $this->middleware('auth');
        $this->userService = new UserService();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(Request $request)
    {
        try {
            $users = $this->userService->allUser($request);
        } catch (Exception $exception) {
            throw new Exception("Error Processing Request", 1);
        }

        return view('user.list', compact('users'));
    }
}