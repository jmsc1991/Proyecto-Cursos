<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $video->id !!}</p>
</div>

<!-- title Field -->
<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    <p>{!! $video->title !!}</p>
</div>

<!-- description Field -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    <p>{!! $video->description !!}</p>
</div>

<!-- url Field -->
<div class="form-group">
    {!! Form::label('url', 'URL:') !!}
    <iframe src="{!! $video->url !!}"></iframe>
</div>

<!-- course_id Field -->
<div class="form-group">
    {!! Form::label('course_id', 'Course:') !!}
    <p>{!! $video->course->title !!}</p>
</div>

<!-- Free Field -->
<div class="form-group">
    {!! Form::label('free', 'Free:') !!}
    <p>{!! ($video->free == "1") ? "Publico" : "Privado"; !!}</p>
</div>


