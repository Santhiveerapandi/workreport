<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    // Tell Laravel that your primary key is not 'id'
    protected $primaryKey = 'employee_id';
    
    // If this custom ID is NOT auto-incrementing (e.g. manually entered staff numbers)
    public $incrementing = false;

    protected $fillable = ['employee_id', 'name'];

    public function workReport()
    {
        return $this->hasMany(WorkReport::class, 'employee_id');
    }
}
