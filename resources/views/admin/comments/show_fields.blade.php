<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $comment->id !!}</p>
</div>

<!-- title Field -->
<div class="form-group">
    {!! Form::label('content', 'Content:') !!}
    <p>{!! $comment->content !!}</p>
</div>

<!-- description Field -->
<div class="form-group">
    {!! Form::label('video', 'Video:') !!}
    <p>{!! $comment->video->title !!}</p>
</div>

<!-- url Field -->
<div class="form-group">
    {!! Form::label('user', 'User:') !!}
    <p>{!! $comment->user->name !!}</p>
</div>

<!-- course_id Field -->
<div class="form-group">
    {!! Form::label('comments', 'Comments:') !!}
    <p>{!! $comment->comments !!}</p>
</div>

