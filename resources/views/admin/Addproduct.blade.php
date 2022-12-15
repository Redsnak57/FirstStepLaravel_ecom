@extends('adminLayout.master')

@section('title')
    Add Product
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Product</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Add product</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              @if (Session::has("status"))
                  <div class="alert alert-success">
                    {{Session::get("status")}}
                  </div>
              @endif
              @if (count($errors) > 0)
                  <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p>{{$error}}</p>
                    @endforeach
                  </div>
              @endif
              <form id="quickForm" action="{{url("admin/saveproduct")}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Product name</label>
                    <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" placeholder="Enter product name" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Product price</label>
                    <input type="float" name="product_price" class="form-control" id="exampleInputEmail1" placeholder="Enter product price" min="1" required>
                  </div>
                  <div class="form-group">
                    <label>Product category</label>
                    <select class="form-control select2" style="width: 100%;" name="product_category" required>
                      <option selected="selected">Selectionner</option>
                      @foreach ($categories as $category)
                          <option>{{$category->category_name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <label for="exampleInputFile">Product image</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="exampleInputFile" name="product_image">
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text">Upload</span>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <!-- <button type="submit" class="btn btn-success">Submit</button> -->
                  <input type="submit" class="btn btn-success" value="Save">
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection