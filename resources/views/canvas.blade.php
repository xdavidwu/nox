@extends('layouts.main')

@section('content')
<div class="container">
    <div class="justify-content-center">
        <div class="card">
            <div class="card-header">Canvas</div>
            <div id="canvascon">
                <canvas id="maplayer" style="position: absolute; z-index: 1"></canvas>
                <canvas id="canvas" style="position: absolute; z-index: 2"></canvas>
            </div>
            <script src="{{ asset('js/canvas.js') }}"></script>
        </div>
    </div>
</div>
@endsection
