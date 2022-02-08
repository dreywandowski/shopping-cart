@extends('shop-layout.auth')
@section('content')



    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0"><a href="/shop">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">My Orders</strong></div>
            </div>
        </div>
    </div>

    <div style="margin-left: 10%" class="site-section">
        <disv class="container">
            <div class="row mb-5" style="overflow-x:auto;">
                <!--<form class="col-md-12" method="post" style="overflow-x:auto;">-->
                <div class="site-blocks-table" style="overflow-x:auto;">
                    @if($order != null) <caption style="color:black"><h3><center><u>My Orders</center></u></h3> </caption>
                    <table class="table table-bordered" style="overflow-x:auto;">

                        <thead>
                        <tr>
                            <th class="ID">ID</th>
                            <th class="Log Time">Log Time</th>
                            <th class="Items">Items</th>
                            <th class="Amount">Amount</th>
                            <th class="Payment Reference">Payment Reference</th>
                            <th class="Status">Status</th>
                            <th class="Channel">Channel</th>
                            <th class="type">Pay Type</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                                    @foreach($order as $item)
                                    <td>{{ $item['id'] }}</td>
                                    <td>{{ date('l jS \of F Y h:i:s A', strtotime($item['updated_at']))}}</td>
                                    <td>
                                       @foreach ($item['items'] as $items)
                                        <img src="{{ $items[0]['file'] }}" alt="Image" style="height: 80px;
width: 80px;">
                                            {{ $items[0]['name'] }}, {{ $items[0]['number'] }} items @ NGN{{ $items[0]['price'] }}<hr>
                                        @endforeach
                                    </td>
                                    <td>NGN {{ $item['amount'] }}</td>
                                    <td>{{ $item['ref']  }}</td>
                                    <td>{{ $item['status']  }}</td>
                                    <td>{{ $item['channel']  }}</td>
                                    <td>{{ $item['pay_type']  }}</td>
                        </tr>

                        @endforeach
                        @endif

                        </tbody>
                    </table>
                </div>
                <!-- </form>-->
            </div>


@endsection
