<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('BACKEND_NAME') }}</title>

    {{-- fontawesome --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('fontawesome/css/all.css') }}">
    <script defer src="{{ asset('fontawesome/js/all.js') }}"></script>
    {{-- Our project just needs Font Awesome Solid + Brands --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('fontawesome/css/fontawesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('fontawesome/css/brands.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('fontawesome/css/solid.css') }}">
    <!-- Our project just needs Font Awesome Solid + Brands -->
    <script defer src="{{ asset('fontawesome/js/brands.js') }}"></script>
    <script defer src="{{ asset('fontawesome/js/solid.js') }}"></script>
    <script defer src="{{ asset('fontawesome/js/fontawesome.js') }}"></script>

    {{-- Bootstrap --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">
    {{-- CSS only --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">

    {{-- JavaScript Bundle with Popper --}}
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/backend/normalize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/backend/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/backend/component.css') }}">
    <script src="{{ asset('js/accordion.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    @include('backend.layout.menu')
    <div id="content" class="">
        @include('backend.layout.top')

        <!-- 下方內容容器 -->
        <div class="container-fluid p-3">
            @yield('container')
        </div>
    </div>

    <div class="modal fade" id="alert" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body" id="alert-body">
                    <div class="wd100 bg-light p-3 gx-1 rounded-3 dialog-box-content">
                        <div class="row col-12 gx-0">
                            <div class="w-auto col-1 gx-0">
                                <div class="dive_sub" id="alert_text"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dialogue" id="alertBtn">
                    <button type="button" class="dialogue-btn shadow-sm btn btn-primary" data-bs-dismiss="modal"
                        onclick="location.reload()">確認重整</button>
                    <button type="button" class="dialogue-btn shadow-sm btn btn-primary"
                        data-bs-dismiss="modal">關閉</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
