@extends('admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Change Password</a></li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Change Password</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->

                        <div class="row">
                            

                            <div class="col-lg-8 col-xl-8">
                                <div class="card">
                                    <div class="card-body">
                                        
                                        
                                            
                                            <!-- end about me section content -->
    
                                            
                                            <!-- end timeline content-->
    
                                            <div class="tab-pane" id="settings">
                                                <form method="POST" action="{{ route('update.password') }}">
                                                    @csrf

                                                    
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label for="oldpassword" class="form-label">Old Password</label>
                                                                <input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" id="oldpassword" >
                                                                @error('old_password')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div> <!-- end col -->
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label for="newpassword" class="form-label">New Password</label>
                                                                <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" id="newpassword" >
                                                                @error('new_password')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div> <!-- end col -->
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label for="confirmnewpassword" class="form-label">Confirm New Password</label>
                                                                <input type="password" name="new_password_confirmation" class="form-control" id="confirmnewpassword" >
                                                                
                                                            </div>
                                                        </div> <!-- end col -->
                                                        
                                                    </div> <!-- end row --> 
                                                    
                                                    <div class="text-end">
                                                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Update Password</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- end settings content-->
    
                                        
                                    </div>
                                </div> <!-- end card-->

                            </div> <!-- end col -->
                        </div>
                        <!-- end row-->

                    </div> <!-- container -->

                </div>






@endsection