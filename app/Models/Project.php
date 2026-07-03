<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //

    public function workReport()
    {
        return $this->hasMany(WorkReport::class, 'project_id');
    }
}
