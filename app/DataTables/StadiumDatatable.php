<?php

namespace App\DataTables;

use App\Models\Stadium;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class StadiumDatatable extends DataTable
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
           
            ->addColumn('action', function($data){
                return view('dashboard.Stadium.action', ['data'=> $data]);
                })
                ->rawColumns([
                    'name',
                    'action'
                ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\StadiumDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Stadium::query();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('dataTable')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Blfrtip')
            ->orderBy(2);
            // ->parameters([
            //     'buttons' => ['create', 'export', 'print', 'reset', 'reload'],
            // ])
            // ->buttons(
            //     Button::make('create'),
            //     Button::make('export'),
            //     Button::make('print'),
            //     Button::make('reset'),
            //     Button::make('reload')
            // );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            // Column::make('id'),
            Column::make('name'),
            // Column::make('description'),
            Column::make('phone'),
            Column::make('capacity'),
            Column::make('latitude'),
             Column::make('longtude'),
            Column::make('address'),
            //Column::make('services'),
           

            // Column::make('stadium_url'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                // ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    // protected function filename()
    // {
    //     return 'Stadium_' . date('YmdHis');
    // }
}
