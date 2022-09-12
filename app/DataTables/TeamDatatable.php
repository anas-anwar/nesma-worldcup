<?php

namespace App\DataTables;

use App\Models\Team;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TeamDatatable extends DataTable
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
            ->addColumn('logo', function($data){
                return "<img src='storage/Teams/Logo/$data->logo' height='50px' />";
            })
            ->addColumn('flag', function($data){
                return "<img src='storage/Teams/Flags/$data->flag_url' height='50px' />";
            })
            ->addColumn('group', function($data){
                return $data->group->name;
            })
           
            ->addColumn('action', function($data){
                return view('dashboard.Team.action', ['data'=> $data]);
                })
                ->rawColumns([
                    'flag',
                    'logo',
                    'action'
                ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\TeamDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Team::query();
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
           
            Column::make('shirt_color'),
        
            Column::computed('group'),
            
            //Column::make('services'),
            Column::computed('logo')
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->addClass('text-center'),
            Column::computed('flag')
            ->width(60)
            ->addClass('text-center'),
            // Column::make('team_url'),
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
    //     return 'Team_' . date('YmdHis');
    // }
}
