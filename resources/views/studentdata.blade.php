
@extends('master')
@section("content")
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Student DataTable</h4>
                    <button class="btn btn-danger"><a href="studentform" class=" text-white text-decoration-none">Add new Student</button>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>
                          <tr>
                            <th class="text-center">
                              Id
                            </th>
                            <th>Name</th>
                            <th>Father Name</th>  
                            <th>Class</th>
                            <th>Section</th>
                            <th>Fee Status</th>
                          </tr>
                        </thead>
                        <tbody>
                     <tr>
                        <th class="text-center">1</th>
                         <th>Usama</th>
                         <th>Akhtar</th>
                         <th>11th</th>
                         <th>Eagle</th>
                         <th>Payed</th>
                     </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
  @endsection