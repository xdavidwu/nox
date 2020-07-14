@extends('layouts.main')

@section('content')
<div class="container">
    <div class="justify-content-center">
        <div class="card">
            <div class="card-header">選項</div>
            <div class="card-body" style="overflow: visible">
                <form autocomplete="off" id="options" class="form-row align-items-center">
                    <div class="col-12 col-md-2 col-lg-3">
                        <div class="form-group">
                            <label for="month" class="bmd-label-floating">月份</label>
                            <input id="month" class="form-control" type="month"
                                min="{{ \Carbon\Carbon::parse(\App\MonthlyValue::min('month'))->format('Y-m') }}"
                                max="{{ \Carbon\Carbon::parse(\App\MonthlyValue::max('month'))->format('Y-m') }}"
                                pattern="[0-9]{4}-[0-9]{2}" value="2020-05" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-12 col-md-8 col-lg-7">
                        <div class="form-group">
                            <label for="indices" class="bmd-label-floating">指標</label>
                            <select id="indices" class="form-control selectpicker"
                                autocomplete="off" multiple>
                                @foreach(array('o3', 'pm25', 'pm10', 'co', 'so2', 'no2') as $index)
                                    <option value="{{ $index }}" selected>
                                        {{ \App\Consts::INDICES[$index]['name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-1 col-md-2 col-lg-1">
                        <button class="btn btn-raised btn-primary" type="submit">送出</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="canvastitle">地圖</div>
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

