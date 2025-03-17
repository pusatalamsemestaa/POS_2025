@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a class="btn btn-sm btn-primary mt-1" href="{{ url('stok/create') }}">Tambah</a>
            </div>
        </div>
        <div class="card-body">
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            

            <table class="table table-bordered table-striped table-hover table-sm" id="table_stok">
                <thead>
                    <tr>
                        <th>Stok ID</th>
                        <th>Barang ID</th>
                        <th>User ID</th>
                        <th>Stok Tanggal</th>
                        <th>Stok Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('css')
@endpush

@push('js')
    <script>
        $(document).ready(function () {
            var datatable = $('#table_stok').DataTable({
                serverside: true,
                processing: true,
                ajax: {
    url: "{{ url('stok/list') }}",
    type: "POST",
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data: function (d) {
        d.barang_id = $('#barang_id').val();
        d.user_id = $('#user_id').val();  // Pastikan ID user juga dikirim jika ada filter
    }
}
,
                columns: [
                    {
                        data: 'DT_RowIndex',
                        className: 'text-center',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'stok_id',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'barang_id',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'user_id',
                        orderable: true,
                        searchable: true,
                        className: 'text-right'
                    },
                    {
                        data: 'stok_tanggal',
                        orderable: true,
                        searchable: true,
                        className: 'text-right'
                    },
                    {
                        data: 'stok_jumlah',
                        orderable: true,
                        searchable: true,
                        className: 'text-right'
                    },
                    {
                        data: 'aksi',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $('#barang_id').on('change', function(){
                datatable.ajax.reload();
            });
        });
    </script>
@endpush