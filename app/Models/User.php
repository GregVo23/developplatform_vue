<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\VerifyEmail;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable  implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'firstname',
        'lastname',
        'name',
        'email',
        'password',
        'role_id',
        'country',
        'phone',
        'level',
        'avatar',
        'about',
        'notification',
        'nb_project',
        'lost_password',
        'suspended',
        'created_at',
        'updated_at',
        'rules',
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

    protected $table = 'users';


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail); // my notification
    }

    public function project()
    {
        return $this->belongsToMany(Project::class)->withTimestamps()->withPivot('user_id', 'project_id', 'price', 'created_at','updated_at', 'accepted');

    }

    public function favorites_projects()
    {
        return $this->belongsToMany(Project::class)->wherePivot('favorite', true);
    }

    public function name()
    {
        $name = $this->firstname." ".$this->lastname;

        return $name;
    }
}
