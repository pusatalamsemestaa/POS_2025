<?php

namespace App\Http\Controllers;

use App\Models\SuplierModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
// use Illuminate\Support\Facades\Hash;


class SuplierController extends Controller
{
    // Menampilkan halaman awal user
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar suplier',
            'list' => ['Home', 'suplier']
        ];

        $page = (object) [
            'title' => 'List suplier yang terdaftar dalam sistem'
        ];

        $activeMenu = 'suplier'; // set menu yang sedang aktif

        $suplier = SuplierModel::all(); 
        return view('suplier.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'suplier' => $suplier, 'activeMenu' => $activeMenu]);
    }

    // Ambil data user dalam bentuk json untuk datatables

    public function list(Request $request)
    {
        $suplier = SuplierModel::select('suplier_id', 'suplier_kode', 'suplier_nama');


        return DataTables::of($suplier)
            // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addIndexColumn()
            ->addColumn('aksi', function ($suplier) { // menambahkan kolom aksi
                $btn = '<a href="' . url('/suplier/' . $suplier->suplier_id) . '" class="btn btn-info btn-sm">Detail</a>';
                $btn .= '<a href="' . url('/suplier/' . $suplier->suplier_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a>';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/user/' . $suplier->suplier_id) . '">' .
                    csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    // Menampilkan halaman form tambah user
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah suplier',
            'list' => ['Home', 'suplier', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah suplier baru'
        ];

        $suplier = SuplierModel::all(); // ambil data level untuk ditampilkan di form
        $activeMenu = 'suplier'; // set menu yang sedang aktif

        return view('suplier.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'suplier' => $suplier, 'activeMenu' => $activeMenu]);
    }

    // Menyimpan data user baru
    public function store(Request $request)
    {
        $request->validate([
            // username harus diisi, berupa string, minimal 3 karakter, dan bernilai unik di tabel m_user kolom username
            'suplier_id' => 'required|string|min:3|unique:m_suplier',
            'katehori_kode' => 'required|string|max:200', // nama harus diisi, berupa string, dan maksimal 100 karakter
            'suplier_nama' => 'required|atring|max:100', // password harus diisi dan minimal 5 karakter
        ]);

        SuplierModel::create([
            'suplier_id' => $request->suplier_id,
            'suplier_kode' => $request->suplier_kode,
            'suplier_nama' => $request -> suplier_nama,
        ]);

        return redirect('/suplier')->with('success', 'Data suplier berhasil disimpan');
    }

    // Menampilkan detail suplier
    public function show(string $id)
    {
        $suplier = SuplierModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail suplier',
            'list' => ['Home', 'suplier', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail suplier'
        ];

        $activeMenu = 'suplier'; // set menu yang sedang aktif

        return view('suplier.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'suplier' => $suplier, 'activeMenu' => $activeMenu]);
    }
    // Menampilkan halaman form edit user
    public function edit(string $id)
    {
        $suplier = SuplierModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Edit suplier',
            'list' => ['Home', 'suplier', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit suplier'
        ];

        $activeMenu = 'suplier'; // set menu yang sedang aktif

        return view('suplier.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'suplier' => $suplier, 'activeMenu' => $activeMenu]);
    }

    // Menyimpan perubahan suplier user
    public function update(Request $request, string $id)
    {
        $request->validate([
            'suplier_id' => 'required|integer',  // Perbaiki dari 'interger' menjadi 'integer'
            'suplier_kode' => 'required|string|max:20', // Ganti 'varchar' dengan 'string'
            'suplier_nama' => 'required|string|max:100' // Ganti 'varchar' dengan 'string'
        ]);
    
        SuplierModel::find($id)->update([
            'suplier_id' => $request->suplier_id,
            'suplier_kode' => $request->suplier_kode,
            'suplier_nama' => $request->suplier_nama
        ]);
    
        return redirect('/suplier')->with('success', 'Data suplier berhasil diubah');
    }
    

    // Menghapus data user
public function destroy(string $id)
{
    $check = SuplierModel::find($id);
    if (!$check) { // untuk mengecek apakah data user dengan id yang dimaksud ada atau tidak
        return redirect('/suplier')->with('error', 'Data suplier tidak ditemukan');
    }

    try {
        SuplierModel::destroy($id); // Hapus data user

        return redirect('/suplier')->with('success', 'Data suplier berhasil dihapus');
    } catch (\Illuminate\Database\QueryException $e) {

        // Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
        return redirect('/suplier')->with('error', 'Data ategori gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
    }
}
}
