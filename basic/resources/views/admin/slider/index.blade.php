@extends('admin.admin_master')

@section('admin')

    <div class="py-12">

        <div class="container">
            <div class="row ">
                <h2>Home Page</h2>
                <div class="float-right mb-4 " style="margin-left : 70%">
                    <a href="{{  route('add.slider')  }}" > <button class="btn btn-success  "> <i class="mdi mdi-library-plus"></i> Add Slide</button></a>
                </div>


                <div class="col-md-12">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('success') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card">

                        <div class="card-header"><b> All Sliders </b></div>

                        <table class="table">
                            <thead>
                            <tr>
                                <th  width="5%"> SL </th>
                                <th  width="15%"> Slider Title</th>
                                <th  width="25%"> Description</th>
                                <th  width="15%"> Image</th>
                                <th  width="15%"> Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i = 1)
                            @foreach($sliders as $slider)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $slider->title }}</td>
                                    <td>{{ $slider->description }}</td>
                                    <td> <img src="{{ asset($slider->image) }}" style="height:40px; width:70px;" alt="brand image"> </td>
                                    <td>
                                        <a href="{{ url('slider/edit/'.$slider->id) }}" class="btn btn-info text-white">تعديل</a>
                                        <a href="{{ url('slider/delete/'.$slider->id) }}" onclick="return confirm('Are you sure to delete?')"  class="btn btn-danger">حذف</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>

        </div>
    </div>




@endsection
