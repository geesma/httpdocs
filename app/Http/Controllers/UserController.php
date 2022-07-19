<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
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
        return redirect()->route('user.welcome')->with('status', ['type'=>"success" , 'message' =>"Hola, ".$user->name. " ". $user->surname. "!"]);
    }

    function do_logoff(Request $request) {
        $request->session()->forget('user');
        return view('user.login', ['notification' => ['type'=>"info" , 'message' =>"Se ha cerrado la sessión!"]]);
    }

    function all () {
        return view('user.all', ['users' => User::get_users()]);
    }

    function view (Request $request) {
        $user = User::find($request->id);
        $user_bios = User::get_user_bio($request->id);
        $user_leagues = User::get_user_temporades($user->id);
        return view('user.view', compact(['user','user_bios','user_leagues']));
    }

    function create (Request $request) {
        if(User::check_user($request->username)) {
            return response()->json(['message' => 'Ya existe un usuario con este nombre'], 409);
        }

        return User::create_user_admin($request->name,$request->surname,$request->username);
    }

    function edit ($user_id) {
        return view('user.edit', ['user' => User::find($user_id)]);
    }

    function update (Request $request, $user_id) {
        $validated = $request->validate([
            'nombre' => 'required|max:15',
            'apellido' => 'required|max:30',
            'profile_image' => 'required'
        ]);
        $user = User::find($user_id);
        if($request->username != $user->username) {
            $validated = $request->validate([
                'username' => 'required|unique:users|max:30'
            ]);
        }
        $user->name = $request->nombre;
        $user->surname = $request->apellido;
        $user->username = $request->username;
        $user->image = $request->profile_image;
        $user->save();
        return redirect()->route("user.view", ["id" => $user->id])->with('status', ['type'=>"success" , 'message' =>"El usuario ".$user->name. " ". $user->surname. " se ha actualizado correctamente"]);
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

    function removeBioToUser(Request $request, $id) {
        return User::delete_user_bio($id);;
    }

    function welcome(Request $request) {
        $user = $request->session()->get('user');
        $posts = Post::orderby('created_at', 'desc')->take(4)->get();
        $user_leagues = User::get_user_temporades($user->id);
        return view('user.welcome', compact(['user','posts','user_leagues']));
    }
}
