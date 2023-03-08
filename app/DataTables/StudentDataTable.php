<?php

namespace App\DataTables;

use App\Models\Student;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

use Carbon\Carbon;

class StudentDataTable extends DataTable
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
            return view('pages.students.datatables_actions', [
                'data' => $data,
            ]);
        })->editColumn('group', function($data) {
            return $data->group["text"];
        })->editColumn('gender', function($data) {
            return $data->gender["text"];
        })->editColumn('dob', function($data) {
            $umur = Carbon::parse($data->dob["id"])->diff(Carbon::now())->format('%y tahun, %m bulan dan %d hari');
            return $data->dob["text"] ."<br/><label class='badge text-bg-light text-age'>". $umur ."</label>";
        })->rawColumns(["action", "dob"]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Student $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Student $model)
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
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '30px', 'printable' => false, 'title' => ''])
            ->parameters([
                'dom'       => 'rtip',
                'responsive' => true,
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'columnDefs' => [
                    ['targets' => 6, 'responsivePriority' => 1],
                    ['targets' => [4,5], "className" => "none"]
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
            'nis' => ['data' => 'nis', 'title' => 'Nomor'],
            'name' => ['data' => 'name', 'title' => 'Nama Lengkap'],
            'parent_name' => ['data' => 'parent_name', 'title' => 'Nama Orangtua'],
            'gender' => ['data' => 'gender', 'title' => 'Jenis Kelamin'],
            'group' => ['data' => 'group', 'title' => 'Kelompok'],
            'dob' => ['data' => 'dob', 'title' => 'Tanggal Lahir'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Student_datatable_' . time();
    }
}
