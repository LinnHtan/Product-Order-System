@extends('admin.layouts.main')

@section('title', 'Category List Page')

@section('content')

    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">User List</h2>

                            </div>
                        </div>
                    </div>
                    @if (count($user) != 0)
                    <div class="table-responsive table-responsive-data2">
                        <div class="row mb-2">
                            <div class="col-3 ">
                                <h4> <i class="fa-solid fa-user me-4"></i> {{ $user->total() }} </h4>

                            </div>
                            <div class=" col-3 ">

                                <h5 class="text-secondary ">Search Key : <span class="text-danger">
                                        {{ request('searchKey') }}</span></h5>
                            </div>

                            <div class="col-4 ">
                                <form action="{{ route('userList#listPage') }}" method="get">
                                    @csrf
                                    <div class=" d-flex">
                                        <input type="text" name="searchKey"
                                            class=" shadow-sm form-control col-6 offset-9" placeholder="Search...">
                                        <button type="submit" class=" col-2 btn btn-outline-dark"><i
                                                class="fa-solid fa-magnifying-glass"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="col-4 offset-8">
                            @if (session('deleteSuccess'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fa-solid fa-circle-check me-2"></i>{{ session('deleteSuccess') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
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
                                @foreach ($user as $u)
                                    <tr class="tr-shodow">

                                        <td>{{ $u->name }}</td>
                                        <td>
                                            @if ($u->image == null)
                                                @if ($u->gender == 'male')
                                                    <img class="img-thumbnail shadow-sm" style=" height:100px; width:120px;"
                                                        src="{{ asset('image/user.png') }}" />
                                                @else
                                                    <img class="img-thumbnail shadow-sm" style=" height:100px; width:120px;"
                                                        src="{{ asset('image/girl.png') }}" />
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/' . $u->image) }}"
                                                    style=" height:100px; width:120px;" class=" img-thumbnail  "
                                                    alt="">
                                            @endif

                                        </td>
                                        <td>{{ $u->gender }}</td>
                                        <td>{{ $u->phone }}</td>
                                        <td>{{ $u->address }}</td>
                                        <td>{{ $u->role }}</td>
                                        {{-- <td>{{ $c->created_at->format('j-F-y') }}</td> --}}
                                        <td>
                                            <div class="table-data-feature">
                                                @if (Auth::user()->id == $u->id)
                                                @else
                                                    <a href="{{ route('userList#detailPage', $u->id) }} ">
                                                        <button class="item me-2" data-toggle="tooltip" data-placement="top"
                                                            title="Detail">
                                                            <i class="fa-solid fa-circle-info"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('userList#delete', $u->id) }} ">
                                                        <button class="item me-2" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </a>
                                                    <a href=" {{ route('userList#userChangePage', $u->id) }}">
                                                        <button class="item me-2" data-toggle="tooltip" data-placement="top"
                                                            title="Change">
                                                            <i class="fa-solid fa-rotate"></i>
                                                        </button>
                                                    </a>
                                                @endif

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                        <div class="float-end">
                            {{ $user->appends(request()->query())->links() }}
                        </div>
                    </div>
                    @else
                    <div class="">
                        <h3 class="bg-danger rounded text-white text-center p-2">There is no user!</h3>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

@endsection
