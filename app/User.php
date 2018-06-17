<?php

namespace App;

use App\Mail\VerifyMail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
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
        $user->roles()->attach(Role::where('name', 'editor')->first());
        Mail::to($user->email)->send(new VerifyMail($user));
        return true;
    }

    public function article(){
        return $this->hasOne('App\Article', 'id_author', 'id');
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
