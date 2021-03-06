@extends('layouts.main')

@section('title', '資料')

@section('content')
<div class="container">
    <div class="justify-content-center">
        <div class="card">
            <div class="card-header">搜尋</div>
            <div class="card-body" style="overflow: visible">
                <form method="GET" autocomplete="off" class="form-row align-items-center">
                    <div class="col-6 col-md-3 col-lg-2">
                        <div class="form-group">
                            <label for="month_after" class="bmd-label-floating">起始月份</label>
                            <input id="month_after" class="form-control" type="month"
                                min="{{ \Carbon\Carbon::parse(\App\Models\MonthlyValue::min('month'))->format('Y-m') }}"
                                max="{{ \Carbon\Carbon::parse(\App\Models\MonthlyValue::max('month'))->format('Y-m') }}"
                                name="month_after" pattern="[0-9]{4}-[0-9]{2}"
                                title="YYYY-MM (西元年份-月份, 需補零)"
                                value="{{ request()->input('month_after') }}">
                        </div>
                    </div>
                    {{-- TODO: dedup --}}
                    {{-- TODO: month input compatibility workarounds (when degarded to text) --}}
                    <div class="col-6 col-md-3 col-lg-2">
                        <div class="form-group">
                            <label for="month_before" class="bmd-label-floating">結束月份</label>
                            <input id="month_before" class="form-control" type="month"
                                min="{{ \Carbon\Carbon::parse(\App\Models\MonthlyValue::min('month'))->format('Y-m') }}"
                                max="{{ \Carbon\Carbon::parse(\App\Models\MonthlyValue::max('month'))->format('Y-m') }}"
                                name="month_before" pattern="[0-9]{4}-[0-9]{2}"
                                title="YYYY-MM (西元年份-月份, 需補零)"
                                value="{{ request()->input('month_before') }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="stations" class="bmd-label-floating">測站</label>
                            <select id="stations" class="form-control selectpicker"
                                name="stations[]" data-live-search="true" multiple>
                                {{-- TODO: reduce query --}}
                                @foreach(\App\Models\Station::select('county')->distinct()->get() as $group)
                                    <optgroup label="{{ $group->county }}">
                                        @foreach(\App\Models\Station::where('county', $group->county)->get() as $station)
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
                    <div class="col col-md col-lg-2">
                        <button class="btn btn-raised btn-primary" type="submit">送出</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header">結果</div>
            <div class="card-body">
                <table class="table table-striped table-hover table-sm table-responsive">
                    <thead>
                        <tr>
                            <th scope="col" style="word-break: keep-all">測站</th>
                            <th scope="col">月份</th>
                            @foreach(\App\Consts::INDICES as $index)
                                @if($index['unit'] !== '')
                                    <th scope="col">{{ $index['name'].' ('.$index['unit'].')' }}</th>
                                @else
                                    <th scope="col">{{ $index['name'] }}</th>
                                @endif
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
