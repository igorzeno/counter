<!DOCTYPE html>
<html>
<head>
    <base href="/"/>
    <title>Posty</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link type="text/css" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    @yield('custom_css')
</head>
<body class="bg-gray-200">
<nav class="p-6 bg-white flex justify-between mb-6">
    <ul class="flex items-center">
        <li>
            <a href="/" class="p-3">Home</a>
        </li>
        <li>
            <a href="{{ route('test') }}" class="p-3">Test</a>
        </li>
        <li>
            <a href="{{ route('visit') }}" class="p-3">Visit</a>
        </li>

    </ul>
    <ul class="flex items-center">
        @auth
            <li>
                <a href="/" class="p-3">{{ auth()->user()->name }}</a>
            </li>
            <li>
                <form action="{{ route('logout') }}" method="post" class="p-3 inline">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </li>
        @endauth

        @guest
            <li>
                <a href="{{ route('login') }}" class="p-3">Login</a>
            </li>
        @endguest
    </ul>
</nav>
@yield('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function () {

        function sendCount() {
            let dd = window.navigator.userAgent;
            let url_param = location.href;
            let oscpu_param = (window.navigator.oscpu || window.navigator.platform);

            $.ajax({
                url: "{{route('visitCount')}}",
                type: "POST",
                data: {
                    url_param: url_param,
                    oscpu_param: oscpu_param,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (data) => {
                },
            });
        }
        sendCount();
   })
</script>

@yield('custom_js')

</body>
</html>
