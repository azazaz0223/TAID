<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <title>{{ env('BACKEND_NAME') }}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/backend/login.css') }}">
    <script src="{{ asset('js/bootstrap.bundle.min.js')}}"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="loginBox">
        <div class="logo"><img src="{{ asset('images/logo.png') }}"></div>

        <div class="login text-center">
            <div class="B2BTitle">{{ env('BACKEND_NAME') }}</div>
            <div class="Line-1515"></div>
            <form action="{{ route('backend.logging') }}" method="post">
                @csrf
                <div class="btnBox">
                    <span>帳號</span>
                    <input type="text" name="account" class="form-control loginFill" placeholder="請輸入帳號">
                    <span>密碼</span>
                    <input type="password" name="password" class="form-control loginFill mgb8" placeholder="請輸入密碼">
                </div>

                @if (session('error'))
                <div class="alert alert-danger py-2 my-2">
                    <ul>
                        <li>{{ session('error') }}</li>
                    </ul>
                </div>
                @endif
                <button type="submit" class="loginBtn">登入</button>
            </form>
        </div>
    </div>
</body>

</html>