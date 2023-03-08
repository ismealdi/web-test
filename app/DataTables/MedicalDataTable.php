<?php

namespace App\DataTables;

use App\Models\Medical;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

use Carbon\Carbon;

class MedicalDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', function ($data) {
            return view('pages.medicals.datatables_actions', [
                'data' => $data,
            ]);
        })->editColumn('check_date', function($data) {
            return $data->check_date["text"];
        })->editColumn('weight', function($data) {
            return number_format($data->weight) . " Kg";
        })->editColumn('height', function($data) {
            return number_format($data->height) . " Cm";
        })->rawColumns(["action"]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Medical $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Medical $model)
    {
        return $model->with('student')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '30px', 'printable' => false, 'title' => ''])
            ->parameters([
                'dom'       => 'rtip',
                'responsive' => true,
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'columnDefs' => [
                    ['targets' => 9, 'responsivePriority' => 1],
                    ['targets' => [2,3,4,5,6,7,8], "className" => "none"]
                ],
                'initComplete' => "function() {
                    $('.dataTables_info').appendTo('#bottombar');
                    $('.dataTables_paginate').appendTo('#bottombar');
                }"
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
            'check_date' => ['data' => 'check_date', 'title' => 'Tanggal Periksa'],
            'student.name' => ['data' => 'student.name', 'title' => 'Nama Siswa'],
            'height' => ['data' => 'height', 'title' => 'Tinggi Badan'],
            'weight' => ['data' => 'weight', 'title' => 'Berat Badan'],
            'eye_left' => ['data' => 'eye_left', 'title' => 'Mata Kiri'],
            'eye_right' => ['data' => 'eye_right', 'title' => 'Mata Kanan'],
            'eye_other' => ['data' => 'eye_other', 'title' => 'Mata Lainnya'],
            'tooth' => ['data' => 'tooth', 'title' => 'Gigi'],
            'mouth' => ['data' => 'mouth', 'title' => 'Mulut'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Medical_datatable_' . time();
    }
}
