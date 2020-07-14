@extends('layouts.main')

@section('content')
<div class="container">
    <div class="justify-content-center">
        <div class="card">
            <div class="card-header">Grafana</div>
            <div class="card-body" style="overflow: visible">
                <select id="iframesrc" class="form-control selectpicker">
                    @foreach(\App\Consts::INDICES as $key => $index)
                        @if($key === \App\Consts::GRAFANA_DEFAULT)
                            <option value="{{ $index['grafana_panel'] }}" selected>
                        @else
                            <option value="{{ $index['grafana_panel'] }}">
                        @endif
                                {{ $index['name'] }}
                            </option>
                    @endforeach
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
