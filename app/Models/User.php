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
        'role_id',
        'firstname',
        'lastname',
        'name',
        'email',
        'password',
        'role_id',
        'country',
        'phone',
        'avatar',
        'about',
        'level',
        'rate',
        'notification',
        'rules',
        'created_at',
        'updated_at',
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
        $this->notify(new VerifyEmail);
    }

    /**
     * Return combinaison of first and lastname
     *
     * @return string
     */
    public function name()
    {
        $name = $this->firstname . " " . $this->lastname;

        return $name;
    }

    /**
     * Return favorite projects
     *
     * @return collection
     */
    public function favorites_projects()
    {
        return $this->belongsToMany(Project::class)->wherePivot('favorite', true);
    }

    /**
     * Relations with Project.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    /**
     * Relations with Subscription.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function subscription()
    {
        return $this->hasOne(Subscription::class);
    }

    /**
     * Relations with Role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Relations with Status.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Relations with Report.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
