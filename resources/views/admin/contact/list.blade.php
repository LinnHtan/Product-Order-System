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
                            <h2 class="title-1">Inbox Messages</h2>

                        </div>
                    </div>
                </div>
                @if (count($contact) != 0)
                <div class="table-responsive table-responsive-data2">
                    <div class="col-5 offset-7">
                     @if(session('deleteSuccess'))
                     <div class="alert alert-success alert-dismissible fade show" role="alert">
                         <i class="fa-solid fa-circle-check me-2"></i>{{ session('deleteSuccess') }}
                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                       </div>
                     @endif
                    </div>
                    <div class="row">
                        <h3><i class="fa-solid fa-inbox me-3"></i> <span class="me-3">Inbox</span>  {{ (count($contact)) }}</h3>
                    </div>
                     <table class="table table-data2 text-center">
                         <thead>
                             <tr>
                                 <th></th>
                                 <th class="col-2">Name</th>
                                 <th class="col-2">Email</th>
                                 <th class="col-5">Feed Back</th>
                                 <th class="col-2">Date</th>
                                 <th class="col-1"></th>
                             </tr>
                         </thead>
                         <tbody>

                                @foreach ($contact as $c)
                                <tr class="tr-shodow">
                                 <td></td>
                                <td>{{ $c->name }}</td>
                                <td>{{ $c->email }}</td>
                                <td>{{ $c->message }}</td>
                                <td>{{ $c->created_at->format('j-F-y') }}</td>
                                <td>
                                    <div class="table-data-feature">
                                     <a href="{{ route('contact#deleteMessage',$c->id) }}">
                                         <button class="item me-2" data-toggle="tooltip" data-placement="top" title="Delete">
                                             <i class="zmdi zmdi-delete"></i>
                                         </button>
                                        </a>
                                    </div>
                                </td>
                             </tr>
                                @endforeach

                         </tbody>
                     </table>
                     <div class="float-end mt-3">
                         {{ $contact->links() }}
                     </div>

                 </div>
                 @else
                 <div class="">
                    <h2 class="bg-danger p-2 rounded text-white text-center">There is no customer feedback!</h2>
                 </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

