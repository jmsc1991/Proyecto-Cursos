<li class="{{ Request::is('courses*') ? 'active' : '' }}">
    <a href="{!! route('admin.courses.index') !!}"><i class="fa fa-edit"></i><span>Cursos</span></a>
</li>

<li class="{{ Request::is('categories*') ? 'active' : '' }}">
    <a href="{!! route('admin.categories.index') !!}"><i class="fa fa-edit"></i><span>Categorias</span></a>
</li>
