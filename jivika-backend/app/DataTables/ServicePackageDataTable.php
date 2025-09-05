<?php

namespace App\DataTables;

use App\Http\Admin\Service\Models\ServicePackage;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ServicePackageDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($packages) {
                return '<a class="text-primary" href="' . url('/') . '/admin/packages/create?service_package_id=' . $packages->id . '"><i class="ti ti-pencil"></i></a>
                <a class="text-danger" href="javascript:void(0);" onclick="deletePackage(' . $packages->id . ')"><i class="ti ti-trash"></i></a>';
            })->addColumn('image', function ($packages) {
                $image = str_contains($packages->image, "https://") ? $packages->image : asset('storage/image/package/' . $packages->image);
                return '<img height="60" alt="ThemeForest" class="header-mini__logo--themeforest" src="' . $image . '")">';
            })->addColumn('service', function ($packages) {
                return $packages->service->name;
            })->rawColumns(['image', 'service', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ServicePackage $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ServicePackage $model)
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
            ->setTableId('servicepackage-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('excel')->text('<i class="fa fa-file-excel"></i>')->addClass('btn-outline-success'),
                Button::make('csv')->text('<i class="fa fa-file-csv"></i>')->addClass('btn-outline-primary'),
                //   Button::make('pdf')->text('<i class="fa fa-file-pdf"></i>')->addClass('btn-outline-danger'),
                Button::make('reload')->addClass('btn-outline-dark')
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('name'),
            Column::computed('service'),
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
        return 'ServicePackage_' . date('YmdHis');
    }
}
