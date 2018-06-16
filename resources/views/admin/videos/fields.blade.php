<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Learn Field -->
<div class="form-group col-sm-6">
    {!! Form::label('url', 'Url:') !!}
    {!! Form::textarea('url', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('course_id', 'Curso:') !!}
    {!! Form::select('course_id', $courses, old('$courses',isset($video) ? $video->course_id : null), ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('free', 'Gratuito:') !!}
    {!! Form::select('free', ["0" => 'Privado',"1" => 'Gratuito',], old('$free',isset($video) ? $video->free : null), ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.videos.index') !!}" class="btn btn-default">Cancel</a>
</div>
