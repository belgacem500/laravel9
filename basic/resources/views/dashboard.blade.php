<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Hi .. <b> As {{ Auth::user()->name}} </b>
      <b style="float:right;"> Total Users
      <span class="badge bg-secondary"> {{ count($users) }} </span>
      </b>
    </h2>
  </x-slot>

  <div class="py-12">

    <div class="container">
      <div class="row">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">رقم التعريف</th>
              <th scope="col">اسم المستخدم</th>
              <th scope="col">البريد الالكتروني</th>
              <th scope="col">تاريخ التسجيل</th> 
            </tr>
          </thead>
          <tbody>

          @foreach($users as $user)

            <tr>
              <th scope="row">{{$user->id}}</th>
              <td>{{$user->name}}</td>
              <td>{{$user->email}}</td>
              <td>{{ Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</td>
            </tr>

          @endforeach  
          </tbody>
        </table>

      </div>
    </div>

  </div>
</x-app-layout>