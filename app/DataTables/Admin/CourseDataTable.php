<?php

namespace App\DataTables\Admin;

use App\Models\Admin\Course;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class CourseDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->editColumn('title', function($course){
                            return substr($course->title, 0, 35);
                        })
                        ->addColumn('Extracto', function($course){
                            return substr($course->excerpt, 0, 35);
                        })
                        ->addColumn('Descripcion', function($course){
                            return substr($course->description, 0, 35);
                        })
                        ->addColumn('Precio', function($course){
                            return $course->price . '€';
                        })
                        ->addColumn('Categoria', function($course){
                            return $course->category->name;
                        })
                        ->addColumn('Propietario', function($course){
                            return $course->user->name;
                        })
                        ->addColumn('Aprendizaje', function($course){
                            return substr($course->learn, 0, 35);
                        })
                        ->addColumn('Requisitos', function($course){
                            return substr($course->requirements, 0, 35);
                        })
                        ->addColumn('action', 'admin.courses.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Course $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '80px'])
            ->parameters([
                'dom'     => 'Bfrtip',
                'order'   => [[0, 'desc']],
                'buttons' => [
                    'create',
                    'export',
                    'print',
                    'reset',
                    'reload',
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'title',
            'Extracto',
            'Descripcion',
            'Precio',
            'Categoria',
            'Propietario',
            'Aprendizaje',
            'Requisitos'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'coursesdatatable_' . time();
    }
}