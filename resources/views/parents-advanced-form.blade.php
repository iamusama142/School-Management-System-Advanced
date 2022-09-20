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
                                <h4>Add new Parent</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="/parents-insert">
                                    @csrf
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" name="parent_name" placeholder="Enter You Full Name"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label style="display: flex">Phone &nbsp;&nbsp;&nbsp; <div
                                                            id="error_phone"> </div></label>
                                                    <input type="text" id="phone" name="phone" class="form-control"
                                                        placeholder="Enter Full Name">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Gender</label>
                                                    <select name="gender" class="form-control" id="" required>
                                                        <option value="">Select your Gender</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label style="display: flex">CNIC &nbsp;&nbsp;&nbsp; <div
                                                            id="error_cnic"> </div></label>
                                                    <input type="text" id="cnic" name="cnic" class="form-control"
                                                        placeholder="Enter Your cnic">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="container">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <input type="text" name="address" placeholder="Address"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label style="display: flex">Email &nbsp;&nbsp;&nbsp; <div
                                                            id="error_email"> </div></label>
                                                    <input type="email" id="email" name="email" class="form-control"
                                                        placeholder="Enter Your Email here">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="container">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>About</label>
                                                    <input type="text" name="about" placeholder="Enter Your About"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input type="password" name="password" class="form-control"
                                                        placeholder="Enter Your Password here">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container">
                                        <div class="row">
                                            {{-- <div class="col-6">
                                                <input type="button" id="reset-form" class=" container btn btn-danger mb-3" value="Reset From">

                                            </div> --}}
                                            <div class="col-12">
                                                <input type="submit" id="submit" class=" container btn btn-primary" value="Add Parent">
                                            </div>
                                        </div>
                                    </div>

                            </div>
                        </div>
                        {{-- <button class=" container btn btn-dark mb-3">Submit</button> --}}

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
            //Insert parent records to the DataBase Table --start
            $("form").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: '/parents-insert',
                    method: 'post',
                    data: $('form').serialize(),
                    success: function() {
                        alert("record has been inserted successfully");
                        $("form")[0].reset()
                    },
                    error: function() {
                        alert("Error: ");
                    }

                });
            });
            //Insert parent records to the DataBase Table --end
            //Reset form
            $("#reset-form").click(function(){
                $("form")[0].reset()
            });
            //Validate unique parent phone number  --start
            var dphone = 0;
            $.ajaxSetup({
                beforeSend: function(xhr, type) {
                    if (!type.crossDomain) {
                        xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr(
                            'content'));
                    }
                },
            });
            $('#phone').blur(function() {
                var phone = $('#phone').val();
                $.ajax({
                    type: "POST",
                    url: '/parents-insert-duplicate-phone',
                    data: $('form').serialize(),
                    success: function(res) {
                        if (res.exists == true) {
                            $("#phone_error").remove();
                            $('#error_phone').html(
                                '<label id=\"phone_error \" class="text-success">Valid</label>'
                            );
                            dphone = 1;
                            disable_submit();
                        } else {
                            $("#phone_error").remove();
                            $('#error_phone').html(
                                '<label id=\"phone_error \" class=\"text-danger\"> *Phone number Already Exist! </label>'
                            );
                            dphone = 0;
                        }
                    },
                    error: function(jqXHR, exception) {
                        alert('Issue');
                    }
                });
            });
            //Validate unique parent phone number  --end



            //Validate unique parent email  --start
            var demail = 0;
            $.ajaxSetup({
                beforeSend: function(xhr, type) {
                    if (!type.crossDomain) {
                        xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr(
                            'content'));
                    }
                },
            });
            $('#email').blur(function() {
                var email = $('#email').val();
                $.ajax({
                    type: "POST",
                    url: '/parents-insert-duplicate-email',
                    data: $('form').serialize(),
                    success: function(res) {
                        if (res.exists == true) {
                            $("#email_error").remove();
                            $('#error_email').html(
                                '<label id=\"email_error \" class="text-success">Valid</label>'
                            );
                            demail = 1;
                            disable_submit();
                        } else {
                            $("#email_error").remove();
                            $('#error_email').html(
                                '<label id=\"email_error \" class=\"text-danger\"> *Email Already Exist! </label>'
                            );
                            demail = 0;
                        }
                    },
                    error: function(jqXHR, exception) {
                        alert('Issue');
                    }
                });
            });
            //Validate unique parent email  --end


            //Validate unique parent cnic  --start
            var dcnic = 0;
            $.ajaxSetup({
                beforeSend: function(xhr, type) {
                    if (!type.crossDomain) {
                        xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr(
                            'content'));
                    }
                },
            });
            $('#cnic').blur(function() {
                var cnic = $('#cnic').val();
                $.ajax({
                    type: "POST",
                    url: '/parents-insert-duplicate-cnic',
                    data: $('form').serialize(),
                    success: function(res) {
                        if (res.exists == true) {
                            $("#cnic_error").remove();
                            $('#error_cnic').html(
                                '<label id=\"cnic_error \" class="text-success">Valid</label>'
                            );
                            dcnic = 1;
                            disable_submit();
                        } else {
                            $("#cnic_error").remove();
                            $('#error_cnic').html(
                                '<label id=\"cnic_error \" class=\"text-danger\"> *CNIC Already Exist! </label>'
                            );
                            dcnic = 0;
                        }
                    },
                    error: function(jqXHR, exception) {
                        alert('Issue');
                    }
                });
            });
            //Validate unique parent email  --end

            //Disable the submit btn to prevent uniqueless cnic phone and email --start
            function disable_submit() {
                if (dphone == 1 && demail == 1 && dcnic == 1) {

                    $('#submit').attr('disabled', false);
                } else {
                    $('#submit').attr('disabled', 'disable');
                }
            }
            //Disable the submit btn to prevent uniqueless cnic phone and email --end

        });
    </script>

@endsection
