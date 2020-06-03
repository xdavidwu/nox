@extends('layouts.main')

@section('content')
<div class="container">
    <div class="justify-content-center">
        <div class="card">
            <div class="card-header">Raw Monthly Data</div>
            <div class="card-body">
                <table class="table" style="overflow: scroll">
                    <thead>
                        <tr>
                            <th scope="col">測站</th>
                            <th scope="col">月份</th>
                            <th scope="col">二氧化硫</th>
                            <th scope="col">一氧化碳</th>
                            <th scope="col">二氧化碳</th>
                            <th scope="col">臭氧</th>
                            <th scope="col">PM10</th>
                            <th scope="col">PM2.5</th>
                            <th scope="col">NOx</th>
                            <th scope="col">NO</th>
                            <th scope="col">NO2</th>
                            <th scope="col">THC</th>
                            <th scope="col">NMHC</th>
                            <th scope="col">CH4</th>
                            <th scope="col">風速</th>
                            <th scope="col">小時風速值</th>
                            <th scope="col">溫度</th>
                            <th scope="col">降雨強度</th>
                            <th scope="col">酸雨 pH</th>
                            <th scope="col">相對濕度</th>
                            <th scope="col">導電度</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($values as $value)
                            <tr>
                                <td>{{ $value->station->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($value->month)->format('Y/m') }}</td>
                                <td>{{ $value->so2 }}</td>
                                <td>{{ $value->co }}</td>
                                <td>{{ $value->co2 }}</td>
                                <td>{{ $value->o3 }}</td>
                                <td>{{ $value->pm10 }}</td>
                                <td>{{ $value->pm25 }}</td>
                                <td>{{ $value->nox }}</td>
                                <td>{{ $value->no }}</td>
                                <td>{{ $value->no2 }}</td>
                                <td>{{ $value->thc }}</td>
                                <td>{{ $value->nmhc }}</td>
                                <td>{{ $value->ch4 }}</td>
                                <td>{{ $value->wind_speed }}</td>
                                <td>{{ $value->ws_hr }}</td>
                                <td>{{ $value->amb_temp }}</td>
                                <td>{{ $value->rain_int }}</td>
                                <td>{{ $value->ph_rain }}</td>
                                <td>{{ $value->rh }}</td>
                                <td>{{ $value->rain_cond }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{ $values->links() }}
    </div>
</div>
@endsection
