<?php

namespace App\DataTables;

use App\Models\NotM;
use Illuminate\Support\Facades\Notification;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class NotificationDatatable extends DataTable
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
                return view('dashboard.Notification.action', ['data'=> $data]);
                })
                ->rawColumns([
                    'action'
                ]);
                
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\NotificationDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return NotM::query();
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
            Column::make('type'),
            Column::make('notifiable_type'),
            Column::make('notifiable_id'),
            Column::make('data'),
            Column::make('read_at'),
           
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

}
