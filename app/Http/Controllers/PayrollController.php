<?php

namespace App\Http\Controllers;

use Request;
use App\Payroll;

class PayrollController extends Controller
{
    protected $pay;
     public function __construct()
    {
        $this->pay = new Payroll();
        /*$this->pay->create([
                'product_id' => $data['product_id'],
                'image_id' => $data['image_id'],
            ]);*/

    }

    public function store(Request $request){
        //dd($request->all());
        //Payroll::create(Request::all());
        //$pay = new Payroll();
        $this->pay->create(Request::all());
        $data=Payroll::all();
        
        return redirect('admin/payroll');
        return view('/admin/report')->with('Pay',$data);
    }
}
