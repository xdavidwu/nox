@extends('layouts.main')

@section('title', '地圖')

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
                                min="{{ \Carbon\Carbon::parse(\App\Models\MonthlyValue::min('month'))->format('Y-m') }}"
                                max="{{ \Carbon\Carbon::parse(\App\Models\MonthlyValue::max('month'))->format('Y-m') }}"
                                value="{{ \Carbon\Carbon::parse(\App\Models\MonthlyValue::max('month'))->format('Y-m') }}"
                                pattern="[0-9]{4}-[0-9]{2}"
                                title="YYYY-MM (西元年份-月份, 需補零)"
                                autocomplete="off">
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

@section('navbutton')
<button class="btn bmd-btn-icon navbutton" data-toggle="modal" data-target="#helpModal">
    <i class="material-icons">help</i>
</button>
@endsection

@section('modal')
<div class="modal" id="helpModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">說明</h5>
            </div>
            <div class="modal-body">
                <h6>指標狀態分類</h6>
                本站指標狀態分類及顏色參考
                <a href="https://airtw.epa.gov.tw/CHT/Information/Standard/AirQualityIndicator.aspx">行政院環保署 - 空氣品質監測網 - 空氣品質指標</a>
                中的『日空氣品質指標』，
                原分類方法資料多為單日內長時間平均值，
                這裡直接套用月值，結果僅供參考。
                如有更適合長時間資料的分類方法，
                歡迎提出修正。
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-dismiss="modal">關閉</button>
            </div>
        </div>
    </div>
</div>
@endsection
