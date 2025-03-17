@extends('layouts.template') 

@section('content') 
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a class="btn btn-sm btn-primary mt-1" href="{{ url('suplier/create') }}">Tambah</a>
            </div>
        </div>
        <div class="card-body">

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                
        <div class="row"> 
            <div class="col-md-12"> 
                <div class="form-group row"> 
                    <label class="col-1 control-label col-form-label">Filter:</label> 
                        <div class="col-3"> 
                            <select class="form-control" id="suplier_id" name="suplier_id" required> 
                                <option value="">- Semua -</option> 
                                @foreach($suplier as $item) 
                                  <option value="{{ $item->suplier_id }}">{{ $item->suplier_nama }}</option> 
                                @endforeach 
                             </select> 
                            <small class="form-text text-muted">suplier Pengguna</small> 
                        </div> 
                    </div> 
                  </div> 
                </div> 
  
            <table class="table table-bordered table-striped table-hover table-sm" id="table_suplier">
                <thead>
                    <tr>
                        <th>suplier_id</th>
                        <th>suplier_kode</th>
                        <th>suplier_nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('css') 
@endpush

@push('js')     <script>
        $(document).ready(function () {
            var datasuplier = $('#table_suplier').DataTable({
                // serverSide: true, jika ingin menggunakan server side processing 
                serverSide: true,
                ajax: {
                    url: "{{ url('suplier/list') }}",
                    dataType: "json",
                    type: "POST",

                    data: function (d) {
                        d.suplier_id = $('#suplier_id').val();
                    }

                },
                columns: [
                    {
                        // nomor urut dari laravel datatable addIndexColumn() 
                        data: "DT_RowIndex",
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    }, {
                        data: "suplier_kode",
                        className: "",
                        orderable: true,
                        searchable: true
                    }, {
                        // mengambil data suplier hasil dari ORM berelasi 
                        data: "suplier_nama",
                        className: "",
                        orderable: false,
                        searchable: false
                    }, {
                        data: "aksi",
                        className: "",
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            $('#suplier_id').on('change', function(){
                datasuplier.ajax.reload();
            });
        }); 
    </script>
@endpush