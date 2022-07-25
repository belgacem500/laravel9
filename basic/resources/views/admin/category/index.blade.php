<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
       <b> كل الفئات </b>
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

            <div class="card-header"><b> كل الفئات </b></div>

            <table class="table  text-center">
              <thead>
                <tr>
                  <th scope="col">رقم التعريف</th>
                  <th scope="col">الفئة</th>
                  <th scope="col">المستخدم</th>
                  <th scope="col">تاريخ التسجيل</th>
                  <th scope="col">حذف او تعديل</th>
                </tr>
              </thead>
              <tbody>
                @foreach($categories as $category)
                <tr>
                  <th scope="row">{{ $categories->firstItem()+$loop->index }}</th>
                  <td>{{ $category->category_name }}</td>
                  <td>{{ $category->user->name }}</td>
                  <td>
                    @if($category->created_at==NULL)
                    <span class="text-danger">No Date Set</span>
                    @else
                    {{ Carbon\Carbon::parse($category->created_at)->diffForHumans() }}
                  </td>
                  @endif
                  <td>
                   <a href="{{ url('category/edit/'.$category->id) }}" class="btn btn-info text-white">تعديل</a>
                   <a href="{{ url('softdelete/category/'.$category->id) }}" class="btn btn-danger">حذف</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>

            {{ $categories->links() }}
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-header"><b>إضافة فئة</b></div>
            <div class="card-body">
              <form action="{{ route('store.category') }}" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">إسم الفئة</label>
                  <input type="text" class="form-control" name="category_name" id="exampleInputEmail1" aria-describedby="emailHelp">
                  @error('category_name')
                  <span class="text-danger"> {{ $message }} </span>
                  @enderror
                </div>
                <button type="submit" class="btn btn-primary">إضافة الفئة</button>
              </form>
            </div>

          </div>
        </div>
      </div>

    </div>
  </div>




<!--  Trash Part -->
  <div class="container">
      <div class="row">


        <div class="col-md-8">
          <div class="card">

            <div class="card-header"><b> سلة المحذوفات </b></div>

            <table class="table text-center">
              <thead>
                <tr>
                  <th scope="col">رقم التعريف</th>
                  <th scope="col">الفئة</th>
                  <th scope="col">المستخدم</th>
                  <th scope="col">تاريخ التسجيل</th>
                  <th scope="col">حذف او تعديل</th>
                </tr>
              </thead>
              <tbody>
                @foreach($trashCat as $category)
                <tr>
                  <th scope="row">{{ $categories->firstItem()+$loop->index }}</th>
                  <td>  {{ $category->category_name }}</td>
                  <td>{{ $category->user->name }}</td>
                  <td>
                    @if($category->created_at==NULL)
                    <span class="text-danger">No Date Set</span>
                    @else
                    {{ Carbon\Carbon::parse($category->created_at)->diffForHumans() }}
                  </td>
                  @endif
                  <td>
                  <a href="{{ url('category/restore/'.$category->id) }}" class="btn btn-info text-white">استرجاع</a>
                   <a href="{{ url('category/deleteperm/'.$category->id) }}" class="btn btn-danger"> حذف دائم</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>

            {{ $trashCat->links() }}
          </div>
        </div>
        <div class="col-md-4">


        </div>
      </div>

    </div>
  </div>

<!-- End Trash Part -->





  </div>
</x-app-layout>
