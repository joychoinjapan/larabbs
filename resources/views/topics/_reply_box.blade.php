@include('shared._error')
<div class="reply-box">
    <form action="{{route('replies.store')}}" method="POST" accept-charset="UTF-8">
        @csrf
        <input type="hidden" name="topic_id" value="{{ $topic->id }}">
        <div class="form-group">
            <textarea class="form-control" rows="3" placeholder="ご意見をコメントしてください" name="content"></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-share mr-1"></i>コメント</button>
    </form>
</div>
<hr>
