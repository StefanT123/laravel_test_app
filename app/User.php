<?php

namespace App;

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
        'name', 'email', 'password', 'provider', 'provider_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function socialProfile() {

        return $this->hasOne(SocialLoginProfile::class);

    }

    public function roles() {

        return $this->belongsToMany('App\Role')->withTimestamps();

    }

    public function authorizeRoles($roles) {

        if ( $this->hasAnyRole($roles) ) {
            return true;
        }

    }

    public function hasAnyRole($roles) {

        if ( is_array($roles) ) {

            foreach ( $roles as $role ) {
                if ( $this->hasRole($role) ) {
                    return true;
                }
            }

        } else {

            if ( $this->hasRole($roles) ) {
                return true;
            }

        }

        return false;
    }

    public function hasRole($role) {

        if ( $this->roles()->where('name', $role)->first() ) {
            return true;
        }

        return false;
    }

    public function pages()
    {
        return $this->hasMany(Pages::class);
    }

    public function publishPage(Pages $pages)
    {
        $this->pages()->save($pages);
    }

    public function sessions()
    {
        return $this->belongsToMany(Session::class)->withTimestamps();
    }

    public function generateToken()
    {
        $this->api_token = str_random(60);
        $this->save();
        return $this->api_token;
    }
}
