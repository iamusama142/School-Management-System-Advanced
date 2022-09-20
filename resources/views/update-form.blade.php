
@extends('master')
@section("content")
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Update Record</h4>
                  </div>
                    <div class="card-body">
                      <form action="/edit/{{$data->id}}" method="POST" >
                       @csrf
                        <div class="container">
                          <div class="row">
                            <div class="col-6">
                              <div class="form-group">
                                <label>Name</label>
                                <input type="text" value="{{$data->studentname}}" name="fullname" placeholder="Enter You Full Name"
                                    class="form-control" >
                            </div>
                            </div>
                            <div class="col-6"> <div class="form-group">
                              <label>Father Name</label>
                              <input type="text"value="{{$data->fathername}}" name="fathername" placeholder="Enter You Father Name"
                                  class="form-control" placeholder="Enter Full Name">
                          </div></div>
                          </div>
                        </div>    
                        <div class="container">
                          <div class="row">
                            <div class="col-6">
                              <div class="form-group">
                                <label>Phone Number</label>
                                <input type="number"value="{{$data->phone}}" name="pnum" class="form-control"  placeholder="Enter Phone Number">
                            </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group">
                                <label>Emergency Number</label>
                                <input type="number"value="{{$data->emergencyphone}}" name="emrnum" class="form-control"  placeholder="Enter Emergency Phone Number">
                            </div>
                            </div>
                          </div>
                        </div> 
                        <div class="container">
                          <div class="row">
                            <div class="col-12">
                              <div class="form-group">
                                <label>Address</label>
                                <input type="text"value="{{$data->address}}" name="address" class="form-control"  placeholder="Enter Your Adress">
                            </div>
                            </div>
                          </div>
                        </div>
                        <div class="container">
                        <div class="row">
                        <div class="col-12">
                          <div class="form-group">
                            <label>Permanent Address</label>
                            <input type="text" value="{{$data->permanentaddress}}"name="paddress" class="form-control"  placeholder="Enter Your Permanent Adress">
                        </div></div>  
                        </div>  
                        </div>       
                  <div class="container">
                      <div class="row">
                          <div class="col-6">
                              <select class="custom-select custom-select-sm"value="{{$data->class}}" name="class">
                                  <option selected>Class</option>
                                  <option value="1">Class One</option>
                                  <option value="2">Class Two</option>
                                  <option value="3">Class Three</option>
                                  <option value="3">Class Four</option>
                                  <option value="3">Class Five</option>
                                  <option value="3">Class Six</option>
                                  <option value="3">Class Seven</option>
                              </select>
                          </div>
                          <div class="col-6">
                              <select class="custom-select custom-select-sm" value="{{$data->section}}" name="section">
                                  <option selected>Section</option>
                                  <option value="1">A</option>
                                  <option value="2">B</option>
                                  <option value="3">C</option>
                                  <option value="3">D</option>
                                  <option value="3">E</option>
                                  <option value="3">F</option>
                                  <option value="3">G</option>
                              </select>
                          </div>
                      </div>
                  </div>
                  <br>
                  <div class="container">
                      <div class="row">
                          <div class="col-6">
                              <div class="form-group">
                                  <label>Date Of Birth</label>
                                  <input type="date" name="dob"value="{{$data->dateofbith}}" class="form-control">
                              </div>
                          </div>
                          <div class="col-6">
                              <div class="form-group">
                                  <label>Date Of Admission</label>
                                  <input type="date" name="doa"value="{{$data->dateofadmission}}" class="form-control">
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="container mb-4">
                      <div class="row">
                          <div class="col-6">
                              <select class="custom-select custom-select-sm"value="{{$data->category}}" name="category">
                                  <option selected>Category</option>
                                  <option value="1">Computer Science</option>
                                  <option value="2">Engenering</option>
                                  <option value="3">Medical</option>
                              </select>
                          </div>
                          <div class="col-6">
                              <select class="custom-select custom-select-sm"value="{{$data->discount}}" name="discount">
                                  <option selected>Discount</option>
                                  <option value="1">30%</option>
                                  <option value="2">40%</option>
                                  <option value="3">50%</option>
                              </select>
                          </div>
                      </div>
                  </div>
                  <button class=" container btn btn-primary mb-3" type="submit">Update</button>
              </form>
              </div>
                </div>
              </div>    
            </div>
          </div>
        </section>
   
     @endsection