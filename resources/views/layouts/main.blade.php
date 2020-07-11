<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>nox</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600|Material+Icons" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }
        </style>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="bmd-layout-container bmd-drawer-f-l bmd-drawer-overlay">
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <button class="btn bmd-btn-icon" style="color: white" data-toggle="drawer" data-target="#drawer">
                    <i class="material-icons">menu</i>
                </button>
                <a class="navbar-brand mr-auto" href="{{ route('home') }}" style="padding-left: 12px">nox</a>
                <div class="dropdown">
                    <button class="btn bmd-btn-icon dropdown-toggle" style="color: white" data-toggle="dropdown">
                        <i class="material-icons">more_vert</i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <button class="dropdown-item" data-toggle="modal" data-target="#licenseModal">Licenses</button>
                    </div>
                </div>
            </nav>
            <div id="drawer" class="bmd-layout-drawer bg-faded">
                <header>
                    <a class="navbar-brand drawer-item ripple" href="{{ route('home') }}">nox</a>
                </header>
                <ul class="list-group">
                    <a class="list-group-item drawer-item ripple" href="{{ route('map') }}">Map</a>
                    <a class="list-group-item drawer-item ripple" href="{{ route('data') }}">Data</a>
                    <a class="list-group-item drawer-item ripple" href="{{ route('charts') }}">Charts</a>
                </ul>
            </div>
            <main>
                @yield('content')
            </main>
        </div>
        <div class="modal" id="licenseModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Licenses</h5>
                    </div>
                    <div class="modal-body">
                        <h6>Files</h6>
                        <ul>
                            <li>
                                Taiwan_location_map.svg - NordNordWest -
                                <a href="https://creativecommons.org/licenses/by-sa/3.0/deed.en">Creative Commons Attribution-Share Alike 3.0 Unported</a>
                            </li>
                        </ul>
                        <h6>Libraries</h6>
                        <ul>
                            <li>
                                Bootstrap - Copyright © 2011-2020 Twitter, Inc., Copyright © 2011-2020 The Bootstrap Authors -
                                <a href="https://opensource.org/licenses/MIT">MIT license</a>
                            </li>
                            <li>
                                bootstrap-select - Copyright © 2012-2018 SnapAppointments, LLC -
                                <a href="https://opensource.org/licenses/MIT">MIT license</a>
                            </li>
                            <li>
                                jQuery - Copyright OpenJS Foundation and other contributors,
                                <a href="https://openjsf.org">https://openjsf.org/</a> -
                                <a href="https://opensource.org/licenses/MIT">MIT license</a>
                            </li>
                            <li>
                                Laravel - Copyright © Taylor Otwell -
                                <a href="https://opensource.org/licenses/MIT">MIT license</a>
                            </li>
                            <li>
                                Material Design for Bootstrap - Copyright © 2015-2016, Federico Zivolo and contributors,
                                <a href="https://github.com/FezVrasta/bootstrap-material-design">https://github.com/FezVrasta/bootstrap-material-design</a> -
                                <a href="https://opensource.org/licenses/MIT">MIT license</a>
                            </li>
                            <li>
                                Popper - Copyright © 2019 Federico Zivolo -
                                <a href="https://opensource.org/licenses/MIT">MIT license</a>
                            </li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                <div>
            <div>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
        @yield('script')
    </body>
</html>
