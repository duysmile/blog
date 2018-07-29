<?php

namespace App;

use App\Http\Controllers\FullTextSearch;
use App\Mail\VerifyMail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use SoftDeletes;
    protected $table = "users";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function getUsers(){
        $users = User::where('verify', true)->where('id', '!=', Auth::user()->id)->select('id', 'name', 'email', 'status')->paginate(20);
        return $users;
    }

    public static function getTopUsers($time){
        $time = strtotime('1-'.$time);
        $users = Article::where([
                'id_status' => 2
            ])
            ->whereMonth('time_public', date('m', $time))
            ->whereYear('time_public', date('Y', $time))
            ->select('id_author', DB::raw('SUM(views) as views_article'))
            ->groupBy('id_author')
            ->orderBy(DB::raw('SUM(views)'), 'desc')
            ->limit(10)
            ->get();
        foreach($users as $user){
            $user['articles'] = Article::where([
                'id_status' => 2,
                'id_author' => $user->id_author,
            ])
                ->whereMonth('time_public', date('m', $time))
                ->whereYear('time_public', date('Y', $time))
                ->count();
            $user['author'] = User::find($user->id_author)->name;
        }
        return $users;
    }

    public static function saveUser($request){
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password'=> bcrypt($request['password']),
        ]);
        VerifyUser::create([
            'user_id' => $user->id,
            'token' => str_random(40),
        ]);
        if(isset($request['role'])){
            $user->roles()->attach(Role::where('role_code', $request['role'])->first());
        }
        else{
            $user->roles()->attach(Role::where('name', 'editor')->first());
        }
        Mail::to($user->email)->send(new VerifyMail($user));
        return true;
    }
    public static function updateUser($id, $request){

        $user = User::find($id);
        $user->roles()->detach();
        $user->roles()->attach(Role::where('role_code', $request['role'])->first());

        if($request['status'] == null){
            $request['status'] = false;
        }
        if($request['password'] != null){
            $request->validate([
                'password' => 'min:6',
            ]);
            foreach($request->only('name', 'email', 'password', 'status') as $key => $value){
                if($key == "password"){
                    $user[$key] = bcrypt($value);
                }
                else{
                    $user[$key] = $value;
                }
            }
            return $user->save();
        }
        foreach($request->only('name', 'email', 'status') as $key => $value){
            $user[$key] = $value;
        }
        return $user->save();
    }
    public static function updateProfile($id, $request){
        $user = User::find($id);
        if($request->current_password != null){
            $credentials = [
                'email' => Auth::user()->email,
                'password' => $request->current_password
            ];
            if(!Auth::attempt($credentials)){
                return false;
            }
        }
        foreach($request->only(['name', 'email', 'password']) as $key => $item){
            if($item != null){
                if($key == 'password'){
                    $user[$key] = bcrypt($item);
                }else{
                    $user[$key] = $item;
                }
            }
        }
        return $user->save();
    }

    public function articles(){
        return $this->hasMany('App\Article', 'id_author', 'id');
    }
    public function verifyUser(){
        return $this->hasOne('App\VerifyUser');
    }

    public function roles(){
        return $this->belongsToMany(Role::class, 'role_user', 'id_user', 'id_role');
    }

    public function authorizeRole($roles){
        if(is_array($roles)){
            return $this->hasAnyRole($roles) || abort(401, 'This action is unauthorize');
        }
        return $this->hasRole($roles) || abort(401, "This action is unauthorize");
    }
    public function hasRole($role){
        return $this->roles()->where('name', $role)->first() !== null;
    }
    public function hasAnyRole($roles){
        return $this->roles()->whereIn('name'. $roles)->first() !== null;
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
