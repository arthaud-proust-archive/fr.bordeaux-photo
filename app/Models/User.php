<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Event;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'img',
        'bio',
        'level'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    static $roles = [
        'admin' => 'Administrateur',
        'jury' => 'Jury',
        'user' => 'Utilisateur',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles() {
        return User::$roles;
    }

    public function getHashidAttribute() {
        return encodeId($this->id);
    }

    public function getEventsAsJuryAttribute() {
        return Event::where('jury', 'like', '%'.encodeId($this->id).'%');
    }

    public function getNamedRoleAttribute() {
        $decoded = json_decode($this->role);
        if (json_last_error() === JSON_ERROR_NONE) {
            return implode(', ', array_map(fn($role)=>User::$roles[$role],$decoded));
        } else {
            $this->role = json_encode([$this->role]);
            $this->save();
            return implode(', ', array_map(fn($role)=>User::$roles[$role],json_decode($this->role)));
        }
    }

    public function scopeJury($query) {
        return $query->where('role', 'LIKE', '%jury%');
    }

    public function scopeAdmin($query) {
        return $query->where('role', 'LIKE', '%admin%');
    }

    public function scopeActive($query) {
        return $query->where('active', true);
    }
    public function hasRole($roles) {
        foreach(json_decode($this->role) as $userRole) {
            if(in_array($userRole, explode(',', $roles))) {
                return true;
            }
        }
        return false;
    }
}
