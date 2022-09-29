@extends('shop-layout.layout')
@section('content')
    <div class='col-lg-12 stretch-card'>
        <div class='card'>
            <div class='card-body'>
                <h4 class='card-title'>Exchange Rates as at Today,</h4>
                <h3 class='card-title'> {{ $today }}
                </h3>
                <table class='table table-bordered'>
                    <thead>
                    <tr>
                        <th> Currency </th>
                        <th> Description </th>
                        <th> Amount </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($exchange as $rate)
                        <ul>
                            <tr class='table-info'>

                                <td> {{ $rate['target_curr'] }} </td>
                                <td> {{ $rate['desc'] }} </td>
                                <td> &#8358; {{ $rate['online_forex_rate'] }} </td>
                                @endforeach
                            </tr>
                        </ul>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
    </div>

@endsection
