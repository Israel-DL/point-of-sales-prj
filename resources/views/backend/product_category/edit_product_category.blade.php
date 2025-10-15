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
                                        {{-- <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Add Employee</a></li>
                                        </ol> --}}
                                    </div>
                                    <h4 class="page-title">Edit Product Category</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->

                        <div class="row">
                            
                            <div class="col-lg-8 col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        
                                        
                                            
                                            <!-- end about me section content -->
    
                                            
                                            <!-- end timeline content-->
    
                                            <div class="tab-pane" id="settings">
                                                <form method="POST" action="{{ route('update.product.category') }}">
                                                    @csrf

                                                    <input type="hidden" name="id" value="{{ $category->id }}"> 

                                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Edit Product Category </h5>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="name" class="form-label">Product Category Name</label>
                                                                <input type="text" name="category_name" value="{{ $category->category_name }}" class="form-control @error('name') is-invalid @enderror">
                                                                @error('name')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        
                                                        
                                                    </div> <!-- end row --> 
                                                    
                                                    <div class="text-end">
                                                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Update</button>
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