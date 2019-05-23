<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Payroll;
use Auth;
use Illuminate\Http\Request;
use Session;
use PDF;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->input();
            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password'], 'admin' => '1'])) {
                //echo 'success'; die;
                //add session variable to protect the routes....
                Session::put('adminSession', $data['email']);
                return redirect('/admin/dashboard');

            } else {
                //echo 'Fail'; die;
                return redirect('/admin')->with('flash_message_error', 'Invalid User name or password');
            }
        }
        return view('admin.admin_login');
    }

    public function dashboard()
    {
        if (session::has('adminSession')) {
            # perform all tasks of dashboard...
        } else {
            return redirect('/admin')->with('flash_message_error', 'Please login to access...');
        }
        return view('admin.dashboard');
    }
    /*public function logout(){
    return view('admin.admin_login');
    }*/

    public function add_newEmp()
    {
        return view('admin.add_newEmp');
    }

    public function payroll(Request $request, $emp_id = null)
    {
        $response['employee'] = Employee::where('id', $emp_id)->first();
        $response['employs'] = Employee::all();
        return view('admin.payroll')->with($response);
    }
    public function report(Request $request)
    {
        if($request->year){
            $year = $request->year;
        }else{
            $year = date("Y");
        }

        if($request->month){
            $month = $request->month;
        }else{
            $month = date("M");
        }
        $response['month'] = $month;
        $response['year'] = $year;
        $response['payrols'] = payroll::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->get();
        return view('admin.report')->with($response);
    }


    public function salarySlip(Request $request,$id,$month,$year)
    {
      $response['data'] = payroll::select('*')
                        ->join('employees','employees.id' ,'=','payrolls.employee_id')
                        ->whereYear('payrolls.created_at', '=', $year)
                        ->whereMonth('payrolls.created_at', '=', $month)
                        ->where('employees.id',$id)
                        ->first();
        $response['month'] = $month;
        $response['year'] = $year;

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHtml($this->generate1( $response['data'],$response['month'],$year));
       return $pdf->stream();
    }

    public function generate1($data,$month,$year)
    {

        $html = '
<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>'.$data->full_name.'&apos;s Salary Sllip</title>

        <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


    </head>
    <body>
        <div class="container">
            <div class="row">

                <div class=" col-lg-12  text-align:center">
                    <h1 style="text-align: center; color:red" >Softline Technologies</h1>
                    <h6 style="text-align: center;-"><small>No.237/82, Level 01, Vijaya Kumarathunga Mawatha, Colombo 05</small></h6>
                    <h5 style="text-align: center;">-- Salary Slip --</h5>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">

                    <h6 class="text-left"><small><strong>Employee Name : </strong>'.$data->full_name.'</small></h6>
                    <h6 class="text-left"><small><strong>Employee EPF No : </strong>#EPF-'.$data->employee_id.'</small></h6>
                    <h6 class="text-left"><small><strong>Month & Year : </strong>'.$month.'/'.$year.'</small></h6>
                    <h6 class="text-left"><small><strong>Employee Designation : </strong>'.$data->designation.'</small></h6>
                    <h6 class="text-letf"><small><strong>-- Company Contributions --</strong> </small></h6>
                    <h6 class="text-left"><small><strong>EPF(12%) : </strong>'.$data->cmp_epf.'</small></h6>
                    <h6 class="text-left"><small><strong>ETF(3%) : </strong>'.$data->cmp_etf.'</small></h6>
                </div>
            </div>

            <div class="row">
                <div></div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center"><small><strong>Earnings</strong></small></th>
                            <th class="text-center"><small><strong>Amount (Rs.)</strong></small></th>
                            <th class="text-center"><small><strong>Deductions</strong></small></th>
                            <th class="text-center"><small><strong>Amount (Rs.)</strong></small></th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-left"><h6><small>01.Basic Salary</small></h6></td>
                            <td class="text-left"><h6><small>'.$data->salary.'</small></h6></td>
                            <td class="text-left"><h6><small>01.No Pay</small></h6></td>
                            <td class="text-left"><h6><small>'.$data->no_pay.'</small></h6></td>

                        </tr>
                        <tr>
                            <td class="text-left"><h6><small>02.Attendance</small></h6></td>
                            <td class="text-left"><h6><small>'.$data->attendance.'</small></h6></td>
                            <td class="text-left"><h6><small>02.EPF(8%)</small></h6></td>
                            <td class="text-left"><h6><small>'.$data->emp_epf.'</small></h6></td>

                        </tr>
                        <tr>
                            <td class="text-left"><h6><small>03.Travelling</small></h6></td>
                            <td class="text-left"><h6><small>'.$data->travel.'</small></h6></td>
                            <td class="text-left"><h6><small>03.Salary Advance</small></h6></td>
                            <td class="text-left"><h6><small>'.$data->salary_advance.'</small></h6></td>

                        </tr>
                        <tr>
                            <td class="text-left"><h6><small>04.Food</h6></td>
                            <td class="text-left"><h6><small>'.$data->food.'</h6></td>
                            <td class="text-left"><h6><small>04.Loan Recovery</h6></td>
                            <td class="text-left"><h6><small>'.$data->loan_recovery.'</small></h6></td>

                        </tr>
                        <tr>
                            <td class="text-left"><h6><small>05.Lodging</small></h6></td>
                            <td class="text-left"><h6><small>'.$data->lodg.'</small></h6></td>
                            <td class="text-left"><h6><small>05.Welfair Contribution</small></h6></td>
                            <td class="text-left"><h6><small>'.$data->welfair_contribution.'</small></h6></td>

                        </tr>
                        <tr>
                            <td class="text-left"><h6><small>06.Cost of Living</small></h6></td>
                            <td class="text-left"><h6><small>'.$data->cost_of_living.'</small></h6></td>
                            <td class="text-left"><h6><small>06.Panelties</small></h6></td>
                            <td class="text-left"><h6><small>'.$data->penelties.'</small></h6></td>

                        </tr>
                        <tr>
                            <td class="text-left"><h6><small>07.Trainings</small></h6></td>
                            <td class="text-left"><h6><small>'.$data->training.'</small></h6></td>
                            <td class="text-left"></td>
                            <td class="text-left"></td>

                        </tr>
                        <tr>
                            <td class="text-left"><h6><small><strong>Toatal Earnings :</strong></small></h6></td>
                            <td class="text-left"><h6><small>'.($data->total_allowence + $data->salary).'</small></h6></td>
                            <td class="text-left"><h6><small><strong>Toatal Deductions :</strong></small></h6></td>
                            <td class="text-left"><h6><small>'.$data->total_deductions.'</small></h6></td>

                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td class="text-left"><h6><small><strong>Net Salary :</strong></small></h6></td>
                            <td class="text-left"><h6><small>'.$data->net_salary.'</small></h6></td>

                        </tr>
                    </tbody>
                </table>

            </div>


            <div class="row">
                <div class="col-lg-6">
                    <h6 class="text-left"><small>Cheque No :</small></h6>
                    <h6 class="text-left"><small>Bank Name :</small></h6>
                    <h6 class="text-left"><small>Date :</small></h6>
                    <h6 class="text-left"><small>Director Signature :</small></h6>
                    <h6 class="text-left"><small>Employee Signature :</small></h6>
                </div>

            </div>

            <hr>

        </div>

    </body>
</html>



        ';
return $html;

    }


 public function epfReport(Request $request,$month,$year)
    {
      $response['data'] = payroll::select('*')
                        ->join('employees','employees.id' ,'=','payrolls.employee_id')
                        ->whereYear('payrolls.created_at', '=', $year)
                        ->whereMonth('payrolls.created_at', '=', $month)
                        ->get();
        $response['month'] = $month;
        $response['year'] = $year;
        $html2 = '';
        foreach($response['data'] as $pr){
            $x_value = ((double)$pr->emp_epf + (double)$pr->cmp_epf);
            // dd($x);

            $html2 = $html2 .'<tr>
            <td><h6><small>#EPF-'.$pr->emp->id.'</small></h6></td>
          <td><h6><small>'.$pr->emp->full_name.'</small></h6></td>
          <td><h6><small>'.$pr->salary_for_epf.'</small></h6></td>
          <td><h6><small>'.$pr->emp_epf.'</small></h6></td>
          <td><h6><small>'.$pr->cmp_epf.'</small></h6></td>
          <td><h6><small>'.$x_value.'</small></h6></td>
       </tr>';

        }

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHtml($this->generate2( $response['data'],$response['month'],$year,$html2));
       return $pdf->stream();
    }
    public function generate2($data,$month,$year,$html2)
    {

        $html = '
<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>'.$month.'/'.$year.' EPF Report</title>

        <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


    </head>
    <body>
        <div class="container">
            <div class="row">

                <div class=" col-lg-12  text-align:center">
                    <h1 style="text-align: center; color:red" >Softline Technologies</h1>
                    <h6 style="text-align: center;-"><small>No.237/82, Level 01, Vijaya Kumarathunga Mawatha, Colombo 05</small></h6>
                    <h5 style="text-align: center;">-- Employee EPF Report --</h5>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <h6 class="text-left"><small><strong>Month & Year : </strong>'.$month.'/'.$year.'</small></h6>
                </div>
            </div>

            <div class="row">
                <div></div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th><h6><small><strong>Epf No</strong></small></h6></th>
                            <th><h6><small><strong>Name of the Employee</strong></small></h6></th>
                            <th><h6><small><strong>Salary for EPF</strong></small></h6></th>
                            <th><h6><small><strong>EPF(8%)</strong></small></h6></th>
                            <th><h6><small><strong>EPF(12%)</strong></small></h6></th>
                            <th><h6><small><strong>Total EPF</strong></small></h6></th>

                        </tr>
                    </thead>
                    <tbody>
                         '.$html2.'

                    </tbody>
                </table>

            </div>
            <div class="row">
                <div class="col-lg-6">

                    <h6 class="text-left"><small>Date :</small></h6>
                    <h6 class="text-left"><small>Director Signature :</small></h6>
                </div>

            </div>
        </div>

    </body>
</html>



        ';
return $html;

    }




 public function etfReport(Request $request,$month,$year)
 {
   $response['data'] = payroll::select('*')
                     ->join('employees','employees.id' ,'=','payrolls.employee_id')
                     ->whereYear('payrolls.created_at', '=', $year)
                     ->whereMonth('payrolls.created_at', '=', $month)
                     ->get();
     $response['month'] = $month;
     $response['year'] = $year;
     $html2 = '';
     foreach($response['data'] as $pr){
         $html2 = $html2 .'<tr>
         <td><h6><small>#EPF-'.$pr->emp->id.'</small></h6></td>
       <td><h6><small>'.$pr->emp->full_name.'</small></h6></td>
       <td><h6><small>'.$pr->cmp_etf.'</small></h6></td>
    </tr>';

     }

     $pdf = \App::make('dompdf.wrapper');
     $pdf->loadHtml($this->generate3( $response['data'],$response['month'],$year,$html2));
    return $pdf->stream();
 }
 public function generate3($data,$month,$year,$html2)
 {

     $html = '
<!DOCTYPE html>
<html lang="">
 <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>'.$month.'/'.$year.' ETF Report</title>

     <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


 </head>
 <body>
     <div class="container">
         <div class="row">

             <div class=" col-lg-12  text-align:center">
                 <h1 style="text-align: center; color:red" >Softline Technologies</h1>
                 <h6 style="text-align: center;-"><small>No.237/82, Level 01, Vijaya Kumarathunga Mawatha, Colombo 05</small></h6>
                 <h5 style="text-align: center;">-- Employee EPF Report --</h5>
             </div>
         </div>


         <div class="row">
             <div class="col-lg-12">
                 <h6 class="text-left"><small><strong>Month & Year : </strong>'.$month.'/'.$year.'</small></h6>
             </div>
         </div>

         <div class="row">
             <div></div>
             <table class="table table-bordered">
                 <thead>
                     <tr>
                         <th><h6><small><strong>Epf No</strong></small></h6></th>
                         <th><h6><small><strong>Name of the Employee</strong></small></h6></th>
=                        <th><h6><small><strong>ETF(3%)</strong></small></h6></th>

                     </tr>
                 </thead>
                 <tbody>
                      '.$html2.'

                 </tbody>
             </table>

         </div>
         <div class="row">
                <div class="col-lg-6">
                    <h6 class="text-left"><small>Date :</small></h6>
                    <h6 class="text-left"><small>Director Signature :</small></h6>
                </div>
        </div>

     </div>

 </body>
</html>



     ';
return $html;

 }


public function logout()
    {
        Session::flush();
        return redirect('/admin')->with('flash_message_success', 'Logged out Successfuly');
    }


}
