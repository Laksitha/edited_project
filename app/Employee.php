<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['full_name','name_with_init','designation','DOB','gender','address','salary','status'];


    public function payroll(){
        return $this->hasOne('App/Payroll','employee_id');
    }
}
