
@extends('admin.layouts.main')

@section('title','Category List Page')

@section('content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap text-center">
                            <h2 class="title-1 text-center">Change Role</h2>

                        </div>
                    </div>
                </div>
                <div class="table-responsive table-responsive-data2">
                    <div class="row mb-2">
                    </div>

                    <div class="col-4 offset-8">
                    </div>
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>

                                <th>Name</th>
                                <th>Profile</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Role</th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody>


                              <form action="{{ route('userList#userChangeRole',$user->id) }}" method="post">
                               @csrf
                               <tr class="tr-shodow">

                                   <td>{{ $user->name }}</td>
                                   <td>
                                    @if ($user->image == null)
                                        @if ($user->gender == 'male')
                                            <img class="img-thumbnail shadow-sm" style=" height:100px; width:120px;" src="{{ asset('image/user.png') }}"  />
                                        @else
                                            <img class="img-thumbnail shadow-sm" style=" height:100px; width:120px;" src="{{ asset('image/girl.png') }}"  />


                                        @endif

                                    @else
                                    <img src="{{ asset('storage/'.$user->image) }}" style=" height:100px; width:120px;" class=" img-thumbnail  "  alt="">
                                    @endif

                                    </td>
                                   <td>{{ $user->gender }}</td>
                                   <td>{{ $user->phone }}</td>
                                   <td>{{ $user->address }}</td>
                                   <td>
                                       <select name="role" class="form-control " id="">
                                           <option value="admin" @if($user->role == 'admin') selected @endif >Admin</option>
                                           <option value="user" @if($user->role == 'user') selected @endif >User</option>
                                       </select>
                                   </td>
                                   <td>
                                       <button type="submit" class="btn btn-dark text-white">Change</button>
                                   </td>
                                </tr>
                              </form>


                        </tbody>
                    </table>


                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>

@endsection


