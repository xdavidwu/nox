@extends('layouts.main')

@section('content')
<div class="container">
    <div class="justify-content-center">
        <div class="card">
            <div class="card-header">Canvas</div>
            <canvas id="canvas"></canvas>
            <script src="{{ asset('js/canvas.js') }}"></script>
        </div>
    </div>
</div>
@endsection
