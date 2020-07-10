@extends('layouts.main')

@section('content')
<div class="container">
    <div class="justify-content-center">
        <div class="card">
            <div class="card-header">Grafana</div>
            <div class="card-body" style="overflow: visible">
                <select id="iframesrc" class="form-control selectpicker">
                    <option value="3" selected>二氧化硫</div>
                    <option value="4">一氧化碳</div>
                    <option value="5">二氧化碳</div>
                    <option value="6">臭氧</div>
                    <option value="7">PM10</div>
                    <option value="8">PM2.5</div>
                    <option value="9">NOx</div>
                    <option value="10">NO</div>
                    <option value="11">NO2</div>
                    <option value="12">THC</div>
                    <option value="13">NMHC</div>
                    <option value="14">CH4</div>
                    <option value="15">風速</div>
                    <option value="16">小時風速值</div>
                    <option value="2">溫度</div>
                    <option value="17">降雨強度</div>
                    <option value="18">酸雨pH</div>
                    <option value="19">相對濕度</div>
                    <option value="20">導電度</div>
                </select>
                <iframe src="https://grafana.parto.nctu.me/d-solo/pty476GGz/nox?orgId=2&panelId=3"></iframe>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $('#iframesrc').change(function() {
        $('iframe').attr('src',
            'https://grafana.parto.nctu.me/d-solo/pty476GGz/nox?orgId=2&panelId=' + $(this).val());
    });
</script>
@endsection
