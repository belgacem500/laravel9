<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <b> كل الصور المتعددة </b>
            <b style="float:right;">
            </b>
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="container">
            <div class="row">


                <div class="col-md-8">

                    <div class="card-group">

                        @foreach($images as $multi)
                            <div class="col-md-4 mt-2 ">
                                <div class ="card">
                                    <img src="{{ asset($multi->image) }}" alt="">
                                </div>
                            </div>

                        @endforeach

                    </div>

                </div>



                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header"><b>إضافة صور متعددة</b></div>
                        <div class="card-body">
                            <form action="{{ route('store.image') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">صور متعددة</label>
                                    <input type="file" class="form-control" name="image[]" id="exampleInputEmail1" aria-describedby="emailHelp" multiple="">
                                    @error('brand_image')
                                    <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">إضافة صورة</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>







    </div>
</x-app-layout>
