<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('category_id', 'Categoria:') !!}
    {!! Form::select('category_id', $categorias, old('category_id',isset($course) ? $course->category_id : null), ['class' => 'form-control']) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', 'Price:') !!}
    {!! Form::number('price', null, ['class' => 'form-control']) !!}
</div>

<!-- Excerpt Field -->
<div class="form-group col-sm-6">
    {!! Form::label('excerpt', 'Excerpt:') !!}
    {!! Form::textarea('excerpt', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Learn Field -->
<div class="form-group col-sm-6">
    {!! Form::label('learn', 'Learn:') !!}
    {!! Form::textarea('learn', null, ['class' => 'form-control']) !!}
</div>

<!-- Requirements Field -->
<div class="form-group col-sm-6">
    {!! Form::label('requirements', 'Requirements:') !!}
    {!! Form::textarea('requirements', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.courses.index') !!}" class="btn btn-default">Cancel</a>
</div>
