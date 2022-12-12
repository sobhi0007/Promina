<?php

namespace App\DataTables;

use App\Models\Album;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AlbumDataTable extends DataTable
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
           
            ->addColumn('action', function ($album) {
                return '<a class="m-2 btn btn-primary btn-sm " href="albums/'.$album->id.'/edit">Update</a>'
              
             
                .'<a class="m-2 btn btn-danger btn-sm " href="album/delete/'.$album->id.'" >delete</a>'.
              
                '<a class="m-2  " href="albums/'.$album->id.'"><i class="fa fa-eye"></i></a>' ;
            })  
            
          

            
            ->addColumn('Count', function ($album) {
             $album = Album::find($album->id);
                return $album->pictures->count();
            }) ;


    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Album $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Album $model): QueryBuilder
    {
        return $model->where('user_id',Auth::user()->id);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('album-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle(); 
    }
    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
           
            'name',
            'Count',
            'action',

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Album_' . date('YmdHis');
    }
}
