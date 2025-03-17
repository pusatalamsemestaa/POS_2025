@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ url('suplier') }}" class="form-horizontal">
            @csrf
            <div class="form-group row">
                <label class="col-1 control-label col-form-label">suplier ID</label>
                <div class="col-11">
                    <input class="form-control" id="suplier_id" name="suplier_id" required value="{{ old('suplier_id') }}" required>
                    @error('suplier_id')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 control-label col-form-label">suplier kode</label>
                <div class="col-11">
                    <input type="text" class="form-control" id="suplier_kode" name="suplier_kode" value="{{ old('suplier_kode') }}" required>
                    @error('suplier_kode')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 control-label col-form-label">Nama suplier</label>
                <div class="col-11">
                    <input type="text" class="form-control" id="katgeori_nama" name="suplier_nama" value="{{ old('suplier_nama') }}" required>
                    @error('suplier_nama')
                    <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 control-label col-form-label"></label>
                <div class="col-11">
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    <a class="btn btn-default btn-sm" href="{{ url('suplier') }}">Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('css')
@endpush

@push('js')
@endpush