<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    function login(Request $req)
    {
$user= User::where(['email'=>$req->email])->first();
if (!$user || !Hash::check($req->password,$user->password)) {//If there is no information giuven by user and password not verified by hash value

    return "Username and password not matched";
    # code...
}
else{//here it goesa un else beacause there is no error
    $req->session()->put('user',$user);//an session is  crated 
    return redirect('/');//redirect to home page
}

    }

    function register(Request $req){

        $user =new User;//instance of user model
        $user->name=$req->name;
        $user->email=$req->email;
        $user->password=Hash::make($req->password);
        $user->save();
       return redirect('login');
    }
}
