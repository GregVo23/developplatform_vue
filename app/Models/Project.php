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

    /**
     * Return the project's owner.
     *
     * @return collection
     */
    public function owner()
    {
        $owner = $this->user_id;

        return $owner;
    }

    /**
     * Return the project's deadline.
     *
     * @return number
     */
    public function delay($deadline)
    {
        $date1 = strtotime(date('m/d/Y h:i:s', time()));
        $date2 = strtotime($deadline);

        $diff = abs($date2 - $date1);
        $days = floor($diff / (60 * 60 * 24));

        return $days;
    }

    /**
     * Return the project's complete address.
     *
     * @return string
     */
    public function address()
    {
        $address = $this->country . ", " . $this->number . ", " . $this->city;

        return $address;
    }

    /**
     * Return how many likes for this project.
     *
     * @return object
     */
    public function liked()
    {
        $likes = DB::table('project_user')
            ->where('favorite', 1)
            ->where('project_id', $this->id)
            ->count();

        return $likes;
    }

    /**
     * Relations with Rating.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasoOne
     */
    public function rating()
    {
        return $this->hasOne(Rating::class);
    }

    /**
     * Relations with Category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relations with SubCategory.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class);
    }

    /**
     * Relations with User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
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

    /**
     * Relations with ProjectUser.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function favorites_projects()
    {
        return $this->hasMany(ProjectUser::class);
    }
}
