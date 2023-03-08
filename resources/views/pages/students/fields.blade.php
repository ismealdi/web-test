<div class="col-sm-12">
    {!! Form::label('nis', 'Nomor Siswa:', ['class' => 'form-label']) !!}
    {!! Form::tel('nis', null, ['class' => 'form-control', 'required', 'data-masked' => '', 'data-inputmask' => "'mask': '99 99 99 99'"]) !!}
</div>

<div class="col-sm-12">
    {!! Form::label('name', 'Nama Siswa:', ['class' => 'form-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
</div>

<div class="col-sm-12">
    {!! Form::label('parent_name', 'Nama Orangtua:', ['class' => 'form-label']) !!}
    {!! Form::text('parent_name', null, ['class' => 'form-control', 'required']) !!}
</div>

<div class="col-6 select2-border">
    {!! Form::hidden('gender_text', null, ['id' => 'gender_text', 'class' => 'form-control']) !!}
    {!! Form::label('gender', 'Jenis Kelamin:', ['class' => 'form-label']) !!}
    {!! Form::select('gender', \App\Models\Student::GENDER, null, ['class' => 'form-select', 'required', 'data-placeholder' => 'Pilih Jenis Kelamin']) !!}
</div>

<div class="col-6 select2-border">
    {!! Form::hidden('group_text', null, ['id' => 'group_text', 'class' => 'form-control']) !!}
    {!! Form::label('group', 'Kelompok:', ['class' => 'form-label']) !!}
    {!! Form::select('group', \App\Models\Student::GROUP, null, ['class' => 'form-select', 'required', 'data-placeholder' => 'Pilih Kelompok']) !!}
</div>

<div class="col-sm-12">
    {!! Form::label('dob', 'Tanggal Lahir:', ['class' => 'form-label']) !!}
    {!! Form::date('dob', null, ['class' => 'form-control', 'required', 'inputmode' => "numeric"]) !!}
</div>