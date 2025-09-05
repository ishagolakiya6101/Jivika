<?php

namespace App\DataTables;

use App\Models\Discount;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DiscountDataTable extends DataTable
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
            ->addColumn('action', function($discount){
                return '<a class="text-primary" href="'.url('/').'/admin/discount/create?discount_id='.$discount->id.'"><i class="ti ti-pencil"></i></a>
                <a class="text-danger" href="javascript:void(0);" onclick="deleteDiscount('.$discount->id.')"><i class="ti ti-trash"></i></a>';
            })->addColumn('discount',function($discount){
                $html = $discount->type == 'fix' ? $discount->value.'/-' : $discount->value.'%';
                return $html;
            })->rawColumns(['discount','action'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Discount $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Discount $model): QueryBuilder
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
                    ->setTableId('discount-table')
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
            Column::make('code'),
            Column::computed('discount'),
            Column::make('start_date'),
            Column::make('end_date'),
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
        return 'Discount_' . date('YmdHis');
    }
}
