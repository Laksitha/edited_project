@extends('layouts.adminLayout.admin_design')
@section('content')
<!-- partial -->

<div class="content-wrapper">
    <div class="row">
        <h4 class="card-title"></h4>
        <div class="col-md-10 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Payroll form</h4>
                    <hr>
                    <div class="col-md-12">
                        <form class="forms-sample" method="POST" action="{{action('PayrollController@store')}}">
                        {{ csrf_field()}}
                            <div class="form-group row">
                                <label for="allowences" class="col-md-4 col-form-label">Select Employee Name</label>
                                <div class="col-md-3">
                                    <select class="form-control emp_select_box" id="emp_id" name="employee_id">
                                        <option></option>
                                        @foreach ($employs as $emp)
                                        <option {{ $employee && $employee->id == $emp->id?'selected':'' }}
                                            value="{{ $emp->id }}">{{ $emp->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="number" class="form-control"
                                        value="{{ $employee?$employee->salary:'' }}" name="basic_salary" readonly
                                        id="basic_salary" placeholder="Basic Salary">
                                </div>
                            </div>

                            <hr>
                            <h6>Allowences</h6>
                            <div class="form-group row">
                                <label for="attendance" class="col-md-4 col-form-label">01. Attendance allowence</label>
                                <div class="col-md-6">
                                    <input type="number" value="0" class="form-control allowences for_epf"
                                        name="attendance" id="attendance">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="allowences" class="col-md-4 col-form-label">02. Travel allowence</label>
                                <div class="col-md-6">
                                    <input type="number" value="0" class="form-control allowences for_epf" name="travel"
                                        id="travel">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="allowences" class="col-md-4 col-form-label">03. Food allowence</label>
                                <div class="col-md-6">
                                    <input type="number" value="0" class="form-control allowences for_epf" name="food"
                                        id="food">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="allowences" class="col-md-4 col-form-label">04. Lodgings alowence</label>
                                <div class="col-md-6">
                                    <input type="number" value="0" class="form-control allowences for_epf" name="lodg"
                                        id="lodg">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="allowences" class="col-md-4 col-form-label">05. Cost of living</label>
                                <div class="col-md-6">
                                    <input type="number" value="0" class="form-control allowences for_epf"
                                        name="cost_of_living" id="cost_of_living">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="allowences" class="col-md-4 col-form-label">06. Training allowences</label>
                                <div class="col-md-6">
                                    <input type="number" value="0" class="form-control allowences for_epf"
                                        name="training" id="training">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="allowences" class="col-md-4 col-form-label"><strong>Total
                                        Allowences</strong></label>
                                <div class="col-md-6">
                                    <input type="number" value="0" readonly class="form-control" name="total_allowence"
                                        id="total_allowence">
                                </div>
                                {{--  <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary mr-2" name="summation"
                                        value="summation" id="summation">sum</button>
                                </div>  --}}
                            </div>
                            <hr>
                            <h6>Deductions</h6>
                            <div class="form-group row">
                                <label for="deductions" class="col-md-4 col-form-label">01. No Pay</label>
                                <div class="col-md-3">
                                    <input type="number" value="0" class="form-control no_pay for_epf" name="No_of_days"
                                        id="No_of_days" placeholder="No of days">
                                </div>
                                <div class="col-md-3">
                                    <input type="number" value="0" class="form-control no_pay for_epf" name="rate"
                                        id="rate" placeholder="Amount">
                                    <input type="hidden" name="no_pay" id="no_pay" class="deductions" value="0">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="deductions" class="col-md-4 col-form-label">02. EPF(8%)</label>
                                <div class="col-md-6">
                                    <input type="number" readonly class="form-control deductions" value="0" name="emp_epf"
                                        id="emp_epf">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="deductions" class="col-md-4 col-form-label">03. Salary Advance</label>
                                <div class="col-md-6">
                                    <input type="number" value="0" class="form-control deductions" name="salry_advance"
                                        id="salry_advance">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="deductions" class="col-md-4 col-form-label">04. Loan Recovery</label>
                                <div class="col-md-6">
                                    <input type="number" value="0" class="form-control deductions" name="loan_recovery"
                                        id="loan_recovery">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="deductions" class="col-md-4 col-form-label">05. Welfair Contribution</label>
                                <div class="col-md-6">
                                    <input type="number" value="0" class="form-control deductions"
                                        name="welfair_contribution" id="welfair_contribution">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="deductions" class="col-md-4 col-form-label">06. Penelties</label>
                                <div class="col-md-6">
                                    <input type="number" value="0" class="form-control deductions" name="penelties"
                                        id="penelties">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="deductions" class="col-md-4 col-form-label"><strong>Total
                                        Deductions</strong></label>
                                <div class="col-md-6">
                                    <input type="number" readonly value="0" class="form-control "
                                        name="total_deductions" id="total_deductions">
                                </div>
                                {{--  <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary mr-2" name="summation"
                                        value="summation" id="allowences">sum</button>
                                </div>  --}}
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label for="net_salary" class="col-md-4 col-form-label"><strong>Net
                                        Salary</strong></label>
                                <div class="col-md-6">
                                    <input type="number" readonly value="0" class="form-control" name="net_salary"
                                        id="net_salary">
                                </div>
                                {{--  <div class="col-md-2">
                                    <button type="submit" class="btn btn-warning mr-2" name="net_Sal" value="summation"
                                        id="allowences">Total</button>
                                </div>  --}}
                            </div>
                            <hr>
                            <h6>Company Contribution</h6>
                            <div class="form-group row">
                                <label for="deductions" class="col-md-4 col-form-label">01. EPF</label>
                                <div class="col-md-6">
                                    <input type="number" readonly value="0" class="form-control" name="cmp_epf"
                                        id="cmp_epf">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="deductions" class="col-md-4 col-form-label">02. ETF</label>
                                <div class="col-md-6">
                                    <input type="number" readonly value="0" class="form-control" name="cmp_etf"
                                        id="cmp_etf">
                                </div>
                            </div>

                            <div class="form-group row">

                                <label for="" class="col-md-4 col-form-label"></label>
                                <div class="col-md-6">
                                    <input type="hidden" id="salary_for_epf" name="salary_for_epf" >
                                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                                    <button class="btn btn-light">Cancel</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- content-wrapper ends -->
@endsection

@section('js')
<script>
    $(document).ready(function () {
        $('#emp_id').select2({
            placeholder: "Please Select a Employee First",
            allowClear: true
        });
    });



    $('.emp_select_box').change(function () {
        var rout = '{{ url("/admin/payroll/") }}';
        rout = rout + '/' + parseInt($(this).val());
        location.href = rout;
    });

    $('.allowences').bind('keyup change', function () {
        var total_allowence = 0;
        $('.allowences').each(function () {
            if (parseInt($(this).val())) {
                total_allowence += parseInt($(this).val());
                console.log(parseInt($(this).val()));
            }
        });
        $('#total_allowence').val(total_allowence);
    });

    $('.no_pay').bind('keyup change', function () {
        var no_pay = 0;
        no_pay = parseFloat($('#No_of_days').val()) * parseFloat($('#rate').val());
        $('#no_pay').val(no_pay);

    });


    $('.deductions').bind('keyup change', function () {
        var deductions = 0;
        $('.deductions').each(function () {
            if (parseInt($(this).val())) {
                deductions += parseInt($(this).val());
            }
        });
        $('#total_deductions').val(deductions);
    });


    $('.for_epf').bind('keyup change', function () {
        var basic = parseFloat($('#basic_salary').val());
        var allowence = parseFloat($('#total_allowence').val());
        var no_pay = parseFloat($('#No_of_days').val()) * parseFloat($('#rate').val());

        var pricable_value = basic + allowence - no_pay;
        $('#emp_epf').val(pricable_value * 8 / 100);
        $('#cmp_epf').val(pricable_value * 12 / 100);
        $('#cmp_etf').val(pricable_value * 3 / 100);
        $('#salary_for_epf').val(pricable_value);
        //console.log(pricable_value);
    });

    $('.form-control').bind('change keyup', function () {
        $('#net_salary').val(parseFloat($('#basic_salary').val()) - parseFloat($('#total_deductions').val()) +
            parseFloat($('#total_allowence').val()));
    });

</script>
@endsection
