<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*protected $request;
    function __construct(Request $request)
    {
        $this->request = $request;
    }*/
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

    /* public function existEmail(){

        $email = $this->request->input('email');
        $user = User::where('email', $email)
                ->first();

        $response = "";
        ($user) ? $response = "exsit" : $response = "not exist";

        return response()-> json([
            'response' => $response
        ]);


     }*/

}
