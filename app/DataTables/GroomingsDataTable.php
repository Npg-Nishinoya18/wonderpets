<?php

namespace App\DataTables;

use App\Models\Grooming;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class GroomingsDataTable extends DataTable
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
            ->addColumn('action', function($row){
           $btn = '<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#groomingModal"  data-id="'.$row->id.'"  > Edit</button>';
            return $btn;
          });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Grooming $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Grooming $model)
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
                    ->setTableId('groomings-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
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
            Column::make('title'),
            Column::make('description'),
            Column::make('grooming_cost'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::make('action')
                  ->exportable(false)
                  ->printable(false)
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Groomings_' . date('YmdHis');
    }
}
