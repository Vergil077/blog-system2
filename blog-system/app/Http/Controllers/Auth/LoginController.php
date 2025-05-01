<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Routing\Controller; // Ensure the correct Controller class is imported
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller // تأكد من أنه يرث من Controller
{
    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}