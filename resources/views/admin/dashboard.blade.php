 @extends('layouts.adminLayout.admin_design')
 @section('content')

        <div class="content-wrapper">
          <div class="row">

            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Employees</h4>
                  <p class="card-description">
                    Add class
                  </p>
                  <div class="table-responsive">
                    <table class="table table-dark">
                      <thead>

                        <tr>
                          <th>EPF No</th>
                          <th>First name</th>
                          <th>Designation</th>
                          <th>Basic Salary</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($Emp as $emp)
                        <tr>
                          <td>{{$emp->id}}</td>
                          <td>{{$emp->full_name}}</td>
                          <td>{{$emp->designation}}</td>
                          <td>{{$emp->salary}}</td>
                          <td>{{$emp->status}}</td>
                          <td>
                            <button type="button" class="btn btn-success"
                              data-myid="{{$emp->id}}"
                              data-myfname="{{$emp->full_name}}"
                              data-myiname="{{$emp->name_with_init}}"
                              data-mydesig="{{$emp->designation}}"
                              data-mydob="{{$emp->DOB}}"
                              data-mygender="{{$emp->gender}}"
                              data-myaddress="{{$emp->address}}"
                              data-mysalary="{{$emp->salary}}"
                              data-mystatus="{{$emp->status}}"

                             data-toggle="modal" data-target="#edit_modal">Edit</button>
                            <button type="button" class="btn btn-danger" data-myid="{{$emp->id}}" data-toggle="modal" data-target="#delete">Delete</button>
                          </td>

                        </tr>
                      @endforeach

                      </tbody>
                    </table>
                  </div>
                  <!-- Edit_Modal -->
                  <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title" id="exampleModalScrollableTitle">Edit Employee Details</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>

                        </div>
                        <hr>
                        <form action="{{route('edit.update','test')}}" method="POST">
                        {{method_field('patch')}}
                        {{csrf_field()}}
                        <div class="modal-body">
                          <input type="hidden" name="empl_id" id=emp_id value="">
                           <div class="form-group">
                            <label for="exampleInputName1"><h6>Full Name</h6></label>
                            <input type="text" class="form-control" name="full_name"  id="full_name" placeholder="Name">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputName1"><h6>Name with Initial</h6></label>
                            <input type="text" class="form-control" name="name_with_init" id="name_with_init" placeholder="Name with Initial">
                          </div>
                          <div class="form-group">
                            <label for="designation"><h6>Designation</h6></label>

                            <select name="designation" id="designation" class="col-md-6 form-control">
                              <option value="Technical Consultant">Technical Consultant</option>
                              <option value="Associate Technical Consultant">Associate Technical Consultant</option>
                              <option value="Senior Technical Consultant">Senior Technical Consultant</option>
                              <option value="Functional Consultant">Functional Consultant</option>
                              <option value="Associate Functional Consultant">Associate Functional Consultant</option>
                              <option value="Senior Functional Consultant">Senior Functional Consultant</option>
                              <option value="Project Manager">Project Manager</option>
                              <option value="HR executive">HR executive</option>
                              <option value="Managing Director">Managing Director</option>
                            </select>

                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword4"><h6>Date of Birth</h6></label>
                            <input type="date" class="form-control" name="DOB" id="dateOfBirth" placeholder="yyyy/mm/dd">
                          </div>
                          <div class="form-group">
                            <label><h6>Gender</h6></label>
                              <select name="gender" id="gender" class="col-md-6 form-control">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                              </select>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputCity1"><h6>Address</h6></label>
                            <br>
                            <input type="text" class="col-sm-6 form-control" name="address" id="address" placeholder="City">

                          </div>
                          <div class="form-group">
                            <label for="exampleTextarea1"><h6>Basic Salary</h6></label>
                            <input type="text" class="form-control" name="salary" id="salary" placeholder="Basic salary">
                          </div>
                          <div class="form-group">
                            <label for="designation"><h6>Status</h6></label>
                            <select name="status" id="status" class="col-md-6 form-control">
                              <option value="Permenent">Permenent</option>
                              <option value="Tempory">Tempory</option>
                            </select>
                          </div>
                          </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <!--end of edit model-->
                  <!-- delete_Modal -->
                  <div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title text-center" id="exampleModalScrollableTitle">Delete Conformation</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>

                        </div>

                        <form action="{{route('edit.destroy','test')}}" method="POST">
                        {{method_field('delete')}}
                        {{csrf_field()}}
                        <div class="modal-body">
                          <input type="hidden" name="empl_id" id=emp_id value="">
                           <p class="text-center">
                            Are you sure? Do you want to delete this???
                           </p>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-primary" data-dismiss="modal">No, Cancel</button>
                          <button type="submit" class="btn btn-warning">Yes, delete</button>
                        </div>
                        </form>
                      </div>
                    </div>
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

 $('#edit_modal').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget) // Button that triggered the modal
            var full_name = button.data('myfname')
            var init_name = button.data('myiname')
            var designation = button.data('mydesig')
            var dob = button.data('mydob')
            var gender = button.data('mygender')
            console.log(gender);
            console.log('www');
            var address = button.data('myaddress')
            var basic_salary = button.data('mysalary') // Extract info from data-* attributes
            var status = button.data('mystatus')
            var emp_id = button.data('myid')
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this);
            modal.find('.modal-body #full_name').val(full_name);
            modal.find('.modal-body #name_with_init').val(init_name);
            modal.find('.modal-body #designation').val(designation);
            modal.find('.modal-body #dateOfBirth').val(dob);
            // $('#gender').val(gender).trigger('change');
            modal.find('.modal-body #address').val(address);
            modal.find('.modal-body #salary').val(basic_salary);
            modal.find('.modal-body #status').val(status);
            modal.find('.modal-body #emp_id').val(emp_id);

            var array = ["male","female"];
            var html ="";

            for(var i=0; i<array.length ; i++){
                 var selected = "";
                if(array[i] == gender){
                    selected = "selected";
                }
                        html += "<option "+selected+" value='"+array[i]+"'>"+array[i]+"</option>";
            }

             $('#gender').html(html);



        })
</script>
@endsection
