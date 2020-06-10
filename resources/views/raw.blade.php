@extends('layouts.main')

@section('content')
<div class="container">
    <div class="justify-content-center">
        <div class="card">
            <div class="card-header">Query</div>
            <div class="card-body" style="overflow: visible">
                <form method="GET" autocomplete="off" class="form-row align-items-center">
                    <div class="col">
                        <div class="form-group">
                            <label for="month_after" class="bmd-label-floating">Month after</label>
                            <input id="month_after" class="form-control" type="month"
                                min="{{ \Carbon\Carbon::parse(\App\MonthlyValue::min('month'))->format('Y-m') }}"
                                max="{{ \Carbon\Carbon::parse(\App\MonthlyValue::max('month'))->format('Y-m') }}"
                                name="month_after" pattern="[0-9]{4}-[0-9]{2}"
                                value="{{ request()->input('month_after') }}">
                        </div>
                    </div>
                    {{-- TODO: dedup --}}
                    {{-- TODO: month input compatibility workarounds (when degarded to text) --}}
                    <div class="col">
                        <div class="form-group">
                            <label for="month_before" class="bmd-label-floating">Month before</label>
                            <input id="month_before" class="form-control" type="month"
                                min="{{ \Carbon\Carbon::parse(\App\MonthlyValue::min('month'))->format('Y-m') }}"
                                max="{{ \Carbon\Carbon::parse(\App\MonthlyValue::max('month'))->format('Y-m') }}"
                                name="month_before" pattern="[0-9]{4}-[0-9]{2}"
                                value="{{ request()->input('month_before') }}">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="stations" class="bmd-label-floating">Stations</label>
                            <select id="stations" class="form-control selectpicker"
                                name="stations[]" data-live-search="true" multiple>
                                @foreach(\App\Station::all() as $station)
                                    @if(!is_null(request()->input('stations')) &&
                                        in_array($station->id, request()->input('stations')))
                                        <option value="{{ $station->id }}" selected>{{ $station->name }}</option>
                                    @else
                                        <option value="{{ $station->id }}">{{ $station->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-1">
                        <button class="btn btn-raised btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header">Result</div>
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
