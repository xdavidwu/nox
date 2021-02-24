<!DOCTYPE html>
<html lang="zh-TW">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title') - {{ config('app.name') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Material+Icons" rel="stylesheet">

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="bmd-layout-container bmd-drawer-f-l bmd-drawer-overlay">
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <button class="btn bmd-btn-icon" style="color: white" data-toggle="drawer" data-target="#drawer">
                    <i class="material-icons">menu</i>
                </button>
                <a class="navbar-brand mr-auto" href="{{ route('home') }}" style="margin-left: 16px">{{ config('app.name') }}</a>
                @yield('navbutton')
                <div class="dropdown">
                    <button class="btn bmd-btn-icon navbutton dropdown-toggle" data-toggle="dropdown">
                        <i class="material-icons">more_vert</i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <button class="dropdown-item" data-toggle="modal" data-target="#licenseModal">Licenses</button>
                    </div>
                </div>
            </nav>
            <div id="drawer" class="bmd-layout-drawer bg-faded">
                <header>
                    <a class="navbar-brand drawer-item ripple" href="{{ route('home') }}">{{ config('app.name') }}</a>
                </header>
                <ul class="list-group">
                    <a class="list-group-item drawer-item ripple" href="{{ route('map') }}">地圖</a>
                    <a class="list-group-item drawer-item ripple" href="{{ route('data') }}">資料</a>
                    <a class="list-group-item drawer-item ripple" href="{{ route('charts') }}">圖表</a>
                </ul>
            </div>
            <main>
                @yield('content')
            </main>
        </div>
        @yield('modal')
        <div class="modal" id="licenseModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Licenses</h5>
                    </div>
                    <div class="modal-body">
                        This website is licensed under <a href="https://opensource.org/licenses/MIT">MIT license</a>.
                        The source code of this website can be retrieved at <a href="{{ config('app.source_url') }}">{{ config('app.source_url') }}</a>.
                        This website also make use of following works:
                        <h6>Data</h6>
                        <ul>
                            <li>
                                空氣品質監測月值 - 行政院環境保護署環境監測及資訊處 -
                                <a href="https://data.gov.tw/license">Open Government Data License, version 1.0</a>
                            </li>
                        </ul>
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
                        <button class="btn btn-primary" data-dismiss="modal">關閉</button>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
        @yield('script')
    </body>
</html>
