<?php

namespace App\DataTables;

use App\Models\MatchModel;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MatchDatatable extends DataTable
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


            ->addColumn('round', function ($data) {
                if (!empty($data->round->name)) {
                    return $data->round->name;
                } else {
                    return "There is no any round";
                }
            })
            ->addColumn('stadium', function ($data) {
                if (!empty($data->stadium->name)) {
                    return $data->stadium->name;
                } else {
                    return "There is no any stadium";
                }
            })
            ->addColumn('localTeam', function ($data) {
                if (!empty($data->localTeam->name)) {
                    return $data->localTeam->name;
                } else {
                    return "There is no any localTeam";
                }
            })
            ->addColumn('visitorTeam', function ($data) {
                if (!empty($data->visitorTeam->name)) {
                    return $data->visitorTeam->name;
                } else {
                    return "There is no any visitorTeam";
                }
            })
            ->addColumn('date_time', function ($data) {
                return (new Carbon($data->date_time))->format('Y-m-d H:i:s');
            })
            ->addColumn('action', function ($data) {
                return view('dashboard.Matche.action', ['data' => $data]);
            })
            ->rawColumns([

                'action'
            ]);
    }

    /**
     * new Carbon($value))->format('Y-m-d H:i:s')
     * Get query source of dataTable.
     *
     * @param \App\Models\MatchDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return MatchModel::query();
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

            Column::computed('date_time'),

            Column::computed('round'),


            Column::computed('stadium'),
            Column::computed('localTeam'),
            Column::computed('visitorTeam'),
            //Column::make('services'),

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
    //     return 'Match_' . date('YmdHis');
    // }
}
