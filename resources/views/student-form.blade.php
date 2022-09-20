@extends('master')
@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Student Form</h4>
                            </div>
                            <div class="card-body">
                                <form action="student-insert" method="POST" id="frm">
                                    @csrf
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
                                                    <input type="text" name="student_name" placeholder="Enter You Full Name"
                                                        class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="container">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Program</label>
                                                    <select name="program_id" class="form-control" id="programs-dropdown">
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
                                                    <input type="number" name="tuition_fee" class="form-control"
                                                        placeholder="Enter Your Adress">
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Stationary Fee</label>
                                                    <input type="number" name="stationary_fee" class="form-control"
                                                        placeholder="Enter Your Permanent Adress">
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="container">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Admission Fee</label>
                                                    <input type="number" name="admission_fee" class="form-control"
                                                        placeholder="Enter Tuition Fee">
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Anual Fee</label>
                                                    <input type="number" name="anual_fee" class="form-control"
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
                                                    <input type="number" name="fine" class="form-control"
                                                        placeholder="Enter Fine">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Date Of Birth</label>
                                                    <input type="date" name="dateofbirth" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container ">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Date Of Admission</label>
                                                    <input type="date" name="dateofadmission" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-6">
                                                <input type="button" class=" container btn btn-danger mb-3" id="reset-form" value="Reset From">

                                            </div>
                                            <div class="col-6">
                                                <button class=" container btn btn-primary mb-3" type="submit">Add Student</button>
                                            </div>
                                        </div>
                                    </div>


                            </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        $(document).ready(function() {

            parentsDropdown();
            programsDropdown();
              //Reset form
              $("#reset-form").click(function(){
                $("form")[0].reset()
            });

            // function to all parents in the dropdown
            function parentsDropdown() {
                $.ajax({
                    url: '/parents-dropdown',
                    method: 'get',
                    success: function(response) {
                        $("#parents-dropdown").html(response);

                    },
                    error: function() {
                        alert("Error: ");
                    }
                });
            }


            // function to show programs on Dropdown
            function programsDropdown() {
                $.ajax({
                    url: '/programs-dropdown',
                    method: 'get',
                    success: function(response) {
                        $("#programs-dropdown").html(response);

                    },
                    error: function() {
                        alert("Error: ");
                    }
                });
            }

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

            //Insert student records to the DataBase Table --start
            $("form").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: '/student-insert',
                    method: 'post',
                    data: $('form').serialize(),
                    success: function() {

                        alert("record has been inserted successfully");
                        $("form")[0].reset()
                    },
                    error: function() {
                        alert("Issue: ");
                    }

                });
            });



        });
    </script>
@endsection
