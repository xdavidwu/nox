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
                                {{-- TODO: reduce query --}}
                                @foreach(\App\Station::select('county')->distinct()->get() as $group)
                                    <optgroup label="{{ $group->county }}">
                                        @foreach(\App\Station::where('county', $group->county)->get() as $station)
                                            @if(!is_null(request()->input('stations')) &&
                                                in_array($station->id, request()->input('stations')))
                                                <option value="{{ $station->id }}" selected>{{ $station->name }}</option>
                                            @else
                                                <option value="{{ $station->id }}">{{ $station->name }}</option>
                                            @endif
                                        @endforeach
                                    </optgroup>
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
                            @foreach(\App\Consts::INDICES as $index)
                                <th scope="col">{{ $index['name'] }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($values as $value)
                            <tr>
                                <td>{{ $value->station->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($value->month)->format('Y-m') }}</td>
                                @foreach(\App\Consts::INDICES as $key => $index)
                                    <td>{{ $value->$key }}</td>
                                @endforeach
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
