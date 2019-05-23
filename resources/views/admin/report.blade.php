@extends('layouts.adminLayout.admin_design')
@section('content')


<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-6 card">
            <div class="card-body">
                <div class="form-group">
                    <label for="allowences" class="col-md-4 col-form-label">Select Year</label>
                    <select class="form-control year_select_box select2" id="year" name="year">
                        <option {{  $year == 2019?'selected':'' }} value="2019">2019</option>
                        <option {{  $year == 2020?'selected':'' }} value="2020">2020</option>
                    </select>
                </div>
                <div class="form-group ">
                    <label for="allowences" class="col-md-4 col-form-label">Select Month</label>
                    <select class="form-control month_select_box select2" id="month" name="month">
                        <option {{  $month == 1?'selected':'' }} value="1">January</option>
                        <option {{  $month == 2?'selected':'' }} value="2">February</option>
                        <option {{  $month == 3?'selected':'' }} value="3">March</option>
                        <option {{  $month == 4?'selected':'' }} value="4">April</option>
                        <option {{  $month == 5?'selected':'' }} value="5">May</option>
                        <option {{  $month == 6?'selected':'' }} value="6">June</option>
                        <option {{  $month == 7?'selected':'' }} value="7">July</option>
                        <option {{  $month == 8?'selected':'' }} value="8">August</option>
                        <option {{  $month == 9?'selected':'' }} value="9">September</option>
                        <option {{  $month == 10?'selected':'' }} value="10">October</option>
                        <option {{  $month == 11?'selected':'' }} value="11">November</option>
                        <option {{  $month == 12?'selected':'' }} value="12">December</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Genereate Salary Slip</h5>
                    <small class="card-text">Content</small>
                    <div class="form-group">
                        <label for="allowences" class="col-md-4 col-form-label">Select Employee</label>
                        <select class="form-control  select2" id="employee" name="employee">
                            @foreach ($payrols as $pr)
                            <option value="{{ $pr->emp->id }}">{{ $pr->emp->full_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <h6 class="text-center">
                                <button class="btn btn-warning" id="employee-btn">Generate pdf</button>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center  {{ count($payrols) > 0?'d-none':'' }}">
        <div class="col-lg-8 mb-4">
            <h5 class="text-center text-muted">Empty For This Selection</h5>
        </div>
    </div>


    <div class="col-lg-12 mt-4 grid-margin stretch-card {{ count($payrols) > 0?'':'d-none' }}">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Employee EPF report</h4>
                <button class="btn btn-danger" id="epf-btn">Generate pdf</button>
                <p class="card-description"></p>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th> Epf No</th>
                                <th>Name of the Employee</th>
                                <th>Salary for EPF</th>
                                <th>EPF(8%)</th>
                                <th>EPF(12%)</th>
                                <th>Total EPF</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($payrols as $pr)
                            <tr>
                                <td>#EPF-{{$pr->emp->id}}</td>
                                <td>{{$pr->emp->full_name}}</td>
                                <td>{{ $pr->salary_for_epf }} </td>
                                <td>{{ $pr->emp_epf }}</td>
                                <td>{{ $pr->cmp_epf }}</td>
                                <td>{{ $pr->emp_epf +  $pr->cmp_epf }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="content-wrapper {{ count($payrols) > 0?'':'d-none' }}">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Employee ETF report</h4>
                <button class="btn btn-danger" id="etf-btn">Generate pdf</button>
                <p class="card-description"></p>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th> Epf No</th>
                                <th>Name of the Employee</th>
                                <th>ETF(3%)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payrols as $pr)
                            <tr>
                                <td>#EPF-{{$pr->emp->id}}</td>
                                <td>{{$pr->emp->full_name}}</td>
                                <td>{{$pr->cmp_etf}}</td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>





@endsection
@section('js')
<script>
    $(document).ready(function () {
        $('.select2').select2({
            placeholder: "Please Select a One",
            allowClear: true
        });

        $('.month_select_box').change(function () {
            location.href = "{{ url('/admin/report/') }}?month=" + $(this).val() + "&year=" + $(
                '.year_select_box').val();
        });

        $('.year_select_box').change(function () {
            location.href = "{{ url('/admin/report/') }}?month=" + $('.month_select_box').val() +
                "&year=" + $(this).val();
        });

        $('#employee-btn').click(function () {
            if ($('#employee').val() != '') {
                window.open("{{ url('/admin/report/salarySlip/') }}/" + $('#employee').val() + '/' + $(
                    '.month_select_box').val() + '/' + $('.year_select_box').val(), '_blank');
            }

        });



        $('#epf-btn').click(function () {
            if ($('#employee').val() != '') {
                window.open("{{ url('/admin/report/epfReport/') }}/" + $('.month_select_box').val() +
                    '/' + $('.year_select_box').val(), '_blank');
            }
        });


        $('#etf-btn').click(function () {
            if ($('#employee').val() != '') {
                window.open("{{ url('/admin/report/etfReport/') }}/" + $('.month_select_box').val() +
                    '/' + $('.year_select_box').val(), '_blank');
            }
        });




    });

</script>
@endsection
