<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function login () {
        return view('user.login');
    }
    
    function do_login (Request $request) {
        $username = $request->username;
        if(!$username) {
            $error = "Tienes que escribir un nombre de usuario para iniciar sesión";
            return view('user.login', ['error' => $error]);
        }
        if(!User::check_user($username)) {
            $error = "Usuario incorrecto";
            return view('user.login', ['error' => $error]);
        }

        if(User::checkAttempts($username) >= 5) {
            $error = "Usuario bloqueado";
            return view('user.login', ['error' => $error]);
        }
        
        $user = User::get_user_by_username($username);
        if($user->role != "player") {
            return view('user.loginPassword', ['user' => $username]);
        }
        $request->session()->put('user', $user);
        return $this->redirectLogin($user);
    }

    function do_login_password(Request $request) {
        $username = $request->username;
        $password = $request->password;
        $user = User::get_user_password($username);
        
        if(!Hash::check($password, $user->password)) {
            User::addAtempt($username);
            $error = "Contraseña incorrecta";
            return view('user.login', ['error' => $error]);
        }
        $new_user = User::get_user_by_username($username);
        User::resetAttempts($username);
        $request->session()->put('user', $new_user);
        return $this->redirectLogin($new_user);
    }

    private function redirectLogin($user) {
        return view('user.view', ['user' => User::get_user_by_id($user->id), 'user_bios' => User::get_user_bio($user->id), 'notification' => ['type'=>"success" , 'message' =>"Hola, ".$user->name. " ". $user->surname. "!"]]);
    }

    function do_logoff(Request $request) {
        $request->session()->forget('user');
        return view('user.login', ['notification' => ['type'=>"info" , 'message' =>"Se ha cerrado la sessión!"]]);
    }

    function all () {
        return view('user.all', ['users' => User::get_users()]);
    }

    function view (Request $request) {
        return view('user.view', ['user' => User::get_user_by_id($request->id), 'user_bios' => User::get_user_bio($request->id)]);
    }

    function create (Request $request) {
        if(User::check_user($request->username)) {
            return response()->json(['message' => 'Ya existe un usuario con este nombre'], 409);
        }

        return User::create_user_admin($request->name,$request->surname,$request->username);
    }

    function edit (Request $request) {
        return view('user.view', ['user' => User::get_user_by_id($user_id)]);
    }

    function update ($user_id) {

    }

    function destroy (Request $request) {
        $role = $request->session()->get('user')->role;
        if($role != 'super' && $role != 'editor') return response()->json(['message' => 'No tienes permisos para eliminar usuarios'], 409);
        return User::drop_user($request->id);
    }

    function addBioToUser(Request $request, $id) {
        
        if(!User::create_user_bio($id, $request->title, $request->subtitle, $request->text)) {
            return response()->json(['message' => 'No se ha podido crear'], 409);
        }
        return true;
    }
}