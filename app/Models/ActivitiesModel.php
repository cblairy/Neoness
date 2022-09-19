<?php

namespace App\Models;

use CodeIgniter\Model;

class ActivitiesModel extends Model
{
    protected $table = 'activities';

    protected $allowedFields = [
        'date',
        'total_kcal', 
        'walking_time_3km', 
        'walking_time_6km', 
        'running_time_8km', 
        'running_time_10km',
        'running_time_13km',
        'running_time_15km',
        'bike_time',
        'swimming_time',
        'fitness_time',
        'bodybuilding_time',
        'fk_user_id'
        ];

    public function getActivity($activity = false)
    {
        if ($activity === false) {
            return $this->findAll();
        }

        return $this->where(['fk_user_id' => $activity])->first();
    }
}