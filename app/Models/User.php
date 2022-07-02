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

    /**
     * Get all of the userImages for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userImages()
    {

        return $this->hasMany(userImages::class);
    }

    public static function get_user_temporades($id) {
        $table = [];
        $temporades_user = DB::table('liga_temporada')->where([
            ['user_id', '=', $id]
        ])->orderBy('temporada_id', 'asc')->get();
        foreach($temporades_user as $temporada) {
            $table[] = [
                "temporada_name" => Temporada::find($temporada->temporada_id)->nom_temporada,
                "liga_name" => Liga::find($temporada->liga_id)->name,
                "position" => User::get_position($temporada->temporada_id, $temporada->liga_id, $temporada->user_id),
                "points" => $temporada->points,
                "temporada_id" => $temporada->temporada_id,
                "liga_id" => $temporada->liga_id
            ];
        }
        return $table;
    }

    private static function get_position($temporada_id, $liga_id, $user_id) {
        $table = DB::table('liga_temporada')->where([
            ['liga_id', '=', $liga_id],
            ['temporada_id', '=', $temporada_id]
        ])->orderBy('points', 'desc')->get();
        foreach($table as $key => $valor) {
            if($valor->user_id == $user_id) return $key+1;
        }
    }

    public static function set_user_profile_picture($user_id, $image) {
        $user = User::find($user_id);
        if(isset($user->image)) return;
        $user->image = $image;
        $user->save();
        return;
    }

    private static function get_historical_user_points ($user_id) {
        $temporades = Temporada::all();
        $total = 0;
        $i = 0;
        $user = [];
        foreach($temporades as $temporada) {
            $user_temporada = DB::table('liga_temporada')->where([['user_id', '=', $user_id],['temporada_id', '=', $temporada->id]])->first();
            if(isset($user_temporada)) {
                $i++;
                $total += $user_temporada->points;
                $user[] = ["temporada_id" => $user_temporada->temporada_id, "points" => $user_temporada->points];
            } else {
                $user[] = ["temporada_id" => $temporada->id, "points" => ""];
            }
        }
        switch($i) {
            case 1:
                $color = "#c0392b";
                break;
            case 2:
                $color = "#e74c3c";
                break;
            case 3:
                $color = "#d35400";
                break;
            case 4:
                $color = "#e67e22";
                break;
            case 5:
                $color = "#f39c12";
                break;
            case 6:
                $color = "#f1c40f";
                break;
            case 7:
                $color = "#8e44ad";
                break;
            case 8:
                $color = "#9b59b6";
                break;
            case 9:
                $color = "#27ae60";
                break;
            case 10:
                $color = "#2ecc71";
                break;
            case 11:
                $color = "#1abc9c";
                break;
            case 12:
                $color = "#16a085";
                break;
            default:
                $color = "black";
        }
        return ["temporadas" => $user, "totals" => ["total" => $total, "temporadas_jugadas" => $i, "color" => $color]];
    }

    public static function get_historical_data() {
        $data = [];
        $data[] = Temporada::all()->toArray();
        $secundary_data = [];
        $users = DB::table('liga_temporada')->selectRaw('sum(points) as total_points, user_id')->groupBy('user_id')->orderBy('total_points', 'desc')->get();
        foreach($users as $user) {
            $secundary_data[] = ["player_username" => User::find($user->user_id)->username ,"player_data" => User::get_historical_user_points($user->user_id), "player_points" => $user->total_points];
        }
        $data[] = $secundary_data;
        $data[] = ["temporadas_totales" => count($data[0])];
        return $data;
    }
}
