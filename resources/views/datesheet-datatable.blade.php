@extends('master')
@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Datesheets</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="myTable">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                                <th>Title </th>
                                                <th>Class</th>
                                                <th>Section</th>
                                                <th>Datesheet</th>

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

                fetchAlldatesheets();


                function fetchAlldatesheets() {
                    $.ajax({
                        url: '/datesheet/fetchAll',
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



            });
        </script>
    @endsection
