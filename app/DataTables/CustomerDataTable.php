<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CustomerDataTable extends DataTable
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
        ->addColumn('customer_img', function ($customers) {
            // if (empty($customers->customer_img)){
            //     return ' ';
            // }
            $url=asset("/images/customer/$customers->customer_img"); 
            return '<img src='.$url.' border="0" width="100" height = "75" align="center" />'; 
        })
        ->addColumn('action', function($row) {
            return "<a href=". route('customer.show', $row->id). " class=\"btn btn-primary\">Show</a> 
            <a href=". route('customer.edit', $row->id). " class=\"btn btn-warning\">Edit</a>
            <a href=". route('customer.restore', $row->id). " class=\"btn btn-success\">Restore</a>
            <form action=". route('customer.destroy', $row->id). " method= \"POST\" >". csrf_field() .'<input name="_method" type="hidden" value="DELETE">
            <button class="btn btn-danger" type="submit">Delete</button>
            </form> ';
        })
        ->rawColumns(['customer_img', 'action']);
        }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Customer $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
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
                    ->setTableId('customers-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(5)
                    ->buttons(
                        // Button::make('create'),
                        // Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    )->parameters([
                        'buttons' => ['excel','pdf','csv'],
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
            
            Column::make('id'),
            Column::make('title'),
            Column::make('lname'),
            Column::make('fname'),
            Column::make('addressline'),
            Column::make('town'),
            Column::make('zipcode'),
            Column::make('phone'),
            Column::make('customer_img'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::make('deleted_at'),
            Column::computed('action')
                //   ->exportable(false)
                //   ->printable(false)
                //   ->width(5)
                //   ->addClass('text-center')
        ];
    }
    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Customer_' . date('YmdHis');
    }
}
