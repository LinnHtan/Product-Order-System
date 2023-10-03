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
                        <div class="overview-wrap">
                            <h2 class="title-1">Category List</h2>

                        </div>
                    </div>
                    <div class="me-5">
                        <a href="{{ route('category#createPage') }}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>Add category
                            </button>
                        </a>
                    </div>
                </div>
                <div class="table-responsive table-responsive-data2">
                    <div class="col-5 offset-7">
                        @if(session('deleteSuccess'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-check me-2"></i>{{ session('deleteSuccess') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                        @endif
                    </div>
                    <div class="col-5 offset-7">
                        @if(session('createSuccess'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-check me-2"></i>{{ session('createSuccess') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                        @endif
                    </div>
                    <div class="row mb-2">
                        <div class="col-3 ">
                            <h4><i class="fa-solid fa-database me-4"></i>   {{ $category->total() }}</h4>
                        </div>
                        <div class=" col-3 ">

                            <h5 class="text-secondary ">Search Key : <span class="text-danger"> {{ request('searchKey') }}</span></h5>
                        </div>
                        <div class="col-4 ">
                            <form action="{{ route('category#listPage') }}" method="get">
                                @csrf
                                <div class=" d-flex">
                                    <input type="text"  name="searchKey" class=" shadow-sm form-control col-6 offset-9" placeholder="Search...">
                                    <button type="submit" class=" col-2 btn btn-outline-dark"><i class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if (count($category) != 0)
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category Name</th>
                                <th>Created Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                               @foreach ($category as $c)
                               <tr class="tr-shodow">
                               <td>{{ $c->id }}</td>
                               <td class="col-6">{{ $c->name }}</td>
                               <td>{{ $c->created_at->format('j-F-y') }}</td>
                               <td>
                                   <div class="table-data-feature">

                                       <a href="{{ route('category#edit',$c->id) }}">
                                        <button class="item me-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="zmdi zmdi-edit"></i>
                                        </button>
                                    </a>
                                       <a href="{{ route('category#delete',$c->id) }}">
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="zmdi zmdi-delete"></i>
                                        </button>
                                       </a>
                                   </div>
                               </td>
                            </tr>
                               @endforeach

                        </tbody>
                    </table>
                    @else
                    <h2 class="text-white bg-danger text-center shadow-sm p-2">There is no category</h2>
                    @endif
                    <div class="float-end">
                        {{ $category->appends(request()->query())->links() }}
                    </div>
                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>

@endsection

