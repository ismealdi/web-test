<div class="col-12 select2-border">
    {!! Form::label('student_id', 'Nama Siswa:', ['class' => 'form-label']) !!}
    {!! Form::hidden('student_text', '', ['class' => 'd-none']) !!}
    {!! Form::select('student_id', ['' => ''], null, ['class' => 'form-select', 'data-placeholder' => 'Pilih Murid',  'id' => 'student_id',
    'data-ajax--cache' => "true", 'data-ajax--url' => route('students.list'), 'data-default--url' => route('students.list')]) !!}
</div>

<div class="col-sm-12">
    {!! Form::label('check_date', 'Tanggal Periksa:', ['class' => 'form-label']) !!}
    {!! Form::date('check_date', null, ['class' => 'form-control', 'required', 'inputmode' => "numeric"]) !!}
</div>

<div class="col-sm-6">
    {!! Form::label('height', 'Tinggi Badan:', ['class' => 'form-label']) !!}
    {!! Form::tel('height', null, ['class' => 'form-control', 'required', 'data-masked' => '', 'data-inputmask' => "'mask': '9[99] CM'"]) !!}
</div>

<div class="col-sm-6">
    {!! Form::label('weight', 'Berat Badan:', ['class' => 'form-label']) !!}
    {!! Form::tel('weight', null, ['class' => 'form-control', 'required', 'data-masked' => '', 'data-inputmask' => "'mask': '9[99] KG'"]) !!}
</div>

<div class="col-sm-6">
    {!! Form::label('eye_left', 'Mata Kiri:', ['class' => 'form-label']) !!}
    {!! Form::text('eye_left', null, ['class' => 'form-control', 'required']) !!}
</div>

<div class="col-sm-6">
    {!! Form::label('eye_right', 'Mata Kanan:', ['class' => 'form-label']) !!}
    {!! Form::text('eye_right', null, ['class' => 'form-control', 'required']) !!}
</div>

<div class="col-sm-12">
    {!! Form::label('eye_other', 'Mata Lainnya:', ['class' => 'form-label']) !!}
    {!! Form::text('eye_other', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Address Field -->
<div class="col-sm-12">
    {!! Form::label('tooth', 'Gigi:', ['class' => 'form-label']) !!}
    {!! Form::textarea('tooth', null, ['class' => 'form-control', 'rows' => 3]) !!}
</div>

<!-- Address Field -->
<div class="col-sm-12">
    {!! Form::label('mouth', 'Mulut:', ['class' => 'form-label']) !!}
    {!! Form::textarea('mouth', null, ['class' => 'form-control', 'rows' => 3]) !!}
</div>