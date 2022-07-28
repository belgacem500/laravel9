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
                        <div class="card-header">edit slider</div>
                        <div class="card-body">
                            <form action=" {{ url('slider/update/'.$sliders->id) }} " method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="old_image" value="{{$sliders->image}}">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Edit Slider Title</label>
                                    <input type="text" class="form-control" name="title" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$sliders->title}}">
                                    @error('title')
                                    <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Slider Description</label>
                                    <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{{$sliders->description}}</textarea>
                                    @error('description')
                                    <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Change Image</label>
                                    <input type="file" class="form-control" name="brand_image" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$sliders->image}}">
                                    @error('brand_image')
                                    <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <img src="{{ asset($sliders->image) }}" style="width:400px; height:200px;">
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
