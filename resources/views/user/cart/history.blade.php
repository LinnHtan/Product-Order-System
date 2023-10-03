@extends('user.layouts.main')

@section('content')


<!-- Cart Start -->
<div class="container-fluid" style="height: 350px">
    <div class="row px-xl-5">
        <div class="col-lg-8 offset-2 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover  text-center mb-0" id="dataTable">
                <thead class="thead-dark ">
                    <tr>
                        <th>Order Code</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Created Date</th>

                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach ($order as $o)
                    <tr>
                       <td class="align-middle">{{ $o->order_code }}</td>
                       <td class="align-middle">{{ $o->total_price }}</td>
                       <td class="align-middle">
                        @if ($o->status == 0)
                        <span class="text-warning" ><i class="fa-solid text-warning fa-hourglass-end me-2"></i>Pending</span>
                        @elseif ($o->status == 1)
                        <span class="text-success" ><i class="fa-solid text-success fa-check me-2"></i>Accepted</span>
                        @elseif  ($o->status == 2)
                        <span class="text-danger" ><i class="fa-solid text-danger fa-xmark me-2"></i>Rejected</span>
                        @endif
                    </td>
                       <td class="align-middle">{{ $o->created_at->format('d-M-y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Cart End -->

@endsection

