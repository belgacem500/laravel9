@extends('admin.admin_master')

@section('admin')


    @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif
  <div class="py-12">

    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">تعديل علامة تجارية</div>
            <div class="card-body">
              <form action=" {{ url('brand/update/'.$brands->id) }} " method="POST" enctype="multipart/form-data">
                @csrf
              <input type="hidden" name="old_image" value="{{$brands->brand_image}}">
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">تغيير اسم العلامة التجارية</label>
                  <input type="text" class="form-control" name="brand_name" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$brands->brand_name}}">
                  @error('brand_name')
                  <span class="text-danger"> {{ $message }} </span>
                  @enderror
                </div>

                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">تغيير صورة العلامة التجارية</label>
                  <input type="file" class="form-control" name="brand_image" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$brands->brand_image}}">
                  @error('brand_image')
                  <span class="text-danger"> {{ $message }} </span>
                  @enderror
                </div>


                <div class="form-group">
                <img src="{{ asset($brands->brand_image) }}" style="width:400px; height:200px;">
                </div>

                <button type="submit" class="btn btn-primary">تغيير العلامة التجارية</button>
              </form>
            </div>

          </div>
        </div>
      </div>

    </div>
  </div>

@endsection
