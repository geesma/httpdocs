<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, AuthenticableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'surname',
        'username',
        'image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function get_users() {
        return DB::table('users')->where('role', '!=', 'super')->get();
    }

    function get_user_by_username($user) {
        return DB::table('users')->select('id','name','surname','username','email','image','role')->where('username', $user)->first();
    }

    function get_user_by_id($id) {
        return DB::table('users')->select('id','name','surname','username','email','image','role')->where('id', $id)->first();
    }

    function get_user_password($user) {
        return DB::table('users')->select('username','password')->where('username', $user)->first();
    }

    function addAtempt($user) {
        $user = DB::table('users')->select('username','password')->where('username', $user)->increment('attemps', 1);
    }

    function checkAttempts($user) {
        $user = DB::table('users')->select('attemps')->where('username', $user)->first();
        return $user->attemps;
    }

    function resetAttempts($user) {
        DB::table('users')->where('username', $user)->update(['attemps' => 0]);
    }

    function check_user($user) {
        return DB::table('users')->where('username', $user)->exists();
    }

    function create_user_admin($name, $surname, $username) {
        return DB::table('users')->insertGetId(
            ['name' => $name, 'username' => $username, 'surname' => $surname]
        );
    }

    function drop_user($user_id) {
        return DB::table('users')->where('id', $user_id)->delete();
    }

    function get_user_bio($user_id) {
        return DB::table('user_bios')->where('user_id', $user_id)->get();
    }

    function create_user_bio($user_id, $title, $subtitle, $text) {
        return DB::table('user_bios')->insert([
            'user_id' => $user_id,
            'title' => $title,
            'subtitol' => $subtitle,
            'text' => $text
        ]);
    }

    function getSeaseonPoints() {
        return $this->id;
    }

    function delete_user_bio($id) {
        return DB::table('user_bios')->where('id', '=', $id)->delete();
    }

    static function getTemporadaLigaPlayers($temporada_id, $liga_id) {
        $users = DB::table('liga_temporada')->select(['id','name', 'surname', 'username', 'image'])->join('users', 'users.id', "=", 'liga_temporada.user_id')->where('temporada_id', '=', $temporada_id)->where('liga_id', '=', $liga_id)->get();
        return $users;
    }

    static function getAllUsers() {
        $users = DB::table('users')->select(['id','name', 'surname', 'username', 'image'])->where('role', '!=', 'super')->get();
        return $users;
    }

    static function getNotUsedUsers($temporada_id) {
        return DB::table('users')->where('role', '!=', 'super')->whereNotIn('id', function($query) use (&$temporada_id) {
            $query->select('user_id')->from('liga_temporada')->where('temporada_id', '=', $temporada_id);
        })->get();
    }

    static function getTemporadaLigaPlayersWithPoints($temporada_id, $liga_id) {
        $users = DB::table('liga_temporada')->select(['id','points','name', 'surname', 'username', 'image'])->join('users', 'users.id', "=", 'liga_temporada.user_id')->where('temporada_id', '=', $temporada_id)->where('liga_id', '=', $liga_id)->orderBy('points', 'desc')->get();
        return $users;
    }

    /**
     * Get all of the posts for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
