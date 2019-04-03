
<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Title Page</title>

        <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">


    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col col-lg-4">

                </div>
                <div class="col col-lg-4 float-right text-align:center">
                    <h1 style="text-align: center; color:red" >Softline Technologies</h1>
                    <p style="text-align: center;">No.237/82, Level 01, Vijaya Kumarathunga Mawatha, Colombo 05</p>
                    <h3 style="text-align: center;">-- Salary Slip --</h3>
                </div>
            </div>
            <br>
            <hr>
            <div class="row">
                <div class="col col-lg-8">
                    <form>
                        <div class="form-group row">
                            <label for="Emp name" class="col-sm-4 col-form-label">Employee Name :</label>
                            <div class="col-sm-4">
                            <label for="Emp name" class="col-form-label">{{ $data->full_name }}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Emp no" class="col-sm-4 col-form-label">Employee EPF No :</label>
                            <div class="col-sm-4">
                                <label for="Emp name" class="col-form-label">#EPF-{{ $data->employee_id }}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Emp name" class="col-sm-4 col-form-label">Designation :</label>
                            <div class="col-sm-4">
                                <label for="Emp name" class="col-form-label">{{ $data->designation }}</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Emp name" class="col-sm-4 col-form-label">Month & Year :</label>
                            <div class="col-sm-4">
                                <label for="Emp name" class="col-form-label">{{ $month }} / {{ $year }}</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col col-lg-4">
                    <h5><strong>Company Contributions</strong> </h5>
                    <div class="form-group row">
                        <label for="Emp name" class="col-sm-4 col-form-label">EPF(12%) :</label>
                        <div class="col-sm-4">
                            <label for="Emp name" class="col-form-label">{{ $data->cmp_epf }}</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Emp name" class="col-sm-4 col-form-label">ETF(3%) :</label>
                        <div class="col-sm-4">
                            <label for="Emp name" class="col-form-label">{{ $data->cmp_etf }}</label>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div></div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th><strong>Earnings</strong></th>
                            <th><strong>Amount (Rs.)</strong></th>
                            <th><strong>Deductions</strong></th>
                            <th><strong>Amount (Rs.)</strong></th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>01.Basic Salary</td>
                            <td>{{ $data->salary }}</td>
                            <td>01.No Pay</td>
                            <td>{{ $data->no_pay }}</td>

                        </tr>
                        <tr>
                            <td>02.Attendance</td>
                            <td>{{ $data->attendance }}</td>
                            <td>02.EPF(8%)</td>
                            <td>{{ $data->emp_epf }}</td>

                        </tr>
                        <tr>
                            <td>03.Travelling</td>
                            <td>{{ $data->travel }}</td>
                            <td>03.Salary Advance</td>
                            <td>{{ $data->salary_advance }}</td>

                        </tr>
                        <tr>
                            <td>04.Food</td>
                            <td>{{ $data->food }}</td>
                            <td>04.Loan Recovery</td>
                            <td>{{ $data->loan_recovery }}</td>

                        </tr>
                        <tr>
                            <td>05.Lodging</td>
                            <td>{{ $data->lodg }}</td>
                            <td>05.Welfair Contribution</td>
                            <td>{{ $data->welfair_contribution }}</td>

                        </tr>
                        <tr>
                            <td>06.Cost of Living</td>
                            <td>{{ $data->cost_of_living }}</td>
                            <td>06.Panelties</td>
                            <td>{{ $data->penelties }}</td>

                        </tr>
                        <tr>
                            <td>06Trainings</td>
                            <td>{{ $data->training }}</td>
                            <td></td>
                            <td></td>

                        </tr>
                        <tr>
                            <td><strong>Toatal Earnings :</strong></td>
                            <td>{{ $data->total_allowence + $data->salary }}</td>
                            <td><strong>Toatal Deductions :</strong></td>
                            <td>{{ $data->total_deductions }}</td>

                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>

                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td><strong>Net Salary :</strong></td>
                            <td>{{ $data->net_salary }}</td>

                        </tr>
                    </tbody>
                </table>
                <div></div>
            </div>

            <hr>
            <div class="row">
                <div class="col-lg-6">
                    <label for="cheque no" class="col-sm-4 col-form-label">Cheque No :</label>
                </div>
                <div class="col-lg-6">
                    <label for="Emp name" class="col-sm-4 col-form-label">Bank Name :</label>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <label for="cheque no" class="col-sm-4 col-form-label">Date :</label>
                </div>
                <div class="col-lg-6">
                    <label for="Emp name" class="col-sm-4 col-form-label">Director Signature :</label>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <label for="cheque no" class="col-sm-4 col-form-label">Employee Signature :</label>
                </div>
            </div>
            <br>
            <hr>

        </div>

       <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>
