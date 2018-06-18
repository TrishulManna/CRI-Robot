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
        'name', 'email', 'password', 'phone_number', 'address', 'organisation_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_users');
    }

    public function organisation()
    {
        return $this->belongsTo(Organisation::class, 'organisation_id', 'id');
    } 

    //checks if user has acces to $permission
    public function hasAcces(array $permissions) : bool
    {
        //check if the permission is available in any role
        foreach ($this->roles as $role) {
            if($role->hasAccess($permissions)){
                return true;
            }
        }
        return false;
    }

    public static function getUsersForSelect(){
      // Define the users:
      $users = User::get();
      // Define the result:
      $result = array();
      // Loop trough the users:
      foreach ($users as $key => $user) {
        // Add the user to the result:
        $result[$user->id] = $user->name;
      }
      // Return the result:
      return $result;
    }

    //Checks if the users belongs to role
    public function inRole(string $roleSlug)
    {
        return $this->roles()->where('slug', $roleSlug)->count() == 1;
    }


}
