@extends('master')
@section('content')
    <style>
        table {
            text-align: center;
        }

    </style>
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Add new timeTable</h4>
                            </div>
                            <div class="card-body">
                                <form action="/timetable/insert" method="post">
                                    @csrf
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label>Title</label>
                                                    <input type="text" name="title" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label>Apply from:</label>
                                                    <input type="date" name="applyfrom" class="form-control" required>
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


                                        </div>
                                        {{-- <div class="well clearfix">
                                            <a class="btn btn-primary pull-right add-record text-white"
                                                style="display:none;" data-added="0"> Add
                                                Row</a>
                                        </div> --}}
                                        <table class="table table-bordered" id="tbl_posts">
                                            <thead>
                                                <tr>
                                                    <th>#Lec</th>
                                                    <th>Subjects</th>


                                                </tr>
                                            </thead>
                                            <tbody id="tbl_posts_body">
                                                <tr class="rows-0">
                                                    <td>1</td>

                                                    <td><select name="monday_subject[]" id=""
                                                            class="form-control subjectDropdown">
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
                let count = 1;




                function rows_fu() {
                    var ligne = '<tr class="rows-0">' +
                        '                                                    <td>' + count + '</td>' +
                        '' +
                        '                                                    <td><select name="subject[]" id="" class="form-control subjectDropdown">' +
                        '                                                            <option value=""> Subject</option>' +
                        '                                                        </select></td>' +
                        '                                                </tr>';


                    $("#tbl_posts").append(ligne);

                    count++;

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




                // //Insert Datesheet records to the DataBase Table --start
                $("form").submit(function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: '/timetable/insert',
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
                // //Insert Datesheet records to the DataBase Table --end


                ClassesDropdown();


                // function to show class on Dropdown
                function ClassesDropdown() {
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
                    count = 1;
                    let class_id = $(this).val();
                    $.ajax({
                        url: '/timetable/rows',
                        type: 'get',
                        data: 'class_id=' + class_id + ' &_token={{ csrf_token() }}',
                        success: function(result) {
                            Rows = result;


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


                // function to show subjects on all select Dropdown
                function subjectsDropdown() {
                    let class_id = $("#class_Dropdown").val();
                    $.ajax({
                        url: '/timetable/subjects-dropdown',
                        type: 'post',
                        data: 'class_id=' + class_id +
                            ' &_token={{ csrf_token() }}',
                        success: function(result) {
                            $('.subjectDropdown').html(result);

                        },
                        error: function() {
                            alert("Issue");

                        }
                    });
                };

            });
        </script>

    @endsection
