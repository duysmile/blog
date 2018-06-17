<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users(){
        $this->belongsToMany(User::class, 'role_user', 'id_role', 'id_user');
    }
}
