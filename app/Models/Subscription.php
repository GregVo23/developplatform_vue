<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'nb_projet',
        'subscription',
        'nb_max_projet',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'subscription';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}