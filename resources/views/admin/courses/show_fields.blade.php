<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $course->id !!}</p>
</div>

<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    <p>{!! $course->title !!}</p>
</div>

<!-- Excerpt Field -->
<div class="form-group">
    {!! Form::label('excerpt', 'Excerpt:') !!}
    <p>{!! $course->excerpt !!}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    <p>{!! $course->description !!}</p>
</div>

<!-- Price Field -->
<div class="form-group">
    {!! Form::label('price', 'Price:') !!}
    <p>{!! $course->price !!}</p>
</div>

<!-- Category Id Field -->
<div class="form-group">
    {!! Form::label('category_id', 'Category Id:') !!}
    <p>{!! $course->category_id !!}</p>
</div>

<!-- Owner Field -->
<div class="form-group">
    {!! Form::label('owner', 'Owner:') !!}
    <p>{!! $course->user_id !!}</p>
</div>

<!-- Learn Field -->
<div class="form-group">
    {!! Form::label('learn', 'Learn:') !!}
    <p>{!! $course->learn !!}</p>
</div>

<!-- Requirements Field -->
<div class="form-group">
    {!! Form::label('requirements', 'Requirements:') !!}
    <p>{!! $course->requirements !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $course->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $course->updated_at !!}</p>
</div>

