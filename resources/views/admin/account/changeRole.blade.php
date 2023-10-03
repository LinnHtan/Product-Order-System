
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
                         @if(session('deleteSuccess'))
                         <div class="alert alert-success alert-dismissible fade show" role="alert">
                             <i class="fa-solid fa-circle-check me-2"></i>{{ session('deleteSuccess') }}
                             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                           </div>
                         @endif
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


                               <form action="{{ route('admin#change',$account->id) }}" method="post">
                                @csrf
                                <tr class="tr-shodow">

                                    <td>{{ $account->name }}</td>
                                    <td>
                                     @if ($account->image == null)
                                         @if ($account->gender == 'male')
                                             <img class="img-thumbnail shadow-sm" style=" height:100px; width:120px;" src="{{ asset('image/user.png') }}"  />
                                         @else
                                             <img class="img-thumbnail shadow-sm" style=" height:100px; width:120px;" src="{{ asset('image/girl.png') }}"  />


                                         @endif

                                     @else
                                     <img src="{{ asset('storage/'.$account->image) }}" style=" height:100px; width:120px;" class=" img-thumbnail  "  alt="">
                                     @endif

                                     </td>
                                    <td>{{ $account->gender }}</td>
                                    <td>{{ $account->phone }}</td>
                                    <td>{{ $account->address }}</td>
                                    <td>
                                        <select name="role" class="form-control " id="">
                                            <option value="admin" @if($account->role == 'admin') selected @endif >Admin</option>
                                            <option value="user" @if($account->role == 'user') selected @endif >User</option>
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


