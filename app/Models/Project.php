<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
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
        'name',
        'document',
        'picture',
        'about',
        'country',
        'street',
        'number',
        'city',
        'zipcode',
        'phone',
        'price',
        'created_at',
        'updated_at',
        'deadline',
        'done',
        'notifications',
        'rules',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'projects';

    public function rating()
    {
        return $this->hasOne(Rating::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function user()
    {
        return $this->belongsToMany(User::class)->withTimestamps()->withPivot('user_id', 'project_id', 'amount', 'created_at', 'updated_at', 'accepted', 'proposal');
    }

    public function owner()
    {
        $owner = $this->user_id;

        return $owner;
    }

    public function favorites_projects()
    {
        return $this->hasMany(ProjectUser::class);
    }

    public function isFavorite()
    {
        if (!auth()->check()) {
            return false;
        }
        if (auth()->user()->favorites_projects->contains('user_id', $this->id)) {
            return true;
        }
    }

    public function delay($deadline)
    {
        $date1 = strtotime(date('m/d/Y h:i:s', time()));
        $date2 = strtotime($deadline);

        $diff = abs($date2 - $date1);
        $days = floor($diff / (60 * 60 * 24));

        return $days;
    }

    public function address()
    {
        $address = $this->country . ", " . $this->city;

        return $address;
    }

    public function liked()
    {
        $likes = DB::table('project_user')
            ->where('favorite', 1)
            ->where('project_id', $this->id)
            ->count();

        return $likes;
    }
}
