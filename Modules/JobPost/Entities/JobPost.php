<?php

namespace Modules\JobPost\Entities;

use App\Models\Category;
use App\Models\City;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Modules\JobPost\Entities\JobRequest;

class JobPost extends Model
{

    /**
     * @var array
     */
    protected $fillable = [];

    /**
     * @var array
     */
    protected $appends = ['total_job_application'];

    /**
     * @return mixed
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * @return mixed
     */
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo(User::class)->select('id', 'name', 'email', 'image');
    }

    /**
     * @return mixed
     */
    public function job_applications()
    {
        return $this->hasMany(JobRequest::class);
    }

    /**
     * @return mixed
     */
    public function getTotalJobApplicationAttribute()
    {
        return $this->job_applications()->count();
    }

    /**
     * @param $id
     */
    public function checkJobStatus($id)
    {
        $approval_check = JobRequest::where('job_post_id', $id)->where('status', 'approved')->count();

        if ($approval_check > 0) {
            return "approved";
        } else {
            return "pending";
        }
    }

}
