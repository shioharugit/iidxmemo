<!DOCTYPE html>
<html lang="ja" prefix="og: http://ogp.me/ns#">
<head>
    <meta charset="utf-8">
    <meta name="keywords" content="IIDXMEMO,beatmania IIDX,メモ,楽曲検索,管理" />
    <title>@yield('title')</title>
    <meta name="description" content="beatmania IIDXのACに収録されている楽曲のメモを気軽に行えるサービスです。クリアできそうな曲、好きな曲などなど、様々な用途でメモをしたくなったときにご利用ください。" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:type" content="website">
    <meta property="og:title" content="IIDXMEMO">
    <meta property="og:description" content="beatmania IIDXのACに収録されている楽曲のメモを気軽に行えるサービスです。クリアできそうな曲、好きな曲などなど、様々な用途でメモをしたくなったときにご利用ください。">
    <meta property="og:url" content="https://iidxmemo.official.jp/public/">
    <meta property="og:site_name" content="IIDXMEMO">
    <meta property="og:image" content="{{asset('/images/home/ogp.jpg')}}">
    <link rel="icon" href="{{asset('favicon.ico')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">
    <link href="{{asset('css/common.css')}}" rel="stylesheet" media="screen">
    <link href="{{asset('css/sticky-footer.css')}}" rel="stylesheet" media="screen">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js" integrity="sha512-3j3VU6WC5rPQB4Ld1jnLV7Kd5xr+cq9avvhwqzbH/taCRNURoeEpoPBK9pDyeukwSxwRPJ8fDgvYXd6SkaZ2TA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body class="bg-light">
@include('user.layouts.partials.header')
<div class="container mb-5">
    @yield('content')
</div>
@include('user.layouts.partials.footer')
<script src="{{asset('js/common.js')}}"></script>
</body>
</html>
