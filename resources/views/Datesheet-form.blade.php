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
                                <h4>Make new DateSheet</h4>
                            </div>
                            <div class="card-body">
                                <form>
                                    @csrf
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label>Title</label>
                                                    <input type="text" placeholder="Title of the DateSheet" name="title"
                                                        class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label>Class</label>
                                                    <select name="class_id" class="form-control" id="class_Dropdown"
                                                        required>
                                                        <option value="">Select Class</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label style="display: flex">Section</label>
                                                    <select name="section_id" class="form-control" id="sectionDropdwon"
                                                        required>
                                                        <option value="">Select Section</option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="well clearfix">
                                            <a class="btn btn-primary pull-right add-record text-white"
                                                style="display:none;" data-added="0"> Add
                                                Row</a>
                                        </div> --}}
                                        <table class="table table-bordered" id="tbl_posts">
                                            <thead>
                                                <tr>

                                                    <th>Date</th>
                                                    <th>Day</th>
                                                    <th>Time Start</th>
                                                    <th>Time End</th>
                                                    <th>Subject</th>

                                                </tr>
                                            </thead>
                                            <tbody id="tbl_posts_body">
                                                <tr class="rows-0">
                                                    <td><input type="date" name="date" class="form-control"></td>
                                                    <td><select name="day" id="" class="form-control">
                                                            <option value="">Day</option>
                                                            <option value="Monday">Monday</option>
                                                            <option value="Tuesday">Tuesday</option>
                                                            <option value="Wednesday">Wednesday</option>
                                                            <option value="Thursday">Thursday</option>
                                                            <option value="Friday">Friday</option>
                                                            <option value="Saturday">Saturday</option>
                                                            <option value="Sunday">Sunday</option>
                                                        </select></td>
                                                    <td><input type="time" name="time_start" class="form-control"></td>
                                                    <td><input type="time" name="time_end" class="form-control"></td>
                                                    <td><select name="subject" id="" class="form-control subjectDropdown">
                                                            <option value=""> Subject</option>
                                                        </select></td>
                                                    {{-- <td>
                                                        <a class="btn btn-info delete-record" data-id="1">remove</a>
                                                    </td> --}}
                                                </tr>

                                            </tbody>
                                        </table>
                                        {{-- <button class=" container btn btn-dark mb-3">Submit</button> --}}
                                        <input type="submit" id="submit" class=" container btn btn-dark mb-3"
                                            value="Submit">
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

                var Rows = 0;





                function rows_fu() {
                    var ligne = '<tr  class="rows-0" >' +
                        '                                                    <td><input type="date" name="date[]" class="form-control" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" required></td>' +
                        '                                                    <td><select name="day[]" id="" class="form-control" required>' +
                        '                                                            <option value="">Day</option>' +
                        '                                                            <option value="Monday">Monday</option>' +
                        '                                                            <option value="Tuesday">Tuesday</option>' +
                        '                                                            <option value="Wednesday">Wednesday</option>' +
                        '                                                            <option value="Thursday">Thursday</option>' +
                        '                                                            <option value="Friday">Friday</option>' +
                        '                                                            <option value="Saturday">Saturday</option>' +
                        '                                                            <option value="Sunday">Sunday</option>' +
                        '                                                        </select></td>' +
                        '                                                    <td><input type="time" name="time_start[]" class="form-control" required></td>' +
                        '                                                    <td><input type="time" name="time_end[]" class="form-control" required></td>' +
                        '                                                    <td><select name="subject_id[]" id="" class="form-control subjectDropdown" required>' +
                        '                                                            <option value="">Subject</option>' +
                        '                                                        </select></td>' +
                        // '                                                    <td>' +
                        // '                                                        <a class="btn btn-info delete-record" data-id="1">remove</a>' +
                        // '                                                    </td>' +
                        '                                                </tr>';


                    $("#tbl_posts").append(ligne);



                };


                $(".delete-record").click(function() {
                    var id = $(this).attr('data-id');
                    var targetDiv = $(this).attr('targetDiv');
                    $('#rec-' + id).remove();

                });

                $(document).delegate('a.delete-record', 'click', function(e) {

                    var id = $(this).attr('data-id');
                    var targetDiv = $(this).attr('targetDiv');
                    $('#rec-' + id).remove();

                });




                //Insert Datesheet records to the DataBase Table --start
                $("form").submit(function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: '/datesheet-insert',
                        method: 'post',
                        data: $('form').serialize(),
                        success: function() {
                            alert("record has been inserted successfully");
                            $("form")[0].reset();
                            // window.open(
                            //     '/collected-fee-voucher/' + response.parent_id +
                            //     '?month=' +
                            //     response.month + '&firstpendingmonth=' + firstpendingmonth,
                            //     '_blank' // <- This is what makes it open in a new tab.
                            // );
                        },
                        error: function() {
                            alert("Error: ");
                        }

                    });
                });
                //Insert Datesheet records to the DataBase Table --end


                programDropdown();


                // function to show class on Dropdown
                function programDropdown() {
                    $.ajax({
                        url: '/dateSheet/fetch_classes',
                        method: 'get',
                        success: function(response) {
                            $("#class_Dropdown").html(response);

                        },
                        error: function() {
                            alert("Error: ");
                        }
                    });
                }

                // function to show sections on Dropdown
                $('#class_Dropdown').change(function() {
                    let class_id = $(this).val();

                    $.ajax({
                        url: '/dateSheet/sections-dropdown',
                        type: 'post',
                        data: 'class_id=' + class_id + ' &_token={{ csrf_token() }}',
                        success: function(result) {
                            $('#sectionDropdwon').html(result);
                            //console.log(result);
                        },
                        error: function() {
                            alert("Issue");

                        }
                    });
                });





                // function to Add Specific number of Rows on table
                $('#sectionDropdwon').change(function() {
                    let class_id = $(class_Dropdown).val();
                    let section_id = $(sectionDropdwon).val();

                    $.ajax({
                        url: '/dateSheet/rows',
                        type: 'get',
                        data: 'class_id=' + class_id + '&section_id=' + section_id +
                            ' &_token={{ csrf_token() }}',
                        success: function(result) {
                            Rows = result;
                            //console.log(result);

                            $('.rows-0').remove();
                            for (let index = 0; index < Rows; index++) {
                                rows_fu();
                            }
                            subjectsDropdown();
                        },
                        error: function() {
                            alert("Issue");

                        }
                    });
                });

                // function to show subjects on Dropdown
                function subjectsDropdown() {
                    let class_id = $(class_Dropdown).val();
                    let section_id = $(sectionDropdwon).val();

                    $.ajax({
                        url: '/dateSheet/subjects-dropdown',
                        type: 'post',
                        data: 'class_id=' + class_id + '&section_id=' + section_id +
                            ' &_token={{ csrf_token() }}',
                        success: function(result) {
                            $('.subjectDropdown').html(result);
                            //console.log(result);
                        },
                        error: function() {
                            alert("Issue");

                        }
                    });
                };

            });
        </script>

    @endsection
