@extends('layouts.content')
@section('title')
    Riwayat Medis
@endsection
@section('buttonsidebar')
<a data-route="{{ route('medicals.store') }}" 
    data-method="POST" data-bs-toggle="modal" data-bs-target="#addDialog" class="btn btn-primary mx-2"><i class="bi bi-plus-lg"></i> Medis</a>
@endsection
@section('headerbar')
<div class="input-group select-topbar">
    <div class="input-group-text">Entry</div>
    <select class="form-select" id="topbar-entry">
        <option value="10">10</option>
        <option value="50">50</option>
        <option value="100">100</option>
    </select>
</div>
@endsection

@section('content')

<!-- Modal Add Form -->
<div class="modal modal-data fade" id="addDialog" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addDialogLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-sm-down">
        {!! Form::open(['class' => 'modal-content', 'id' => 'formAdd']) !!}
            <div class="modal-header">
                <h1 class="modal-title" id="addDialogLabel">Form Medis</h1>
            </div>
            <div class="modal-body row g-3">
                @include('pages.medicals.fields')
            </div>
            <div class="modal-footer">
                <label class="text-error me-auto" id="errorAddDialog"></label>
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>                
            </div>
        {!! Form::close() !!}
    </div>
</div>

@include('pages.medicals.table')
@endsection


@push("script")
<script src="{{ url('js/pages/medicals.js') }}"></script>
@endpush
