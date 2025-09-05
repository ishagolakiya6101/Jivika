<?php

namespace App\DataTables;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CategoryDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($category) {
                return '<a class="text-primary category_edit_'.$category->id.'" href="' . url('/') . '/admin/category/create?category_id=' . $category->id . '"><i class="ti ti-pencil"></i></a>
                <a class="text-danger category_delete_'.$category->id.'" href="javascript:void(0);" onclick="deleteCategory(' . $category->id . ')"><i class="ti ti-trash"></i></a>';
            })->addColumn('image', function ($category) {
            $image = str_contains($category->image, "https://placehold.co/") ? $category->image : asset('storage/image/category/'.$category->image);
            return '<img height="60" alt="ThemeForest" class="header-mini__logo--themeforest" src="' . $image . '")">';
            })->rawColumns(['image', 'action'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Category $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Category $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('category-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel')->text('<i class="fa fa-file-excel"></i>')->addClass('btn-outline-success'),
                Button::make('csv')->text('<i class="fa fa-file-csv"></i>')->addClass('btn-outline-primary'),
                //   Button::make('pdf')->text('<i class="fa fa-file-pdf"></i>')->addClass('btn-outline-danger'),
                Button::make('reload')->addClass('btn-outline-dark')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('name'),
            Column::make('slug'),
            Column::computed('image'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Category_' . date('YmdHis');
    }
}
