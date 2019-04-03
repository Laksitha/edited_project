<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $fillable = ['employee_id','attendance','travel','food','lodg','cost_of_living','training','total_allowence',
    'No_of_days','rate','no_pay','emp_epf','salary_advance','loan_recovery','welfair_contribution',
    'penelties','total_deductions','net_salary','cmp_epf','cmp_etf','salary_for_epf'];


     public function emp(){
        return $this->belongsTo('App\Employee','employee_id');
    }
}
