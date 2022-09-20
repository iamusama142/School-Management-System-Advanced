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
                                <h4>Passing Out Classes Form</h4>
                            </div>
                            <div class="card-body">
                                <form id="frm" action="/passoutstudent/pasout" method="post">
                                    @csrf

                                    <div class="container">
                                        <div class="row">

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label> Class</label>
                                                    <select name="class_id" class="form-control" id="classes-dropdown">
                                                        <option value=""> Class</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Section</label>
                                                    <select name="section_id" class="form-control" id="sections-dropdown">
                                                        <option value="">Select Section</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </div>










                                    <button id="promote-submit" class=" container btn btn-primary mb-3"
                                        type="submit">Passout</button>
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


                Classdropdown();





                // function to show classes on Dropdown
                function Classdropdown() {

                    $.ajax({
                        url: '/promote/fetch_classes',
                        type: 'get',
                        data: ' &_token={{ csrf_token() }}',
                        success: function(result) {
                            $('#classes-dropdown').html(result);
                            $('#classes-dropdown-new').html(result);
                        },
                        error: function() {
                            alert("Issue");

                        }
                    });
                };


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
                // function to show sections on Dropdown
                $('#classes-dropdown-new').change(function() {
                    let class_id = $(this).val();
                    $('#rolls-dropdown').html('<option value="">Select Roll No.</option>');
                    $.ajax({
                        url: '/sections-dropdown',
                        type: 'post',
                        data: 'class_id=' + class_id + ' &_token={{ csrf_token() }}',
                        success: function(result) {
                            $('#sections-dropdown-new').html(result);
                        },
                        error: function() {
                            alert("Issue");

                        }
                    });
                });



                // //Insert student records to the DataBase Table --start
                $("form").submit(function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: '/passoutstudent/pasout',
                        method: 'post',
                        data: $('form').serialize(),
                        success: function() {
                            alert("Opeartion has been  successfully Done ");
                            $("form")[0].reset();

                        },
                        error: function() {
                            alert("Issue: in insert");
                        }

                    });
                });



            });
        </script>
    @endsection
