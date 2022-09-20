@extends('master')
@section('content')
    <!-- The Modal -->
    <div class="modal" id="myModal" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="alert-after">
                        <h4>Update the Section record</h4>
                    </div>
                    <form id="section-form-update">
                        @csrf
                        <input type="text" id="section_update_id" name="section_update_id" style="display: none;">
                        <div class="container">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Section Name</label>
                                        <input type="text" name="section_name_update" id="section_name_update"
                                            placeholder="Enter Section Name" class="form-control">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status_update" class="form-control" id="status_update" required>
                                            <option value="">Select Status</option>
                                            <option>Active</option>
                                            <option>Deactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <input type="submit" id="sbumit" class=" container btn btn-primary mb-3 "
                                            value="Update">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <button type="button" class=" container btn btn-danger reload-records"
                                            data-dismiss="modal">
                                            Close
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Add Section</h4>
                            </div>
                            <div class="card-body">
                                <form id="insert-section">
                                    @csrf
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Section Name</label>
                                                    <input type="text" name="section_name" placeholder="Enter Section Name"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label style="display: flex;">Select Class &nbsp;&nbsp;&nbsp; <div
                                                            id="error_phone"> </div></label>
                                                    <select id="classes-dropdown" name="class_id" class="form-control">

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="container">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Roll NO. Start</label>
                                                    <input type="number" name="rollno_start" placeholder="Enter Roll"
                                                        class="form-control" min=0>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Roll No. End</label>
                                                    <input type="number" name="rollno_end" placeholder="Enter Section Name"
                                                        class="form-control" min=0>
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                    <input type="submit" id="" class="container btn btn-dark mb-3 reload-records"
                                        value="Submit">
                            </div>
                        </div>
                        {{-- <button class=" container btn btn-dark mb-3">Submit</button> --}}

                        </form>
                    </div>
                </div>


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Manage Sections</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="myTable">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                                <th>Section</th>
                                                <th>Class</th>
                                                <th>Status</th>
                                                <th>Roll Start</th>
                                                <th>Roll end</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody id="classsData">
                                            {{-- Data will be here --}}

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        {{-- Bootstrap 4 Model  Update data show in form --}}

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
            $(document).ready(function() {



                $('.reload-records').click(function() {
                    $('.success').remove();
                    fetchAllsection();

                });



                programDropdown();
                fetchAllsection();

                // function to show class on Dropdown
                function programDropdown() {
                    $.ajax({
                        url: '/fetch_classes',
                        method: 'get',
                        success: function(response) {
                            $("#classes-dropdown").html(response);

                        },
                        error: function() {
                            alert("Error: ");
                        }
                    });
                }



                // function to show classs
                function fetchAllsection() {
                    $.ajax({
                        url: '/fetchall-section',
                        method: 'get',
                        success: function(response) {
                            $("#classsData").html(response);
                            var table = $('#myTable').DataTable();
                        },
                        error: function() {
                            alert("Error: ");
                        }
                    });
                }

                //insert into section
                $("#insert-section").submit(function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: '/section-insert',
                        method: 'post',
                        data: $('#insert-section').serialize(),
                        success: function(response) {
                            console.log(response);

                            alert("record has been inserted successfully");
                            $("#insert-section")[0].reset();
                            fetchAllsection();
                            programDropdown();
                        },
                        error: function() {
                            alert("Error: ");
                        }

                    });

                });

                //update subject record
                $("#section-form-update").submit(function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: ' /sections/update',
                        method: 'POST',
                        data: $(this).serialize(),
                        success: function(response) {
                            console.log(response);

                            if (response.status == 200) {
                                $('.alert-after').append(
                                    ' <div id="success" class=\" success alert alert-info alert-dismissible fade show\">    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>Parent <strong>Record!</strong> has been Updated Sucessfuly..  </div>                '
                                );
                            }
                        },
                        error: function() {
                            alert("Issue");
                            $('.alert-after').append(
                                ' <div id="success" class=\"success alert alert-danger alert-dismissible fade show\">    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>Student Record! has been Updation <b>Failed</b>..  </div>                '
                            );

                        }

                    });
                });

                //fetch subject  records to the edit subjects table in db --start
                $(document).on('click', '.update', function(e) {
                    e.preventDefault();
                    let id = $(this).attr('id');
                    $.ajax({
                        url: '/sections/edit',
                        method: 'get',
                        data: {
                            id: id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {

                            $('#section_name_update').val(response[0].section_name);
                            $('#status_update').val(response[0].status);
                            $('#section_update_id').val(response[0].section_id);


                        },
                        error: function() {
                            alert("Error: ");
                        }

                    });
                });

            });
        </script>
    @endsection
