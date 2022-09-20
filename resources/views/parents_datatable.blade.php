@extends('master')
@section('content')
    {{-- Model to pay fees --}}
    <div class="container">
        <!-- The Modal -->
        <div class="modal" id="pay">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="container fee-alert-after">
                            <form id="month-feeses">
                                @csrf
                                <input type="number" id="firstpendingmonth" name="firstpendingmonth" style="display:none ;">
                                <input type="hidden" id="fee_parent_id" name="parent_id" style="display:none ;">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>For Month</label>
                                            <select name="month_fee" id="months-fee" class="form-control" required>
                                                <option value="">Select Months to pay</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label style="display: flex">Click btn to Collect fee</label>
                                            <button type="submit" class="btn btn-success collectbtn">Collect</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>

    </div>


    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="alert-after">
                        <h4>Update the Parrent record</h4>
                    </div>
                    <form id="parent-form">
                        @csrf
                        <input type="text" id="parent_update_id" name="id" style="display: none;">
                        <div class="container">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" id="name" name="parent_name" placeholder="Enter You Full Name"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label style="display: flex">Phone &nbsp;&nbsp;&nbsp; <div id="error_phone"> </div>
                                        </label>
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
                                        <select name="gender" class="form-control" id="gender" required>
                                            <option value="">Select your Gender</option>
                                            <option id="Male" value="Male">Male</option>
                                            <option id="Female" value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label style="display: flex">CNIC &nbsp;&nbsp;&nbsp; <div id="error_cnic"> </div>
                                        </label>
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
                                        <input type="text" id="address" name="address" placeholder="Address"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label style="display: flex">Email &nbsp;&nbsp;&nbsp; <div id="error_email"> </div>
                                        </label>
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
                                        <input type="text" name="about" id="about" placeholder="Enter Your About"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="text" id="password" name="password" class="form-control"
                                            placeholder="Enter Your Password here">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="container">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control" id="status">
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
                                <h4>Parents Record</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="myTable">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                                <th>Parent Name</th>
                                                <th>Phone Number</th>
                                                <th>CNIC</th>
                                                <th>Status</th>
                                                <th>Remaining Fee</th>
                                                <th>Action </th>
                                                <th>Vouchers</th>
                                                <th>Fee Collect</th>

                                            </tr>
                                        </thead>
                                        <tbody id="parentsData">
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


                //functionCall Populate parent
                fetchAllparents();

                //function Populate parent records to the parent DataTable --start
                function fetchAllparents() {
                    $.ajax({
                        url: '/fetchall-parents',
                        method: 'get',
                        success: function(response) {
                            $("#parentsData").html(response);
                            var table = $('#myTable').DataTable();

                        }
                    });
                }
                //function Populate parent records to the parent DataTable --end


                //COllect fees to the DataBase Table --start
                $("#month-feeses").submit(function(e) {
                    e.preventDefault();
                    let firstpendingmonth = $("#firstpendingmonth").val();

                    $.ajax({
                        url: '/collect-fees',
                        method: 'POST',
                        data: $(this).serialize(),
                        success: function(response) {
                            fetchAllparents();
                            if (response.status == 200) {
                                alert("Fee has been paid");
                                console.log(response.remaining);

                                window.open(
                                    '/collected-fee-voucher/' + response.parent_id +
                                    '?month=' +
                                    response.month + '&firstpendingmonth=' +
                                    firstpendingmonth + '&remaining=' + response.remaining,
                                    '_blank' // <- This is what makes it open in a new tab.
                                );

                            }

                        },
                        error: function() {
                            alert("issue : ");
                        }

                    });
                });
                //COllect fees to the DataBase Table  --end


                //function to show months fee pending --start
                $(document).on('click', '.months_fee', function(e) {
                    e.preventDefault();
                    let parent_id = $(this).attr('id');

                    $.ajax({
                        url: '/fetchall-months',
                        method: 'get',
                        data: {
                            parent_id: parent_id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            $("#months-fee").html(response[0]);
                            $("#fee_parent_id").val(response[1]);
                            $("#firstpendingmonth").val(response[2].month);
                            //firstpendingmonth

                        },
                        error: function() {
                            alert('Issue');
                        }
                    });
                });
                //function to show months fee pending --end



                //fetch parent records to the update parent modal --start
                $(document).on('click', '.editIcon', function(e) {
                    e.preventDefault();
                    let id = $(this).attr('id');
                    $.ajax({
                        url: '/parent-edit',
                        method: 'get',
                        data: {
                            id: id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {

                            $("#name").val(response[0].parent_name);
                            $("#phone").val(response[0].phone);
                            $("#cnic").val(response[0].cnic);
                            $("#address").val(response[0].address);
                            $("#email").val(response[0].email);
                            $("#about").val(response[0].about);
                            $("#password").val(response[0].password);
                            $("#parent_update_id").val(response[0].parent_id);
                            if (response[0].status == "Active") {
                                $("#Active").attr("selected", "selected");
                            } else {
                                $("#Deactive").attr("selected", "selected");
                            }
                            if (response[0].gender == "Male") {
                                $("#Male").attr("selected", "selected");
                            } else {
                                $("#Female").attr("selected", "selected");
                            }
                        }
                    });
                });
                //fetch parent records to the update parent modal --end

                //update parent records to the DataBase Table --start
                $("form").submit(function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: '/parent-update',
                        method: 'POST',
                        data: $(this).serialize(),
                        success: function(response) {
                            if (response.status == 200) {
                                $('.alert-after').append(
                                    ' <div id="success" class=\"alert alert-info alert-dismissible fade show\">    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>Parent <strong>Record!</strong> has been Updated Sucessfuly..  </div>                '
                                );
                            }
                        },
                        error: function() {
                            alert("Error: ");
                        }

                    });
                });
                //update parent records to the DataBase Table --end




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
                $('#phone').on('keypress keyup keydown change', function() {
                    var phone = $('#phone').val();
                    var id = $('#parent_update_id').val();
                    var token = $('input[name="_token"]').val();
                    $.ajax({
                        type: "POST",
                        url: '/parents-update-duplicate-phone',
                        data: {
                            phone: phone,
                            id: id,
                            _token: token
                        },
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
                $('#email').on('keypress keyup keydown change', function() {
                    var email = $('#email').val();
                    $.ajax({
                        type: "POST",
                        url: '/parents-update-duplicate-email',
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
                $('#cnic').on('keypress keyup keydown change', function() {
                    var cnic = $('#cnic').val();
                    $.ajax({
                        type: "POST",
                        url: '/parents-update-duplicate-cnic',
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
                    }
                }
                //Disable the submit btn to prevent uniqueless cnic phone and email --end

                //Close btn of modal
                $('.reload-records').click(function() {
                    fetchAllparents();
                    success
                    $('#success').remove();
                    $('#error_phone').html('');
                    $('#error_email').html('');
                    $('#error_cnic').html('');

                });

            });
        </script>
    @endsection
