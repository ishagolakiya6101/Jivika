<?php

namespace App\DataTables;

use App\Models\Service;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ServiceDataTable extends DataTable
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
        ->addColumn('action', function($services){
            return '<a class="text-primary" href="'.url('/').'/admin/services/create?service_id='.$services->id.'"><i class="ti ti-pencil"></i></a>
            <a class="text-danger" href="javascript:void(0);" onclick="deleteService('.$services->id.')"><i class="ti ti-trash"></i></a>';
        })->addColumn('image',function($services){
            $image = str_contains($services->image, "https://placehold.co/") ? $services->image : asset('storage/image/service/'.$services->image);
            return '<img height="60" alt="ThemeForest" class="header-mini__logo--themeforest" src="'.$image.'">';
        })->rawColumns(['image','action'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Service $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Service $model): QueryBuilder
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
                    ->setTableId('service-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons(
                        Button::make('excel')->text('<i class="fa fa-file-excel"></i>')->addClass('btn-outline-success'),
                        Button::make('csv')->text('<i class="fa fa-file-csv"></i>')->addClass('btn-outline-primary'),
                        //   Button::make('pdf')->text('<i class="fa fa-file-pdf"></i>')->addClass('btn-outline-danger'),
                        Button::make('reload')->addClass('btn-outline-dark')
                    );
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
            Column::make('price'),
            Column::make('offer_price'),
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
        return 'Service_' . date('YmdHis');
    }
}
