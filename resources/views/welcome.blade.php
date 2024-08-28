<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Vue.js Example</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <navbar-component></navbar-component>

        <main class="content">
            <router-view></router-view>
        </main>

        <footer-component></footer-component>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>

<style>
    /* Tüm sayfa yapısı flexbox ile düzenleniyor */
    #app {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        /* Sayfa yüksekliğini tam kapsasın */
    }

    /* İçerik alanı sayfanın geri kalanını kaplasın */
    .content {
        flex: 1;
    }

    /* Footer her zaman en altta olsun */
    footer-component {
        background-color: #333;
        color: white;
        text-align: center;
        padding: 20px;
    }
</style>

</html>