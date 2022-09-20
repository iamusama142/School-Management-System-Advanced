@extends('master')
@section('content')
    <!-- The Student Modal -->
    <div class="modal fade" id="myModal" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="alert-after">
                        <h4>Update the Student record</h4>
                    </div>
                    <form id="update-form">
                        @csrf
                        <input type="text" id="student_last_roll_id" name="student_last_roll_id" style="display:none ;">
                        <input type="text" id="student_update_id" name="student_update_id" style="display:none ;">
                        <div class="container">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Parent </label>
                                        <select name="parent_id" class="form-control" id="parents-dropdown">
                                            <option value="">Select Parent</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Student Name*</label>
                                        <input type="text" id="student_name" name="student_name"
                                            placeholder="Enter You Full Name" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="container">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Program</label>
                                        <select name="program_id" id="programs-dropdown" class="form-control"
                                            id="programs-dropdown">
                                            <option value="">Select Program</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Class</label>
                                        <select name="class_id" class="form-control" id="classes-dropdown">
                                            <option value="">Select Class</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="container">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Section</label>
                                        <select name="section_id" class="form-control" id="sections-dropdown">
                                            <option value="">Select Section</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Roll no.</label>
                                        <select name="roll_id" class="form-control" id="rolls-dropdown">
                                            <option value="">Select Roll No.</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="container">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Tuition Fee</label>
                                        <input type="number" name="tuition_fee" id="tuition_fee" class="form-control"
                                            placeholder="Enter Your Adress">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Stationary Fee</label>
                                        <input type="number" name="stationary_fee" id="stationary_fee"
                                            class="form-control" placeholder="Enter Your Permanent Adress">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="container">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Admission Fee</label>
                                        <input type="number" name="admission_fee" id="admission_fee" class="form-control"
                                            placeholder="Enter Tuition Fee">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Anual Fee</label>
                                        <input type="number" name="anual_fee" id="anual_fee" class="form-control"
                                            placeholder="Enter Annual Fee">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Fine</label>
                                        <input type="number" name="fine" id="fine" class="form-control"
                                            placeholder="Enter Fine">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Date Of Birth</label>
                                        <input type="date" name="dateofbirth" id="dateofbirth" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container ml-2">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Date Of Admission</label>
                                        <input type="date" name="dateofadmission" id="dateofadmission"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" id="status-dropdown" class="form-control" required>
                                            <option value="">Select Status</option>
                                            <option>Active</option>
                                            <option>Deactive</option>
                                            <option>Passed</option>
                                            <option>Passout</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="container">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <input type="submit" id="sbumit" class=" container btn btn-primary mb-3"
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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Student Record</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="myTable">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                                <th>Student Name</th>
                                                <th>Parent Name</th>
                                                <th>Program</th>
                                                <th>Class</th>
                                                <th>Section</th>
                                                <th>Roll No.</th>
                                                <th>Date of Birth</th>
                                                <th>Date of Admission</th>
                                                <th>Tuition Fee</th>
                                                <th>Stationary Fee</th>
                                                <th>Admission Fee</th>
                                                <th>Annual Fee</th>
                                                <th>Fine</th>
                                                <th>status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="student-data">


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <script>
            $(document).ready(function() {
                //function fetchallStd();
                fetchAllStd();
                $('.reload-records').click(function() {
                    $('.success').remove();
                    fetchAllStd();

                });


                function fetchAllStd() {
                    $.ajax({
                        url: '/student/fetchallStd',
                        method: 'get',
                        success: function(response) {
                            $("#student-data").html(response);
                            var table = $('#myTable').DataTable();

                        },
                        error: function() {
                            alert("Issue");

                        }

                    });
                }

                //fetch student  records to the update parent modal --start
                $(document).on('click', '.update', function(e) {
                    e.preventDefault();
                    let id = $(this).attr('id');
                    $.ajax({
                        url: '/students/edit',
                        method: 'get',
                        data: {
                            id: id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {

                            $("#parents-dropdown").html(response[1]);
                            $("#student_name").val(response[0].student_name);
                            $("#programs-dropdown").html(response[2]);
                            $("#classes-dropdown").html(response[3]);
                            $("#sections-dropdown").html(response[4]);
                            $("#rolls-dropdown").html(response[5]);
                            $("#tuition_fee").val(response[0].tuition_fee);
                            $("#anual_fee").val(response[0].anual_fee);
                            $("#stationary_fee").val(response[0].anual_fee);
                            $("#admission_fee").val(response[0].admission_fee);
                            $("#fine").val(response[0].fine);
                            $("#dateofbirth").val(response[0].dateofbirth);
                            $("#dateofadmission").val(response[0].dateofadmission);
                            $("#status-dropdown").val(response[0].Status);
                            $("#student_last_roll_id").val(response[6]);
                            $("#student_update_id").val(response[0].student_id);

                        },
                        error: function() {
                            alert("Error: ");
                        }

                    });
                });


                $("form").submit(function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: '/student/update',
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



                // function fetchallStd() {
                //     $.ajax({
                //         url: '/student/fetchallStd',
                //         type: 'get',
                //         data: {

                //             _token: '{{ csrf_token() }}'
                //         },
                //         success: function(result) {
                //             console.log(result);
                //             $('#student-data').html(result);
                //             var table = $('#myTable').DataTable();
                //         },
                //         error: function() {
                //             alert("Issue");

                //         }
                //     });
                // }

                // function to show classes on Dropdown
                $('#programs-dropdown').change(function() {
                    let program_id = $(this).val();
                    $('#sections-dropdown').html('<option value="">Select Section</option>');
                    $('#rolls-dropdown').html('<option value="">Select Roll No.</option>');
                    $.ajax({
                        url: '/classes-dropdown',
                        type: 'post',
                        data: 'program_id=' + program_id + ' &_token={{ csrf_token() }}',
                        success: function(result) {
                            $('#classes-dropdown').html(result);
                        },
                        error: function() {
                            alert("Issue");

                        }
                    });
                });


                // function to show sections on Dropdown
                $('#classes-dropdown').change(function() {
                    let class_id = $(this).val();
                    $('#rolls-dropdown').html('<option value="">Select Roll No.</option>');
                    $.ajax({
                        url: '/sections-dropdown',
                        type: 'post',
                        data: 'class_id=' + class_id + ' &_token={{ csrf_token() }}',
                        success: function(result) {
                            $('#sections-dropdown').html(result);
                        },
                        error: function() {
                            alert("Issue");

                        }
                    });
                });

                // function to show Rolls on Dropdown
                $('#sections-dropdown').change(function() {
                    let section_id = $(this).val();
                    $.ajax({
                        url: '/rolls-dropdown',
                        type: 'post',
                        data: 'section_id=' + section_id + ' &_token={{ csrf_token() }}',
                        success: function(result) {
                            $('#rolls-dropdown').html(result);
                        },
                        error: function() {
                            alert("Issue");

                        }
                    });
                });

            });
        </script>
    @endsection
