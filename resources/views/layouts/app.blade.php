<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>@yield('title','LaraBBS') - Laravel BBS</title>
    <meta name="description" content="@yield('description', 'LaraBBS 爱好者社区')" />

    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    @yield('styles')
</head>
<body>
    <div id="app" class="{{route_class()}}-page">
        @include('layouts._header')
        <div class="container">
            @include('shared._message')
            @yield('content')
        </div>
        @include('layouts._footer')
    </div>
    <script src="{{mix('js/app.js')}}"></script>
    @yield('scripts')
</body>

<script type="text/javascript">
    var path = location.pathname;
    var category_id = path.slice(-1);
    var category_li=document.getElementById("category-list").getElementsByTagName('li');
    for(var i = category_li.length - 1; i >= 0; i--) {
        i==category_id?
            category_li[i].className='nav-item active':
            category_li[i].className='nav-item'
    }
    path.slice(-1)=='s'?
        category_li[0].className='nav-item active':
        category_li[0].className='nav-item';

</script>
@yield('js')
</html>
