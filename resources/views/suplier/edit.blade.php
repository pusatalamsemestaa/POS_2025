@extends('layouts.template')
@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        @empty($suplier)
            <div class="alert alert-danger alert-dismissible">
                <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                Data yang Anda cari tidak ditemukan.
            </div>
            <a href="{{ url('suplier') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
        @else
            <form method="POST" action="{{ url('/suplier/'.$suplier->suplier_id) }}" class="form-horizontal">
                @csrf
                {!! method_field('PUT') !!} <!-- Tambahkan method PUT untuk proses edit -->
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">suplier ID</label>
                    <div class="col-11">
                        <input class="form-control" id="suplier_id" name="suplier_id" required
                        value="{{ old('suplier_id', $suplier->suplier_id) }}">
                        </select>
                        @error('suplier_id')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>  </div>     

                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">suplier kode</label>
                    <div class="col-11">
                        <input type="text" class="form-control" id="suplier_kode" name="suplier_kode"
                            value="{{ old('suplier_kode', $suplier->suplier_kode) }}" required>
                        @error('suplier_kode')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>   

                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">suplier nama</label>
                    <div class="col-11">
                        <input type="text" class="form-control" id="suplier_nama" name="suplier_nama" 
                            value="{{ old('suplier_nama', $suplier->suplier_nama) }}" required>
                        @error('suplier_nama')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>    
            
                </div>    
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label"></label>
                    <div class="col-11">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        <a class="btn btn-sm btn-default ml-1" href="{{ url('suplier') }}">Kembali</a>
                    </div>
                </div>
            </form>
        @endempty
    </div>
</div>
@endsection
@push('css')
@endpush
@push('js')
@endpush