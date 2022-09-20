@extends('master')
@section('content')
    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="alert-after">
                        <h4>Update the Classes record</h4>
                    </div>
                    <form id="subject-form-update">
                        @csrf
                        <input type="text" id="subject_update_id" name="subject_update_id" style="display:none ;">
                        <div class="container">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Subject Name</label>
                                        <input type="text" name="subject_name_update" id="subject_name_update"
                                            placeholder="Enter Subject Name" class="form-control" min=0 required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label style="display: flex;">Select Class</label>
                                        <select id="class-dropdown-update" name="class_id_update" class="form-control"
                                            required>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label style="display: flex;">Select Section</label>
                                        <select id="section-dropdown-update" name="section_id_update" class="form-control"
                                            required>
                                            <option value=""> Select</option>
                                        </select>
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
                                <h4>Add new Subjects</h4>
                            </div>
                            <div class="card-body">
                                <form id="insert-subject">
                                    @csrf
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label style="display: flex;">Select Class</label>
                                                    <select id="class-dropdown" name="class_id" class="form-control">

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label style="display: flex;">Select Section</label>
                                                    <select id="section-dropdown" name="section_id" class="form-control">
                                                        <option value=""> Select</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label>Subject Name</label>
                                                    <input type="text" name="subject_name" placeholder="Enter Subject Name"
                                                        class="form-control" min=0>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="container">
                                        <div class="row">
                                            <div class="col-2">

                                                <input type="submit" id="submit"
                                                    class="container btn btn-primary mb-3 reload-records" value="Add">
                                            </div>
                                        </div>
                                    </div>


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
                                                <th>Subject</th>
                                                <th>Class</th>
                                                <th>Section</th>
                                                <th>Status</th>
                                                <th>Action</th>


                                            </tr>
                                        </thead>
                                        <tbody id="subjectsData">
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



                programDropdown();
                fetchAllSubjects();
                $('.reload-records').click(function() {
                    $('.success').remove();
                    fetchAllSubjects();

                });


                function fetchAllSubjects() {
                    $.ajax({
                        url: '/subjects/fetchAllsubjects',
                        method: 'get',
                        success: function(response) {
                            $("#subjectsData").html(response);
                            var table = $('#myTable').DataTable();
                        },
                        error: function() {
                            alert("Issue");

                        }
                    });
                }



                //fetch subject  records to the edit subjects table in db --start
                $(document).on('click', '.update', function(e) {
                    e.preventDefault();
                    let id = $(this).attr('id');
                    $.ajax({
                        url: '/subjects/edit',
                        method: 'get',
                        data: {
                            id: id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {

                            $('#subject_name_update').val(response[0].subject_name);
                            $('#class-dropdown-update').html(response[1]);
                            $('#status_update').val(response[0].Status);
                            $('#subject_update_id').val(response[0].subject_id);
                            $('#section-dropdown-update').html(response[2]);

                        },
                        error: function() {
                            alert("Error: ");
                        }

                    });
                });
                //update subject record
                $("#subject-form-update").submit(function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: '/subjects/update',
                        method: 'POST',
                        data: $(this).serialize(),
                        success: function(response) {

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



                // function to show class on Dropdown
                function programDropdown() {
                    $.ajax({
                        url: '/fetch_classes',
                        method: 'get',
                        success: function(response) {
                            $("#class-dropdown").html(response);

                        },
                        error: function() {
                            alert("Error: ");
                        }
                    });
                }




                //Insert Subjects records to the DataBase Table --start
                $("#insert-subject").submit(function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: '/subject-insert',
                        method: 'post',
                        data: $('#insert-subject').serialize(),
                        success: function() {
                            alert("record has been inserted successfully");
                            $("#insert-subject")[0].reset()
                            fetchAllSubjects();
                        },
                        error: function() {
                            alert("Error: ");
                        }

                    });
                });
                //Insert Subjects records to the DataBase Table --end

                // function to show sections on Dropdown
                $('#class-dropdown').change(function() {
                    let class_id = $(this).val();

                    $.ajax({
                        url: '/dateSheet/sections-dropdown',
                        type: 'post',
                        data: 'class_id=' + class_id + ' &_token={{ csrf_token() }}',
                        success: function(result) {
                            $('#section-dropdown').html(result);

                        },
                        error: function() {
                            alert("Issue");

                        }
                    });
                });

                // function to show sections on Dropdown
                $('#class-dropdown-update').change(function() {
                    let class_id = $(this).val();

                    $.ajax({
                        url: '/dateSheet/sections-dropdown',
                        type: 'post',
                        data: 'class_id=' + class_id + ' &_token={{ csrf_token() }}',
                        success: function(result) {
                            $('#section-dropdown-update').html(result);

                        },
                        error: function() {
                            alert("Issue");

                        }
                    });
                });



            });
        </script>
    @endsection
