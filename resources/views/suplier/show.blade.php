@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <button onclick="modalAction('{{ url('/suplier/import') }}')" class="btn btn-sm btn-info mt-1">Import
                    Kategori</button>
                <a class="btn btn-sm btn-primary mt-1" href="{{ url('suplier/create') }}">Tambah</a>
                <button onclick="modalAction('{{ url('/suplier/create_ajax') }}')"
                    class="btn btn-sm btn-success mt-1">Tambah Ajax</button>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <table class="table table-bordered table-striped table-hover table-sm" id="table_suplier">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kode suplier</th>
                        <th>Nama suplier</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" databackdrop="static"
        data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection

@push('css')
@endpush

@push('js')
    <script>
        function modalAction(url = '') {
            $('#myModal').load(url, function () {
                $('#myModal').modal('show');
            });
        }

        var datasuplier
        $(document).ready(function () {
            datasuplier = $('#table_suplier').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ url('suplier/list') }}",
                    "dataType": "json",
                    "type": "POST",
                },
                columns: [
                    {
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
                        data: "suplier_nama",
                        className: "",
                        orderable: true,
                        searchable: true
                    }, {
                        data: "aksi",
                        className: "",
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@endpush