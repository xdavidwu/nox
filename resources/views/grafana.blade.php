@extends('layouts.main')

@section('title', '圖表')

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
                <iframe src="{!! env('GRAFANA_BASE_URL').'3' !!}"></iframe>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $('#iframesrc').change(function() {
        $('iframe').attr('src',
            '{!! env('GRAFANA_BASE_URL') !!}' + $(this).val());
    });
</script>
@endsection
