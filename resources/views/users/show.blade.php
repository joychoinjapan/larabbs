@extends('layouts.app')
@section('title',$user->name,'のプロフィール')
@section('content')
    <div class="row">
        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs user-info">
            <div class="card ">
                <img class="card-img-top" src="{{$user->avatar}}" alt="{{ $user->name }}">
                <div class="card-body">
                    <h5><strong>自己紹介</strong></h5>
                    <p>{{$user->introduction}} </p>
                    <hr>
                    <h5><strong>注册于</strong></h5>
                    <p>{{$user->created_at->diffForHumans()}}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <div class="card ">
                <div class="card-body">
                    <h1 class="mb-0" style="font-size:22px;">{{ $user->name }} <small>{{ $user->email }}</small></h1>
                </div>
            </div>
            <hr>
            {{-- 用户发布的内容 --}}
            <div class="card ">
                <div class="card-body">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="tab nav-link active bg-transparent topics" href="{{route('users.show',['user'=>$user->id,'contentType'=>'topics'])}}">Ta 的话题</a></li>
                        <li class="nav-item"><a class="tab nav-link replies" href="{{route('users.show',['user'=>$user->id,'contentType'=>'replies'])}}">Ta 的回复</a></li>
                    </ul>
                    @includeWhen($contentType == 'topics' || $contentType == null,'users._topics',['topics'=>$user->topics()->recent()->paginate(5)])
                    @includeWhen($contentType == 'replies','users._replies', ['replies' => $user->replies()->with('topic')->recent()->paginate(5)])
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
<script type="text/javascript">
    $(function(){
        var path = location.href;
        if(path.indexOf("replies") !== -1){
            $('.topics').removeClass('active');
            $('.replies').addClass('active');
        }else{
            $('.topics').addClass('active');
            $('.replies').removeClass('active');
        }
    });
</script>
@endsection
