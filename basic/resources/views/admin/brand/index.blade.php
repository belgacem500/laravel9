<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
       <b> كل العلامات التجارية </b>
      <b style="float:right;">
      </b>
    </h2>
  </x-slot>

  <div class="py-12">

    <div class="container">
      <div class="row">


        <div class="col-md-8">
          @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif
          <div class="card">

            <div class="card-header"><b> كل العلامات التجارية </b></div>

            <table class="table  text-center">
              <thead>
                <tr>
                  <th scope="col">رقم التعريف</th>
                  <th scope="col">العلامة التجارية</th>
                  <th scope="col">صورة العلامة</th>
                  <th scope="col">تاريخ التسجيل</th>
                  <th scope="col">حذف او تعديل</th>
                </tr>
              </thead>
              <tbody>
                @foreach($brands as $brand)
                <tr>
                  <th scope="row">{{ $brands->firstItem()+$loop->index }}</th>
                  <td>{{ $brand->brand_name }}</td>
                  <td> <img src="{{ asset($brand->brand_image) }}" style="height:40px; width:70px;" alt="brand image"> </td>
                  <td>
                    @if($brand->created_at==NULL)
                    <span class="text-danger">No Date Set</span> 
                    @else
                    {{ Carbon\Carbon::parse($brand->created_at)->diffForHumans() }}
                  </td>
                  @endif
                  <td>
                   <a href="{{ url('brand/edit/'.$brand->id) }}" class="btn btn-info text-white">تعديل</a>
                   <a href="{{ url('brand/delete/'.$brand->id) }}" onclick="return confirm('Are you sure to delete?')"  class="btn btn-danger">حذف</a> 
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>

            {{ $brands->links() }}
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-header"><b>إضافة علامة تجارية</b></div>
            <div class="card-body">
              <form action="{{ route('store.brand') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">إسم العلامة التجارية</label>
                  <input type="text" class="form-control" name="brand_name" id="exampleInputEmail1" aria-describedby="emailHelp">
                  @error('brand_name')
                  <span class="text-danger"> {{ $message }} </span>
                  @enderror
                </div>

                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">صورة العلامة التجارية</label>
                  <input type="file" class="form-control" name="brand_image" id="exampleInputEmail1" aria-describedby="emailHelp">
                  @error('brand_image')
                  <span class="text-danger"> {{ $message }} </span>
                  @enderror
                </div>

                <button type="submit" class="btn btn-primary">إضافة العلامة التجارية</button>
              </form>
            </div>

          </div>
        </div>
      </div>

    </div>
  </div>







  </div>
</x-app-layout> 