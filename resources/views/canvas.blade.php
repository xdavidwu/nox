@extends('layouts.main')

@section('content')
<div class="container">
    <div class="justify-content-center">
        <div class="card">
            <div class="card-header">Options</div>
            <div class="card-body" style="overflow: visible">
                <form autocomplete="off" id="options" class="form-row align-items-center">
                <div class="col">
                    <div class="form-group">
                        <label for="month" class="bmd-label-floating">Month</label>
                        <input id="month" class="form-control" type="month"
                            min="{{ \Carbon\Carbon::parse(\App\MonthlyValue::min('month'))->format('Y-m') }}"
                            max="{{ \Carbon\Carbon::parse(\App\MonthlyValue::max('month'))->format('Y-m') }}"
                            pattern="[0-9]{4}-[0-9]{2}" value="2020-05" autocomplete="off">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="indices" class="bmd-label-floating">Indices</label>
                        <select id="indices" class="form-control selectpicker" autocomplete="off" multiple>
                            <option value="o3" selected>O3</option>
                            <option value="pm25" selected>PM2.5</option>
                            <option value="pm10" selected>PM10</option>
                            <option value="co" selected>CO</option>
                            <option value="so2" selected>SO2</option>
                            <option value="no2" selected>NO2</option>
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
            <div class="card-header" id="canvastitle">Map</div>
            <div id="canvascon">
                <canvas id="maplayer" style="position: absolute; z-index: 1"></canvas>
                <canvas id="canvas" style="position: absolute; z-index: 2"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/canvas.js') }}"></script>
@endsection

