@extends('master')
@section('content')
    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="alert-after">
                        <h4>Update the Program record</h4>
                    </div>
                    <form id="program-form">
                        @csrf
                        <input type="text" id="program_update_id" name="program_update_id" style="display: none;">
                        <div class="container">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Program Name</label>
                                        <input type="text" id="program-name" name="program_name_update"
                                            placeholder="Enter Program Name" class="form-control">
                                    </div>
                                </div>
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
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Add Program</h4>
                            </div>
                            <div class="card-body">
                                <form id="insert-program">
                                    @csrf
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Program Name</label>
                                                    <input type="text" name="program_name" placeholder="Enter Program Name"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            {{-- <div class="col-6">
                                                <div class="form-group">
                                                    <label style="display: flex;">Status &nbsp;&nbsp;&nbsp; <div
                                                            id="error_phone"> </div></label>
                                                    <select name="status" class="form-control">
                                                        <option value="">Select Status</option>
                                                        <option id="Active" value="Active">Active</option>
                                                        <option id="Deactive" value="Deactive">Deactive</option>
                                                    </select>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>

                                    <input type="submit" id="submit" class=" container btn btn-dark mb-3" value="Submit">
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
                                <h4>Manage Programs</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="myTable">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                                <th>Program</th>
                                                <th>Status</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody id="programsData">
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


                //insert into programs
                $("#insert-program").submit(function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: '/program-insert',
                        method: 'post',
                        data: $('#insert-program').serialize(),
                        success: function() {
                            fetchAllprograms();
                            alert("record has been inserted succeflly");
                            $("#insert-program")[0].reset()
                        },
                        error: function() {
                            alert("Error: ");
                        }

                    });
                    fetchAllprograms();
                });

                //CLose btn Upadte Modal
                $('.reload-records').click(function() {
                    fetchAllprograms();
                    $('#success').remove();
                });

                fetchAllprograms();
                // function to show programs
                function fetchAllprograms() {

                    $.ajax({
                        url: '/fetchall-programs',
                        method: 'get',
                        success: function(response) {
                            $("#programsData").html(response);
                            var table = $('#myTable').DataTable();
                        },
                        error: function() {
                            alert("Error: ");
                        }


                    });
                }


                // show the saved data to the modal
                $(document).on('click', '.editIcon', function(e) {
                    e.preventDefault();
                    let id = $(this).attr('id');
                    $.ajax({
                        url: '/program-edit',
                        method: 'get',
                        data: {
                            id: id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            console.log(response);
                            $("#program-name").val(response[0].program_name);
                            $("#program_update_id").val(response[0].program_id);


                            if (response[0].status == "Active") {
                                $("#Active").attr("selected", "selected");
                            } else {
                                $("#Deactive").attr("selected", "selected");
                            }
                        }
                    });
                });



                //Update Program
                $("#program-form").submit(function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: '/program-update',
                        method: 'POST',
                        data: $(this).serialize(),
                        success: function(response) {
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
