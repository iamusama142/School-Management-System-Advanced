@extends('master')
@section('content')
    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="alert-after">
                        <h4>Update the Class record</h4>
                    </div>
                    <form id="class-form">
                        @csrf
                        <input type="text" id="class_update_id" name="class_update_id" style="display: none;">
                        <div class="container">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Class Name</label>
                                        <input type="text" id="class-name" name="class_name_update"
                                            placeholder="Enter class Name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Program</label>
                                        <select name="program_update" class="form-control" id="program-update-dropdown">
                                            <option value="">Select Program</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status_update" class="form-control" id="status">
                                            <option value="">Select Status</option>
                                            <option id="Active" value="Active">Active</option>
                                            <option id="Deactive" value="Deactive">Deactive</option>
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
                                <h4>Add Class</h4>
                            </div>
                            <div class="card-body">
                                <form id="insert-class">
                                    @csrf
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Class Name</label>
                                                    <input type="text" name="class_name" placeholder="Enter Class Name"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label style="display: flex;">Program &nbsp;&nbsp;&nbsp; <div
                                                            id="error_phone"> </div></label>
                                                    <select id="program-dropdown" name="program_id" class="form-control">

                                                    </select>
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
                                <h4>Manage Classes</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="myTable">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                                <th>Class</th>
                                                <th>Program</th>
                                                <th>Status</th>
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




                // CLose btn Upadte Modal
                $('.reload-records').click(function() {
                    fetchAllclasss();

                    $('#success').remove();
                });




                programDropdown();
                fetchAllclasss();

                // function to show programs on Dropdown
                function programDropdown() {
                    $.ajax({
                        url: '/fetch-programs',
                        method: 'get',
                        success: function(response) {
                            $("#program-dropdown").html(response);

                        },
                        error: function() {
                            alert("Error: ");
                        }
                    });
                }



                // function to show classs
                function fetchAllclasss() {
                    $.ajax({
                        url: '/fetchall-class',
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

                //insert into classs
                $("#insert-class").submit(function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: '/class-insert',
                        method: 'post',
                        data: $('#insert-class').serialize(),
                        success: function(response) {

                            alert("record has been inserted successfully");
                            $("#insert-class")[0].reset();
                            fetchAllclasss();
                            programDropdown();
                        },
                        error: function() {
                            alert("Error: ");
                        }

                    });

                });




                //show the saved data to the modal
                $(document).on('click', '.editIcon', function(e) {
                    e.preventDefault();
                    let id = $(this).attr('id');
                    $.ajax({
                        url: '/class-edit',
                        method: 'get',
                        data: {
                            id: id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            console.log(response);
                            console.log(response[0][0].class_id);

                            $("#class-name").val(response[0][0].class_name);
                            $("#class_update_id").val(response[0][0].class_id);

                            if (response[0][0].status == "Active") {
                                $("#Active").attr("selected", "selected");
                            } else {
                                $("#Deactive").attr("selected", "selected");
                            }

                            $("#program-update-dropdown").html(response[1]);


                        },
                        error: function(response) {
                            alert('Issue');
                        }
                    });
                });

                //Update Classes
                $("#class-form").submit(function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: '/class-update',
                        method: 'POST',
                        data: $(this).serialize(),
                        success: function(response) {
                            fetchAllclasss();
                            programDropdown();

                            if (response.status == 200) {
                                $('.alert-after').append(
                                    ' <div id="success" class=\"alert alert-info alert-dismissible fade show\">    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>Program <strong>Record!</strong> has been Updated Sucessfuly..  </div>                '
                                );
                            }
                        },
                        error: function() {
                            alert("Error: ");
                        }

                    });
                });

            });
        </script>
    @endsection
