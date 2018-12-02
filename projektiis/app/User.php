<?php

namespace System;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email' ,'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles() {
        return $this->belongsToMany(Role::class);
    }

    public function courses() {
        return $this->belongsToMany(Course::class);
    }

    public function questions() {
        return $this->hasMany(System\Question);
    }

    public function evaluations() {
        return $this->belongsToMany(Evaluation::class);
    }

    public function terms() {
        return $this->belongsToMany(System\Term);
    }

    public function authorizeRoles($roles){
        if (is_array($roles)){
            return $this->hasAnyRole($roles) || abort(401, 'This action is unauthorized');
        }
        return $this->hasRole($roles) || 
         abort(401, 'This action is unauthorized.');
    }

    public function hasAnyRole($roles){
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            return $this->hasRole($roles);
        }
        return false;
    }

    public function hasRole($role){
        return null !== $this->roles()->where('name', $role)->first();
    }

    public function whatRole(){

        if (null != $this->roles()->where('name', 'admin')->first()) {
            return 'admin';
        } else if (null != $this->roles()->where('name', 'teacher')->first()) {
            return 'teacher';
        } else if (null != $this->roles()->where('name', 'student')->first()) {
            return 'student';
        } else {
            return "";
        }
    }
}
