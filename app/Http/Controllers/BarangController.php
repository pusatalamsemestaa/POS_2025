<?php

namespace App\Http\Controllers;

// use App\Models\kategoriModel;

use App\Models\KategoriModel;
use App\Models\BarangModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
// use Illuminate\Support\Facades\Hash;


class BarangController extends Controller
{
    // Menampilkan halaman awal Barang
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Barang',
            'list' => ['Home', 'Barang']
        ];

        $page = (object) [
            'title' => 'Daftar barang yang terdaftar dalam sistem'
        ];

        $activeMenu = 'barang'; // set menu yang sedang aktif

        $kategori = KategoriModel::all(); //ambil data kategori untuk filter kategori

        return view('barang.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }

    // Ambil data Barang dalam bentuk json untuk datatables

    public function list(Request $request)
    {
        $barang = BarangModel::select('barang_id', 'kategori_id', 'barang_kode', 'barang_nama', 'harga_beli', 'harga_jual')
            ->with('kategori');

            //Filter data Barang berdasarkan kategori_id
            iF($request->kategori_id){
                $barang->where('kategori_id', $request->kategori_id);
            }
        return DataTables::of($barang)
            // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addIndexColumn()
            ->addColumn('aksi', function ($barang) { // menambahkan kolom aksi
                $btn = '<a href="' . url('/barang/' . $barang->barang_id) . '" class="btn btn-info btn-sm">Detail</a>';
                $btn .= '<a href="' . url('/barang/' . $barang->barang_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a>';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/barang/' . $barang->barang_id) . '">' .
                    csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    // Menampilkan halaman form tambah Barang
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Barang',
            'list' => ['Home', 'Barang', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Barang baru'
        ];

        $kategori = kategoriModel::all(); // ambil data kategori untuk ditampilkan di form
        $activeMenu = 'Barang'; // set menu yang sedang aktif

        return view('Barang.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }

    // Menyimpan data Barang baru
    public function store(Request $request)
    {
        $request->validate([
            // Barangname harus diisi, berupa string, minimal 3 karakter, dan bernilai unik di tabel m_Barang kolom Barangname
            'barang_id' => 'required|string|min:3|unique:m_Barang,Barangname',
            'nama' => 'required|string|max:100', // nama harus diisi, berupa string, dan maksimal 100 karakter
            'password' => 'required|min:5', // password harus diisi dan minimal 5 karakter
            'kategori_id' => 'required|integer' // kategori_id harus diisi dan berupa angka
        ]);

        BarangModel::create([
            'Barangname' => $request->Barangname,
            'nama' => $request->nama,
            'password' => bcrypt($request->password), // password dienkripsi sebelum disimpan
            'kategori_id' => $request->kategori_id
        ]);

        return redirect('/Barang')->with('success', 'Data Barang berhasil disimpan');
    }

    // Menampilkan detail Barang
    public function show(string $id)
    {
        $Barang = BarangModel::with('kategori')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Barang',
            'list' => ['Home', 'Barang', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Barang'
        ];

        $activeMenu = 'Barang'; // set menu yang sedang aktif

        return view('Barang.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'Barang' => $Barang, 'activeMenu' => $activeMenu]);
    }
    // Menampilkan halaman form edit Barang
    public function edit(string $id)
    {
        $Barang = BarangModel::find($id);
        $kategori = kategoriModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit Barang',
            'list' => ['Home', 'Barang', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Barang'
        ];

        $activeMenu = 'Barang'; // set menu yang sedang aktif

        return view('Barang.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'Barang' => $Barang, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }

    // Menyimpan perubahan data Barang
    public function update(Request $request, string $id)
    {
        $request->validate([ 
            'barang_id' => 'required|integer',
            'kategori_id' => 'required|integer',
            'barang_kode' => 'required|varcar|max:10',
            'barang_nama' => 'required|varchar|max:100', 
            'harga_beli' => 'required|integer',
            'harga_jual' => 'required|integer',
        ]);

        BarangModel::find($id)->update([
            'barang_id' => $request->barang_id,
            'kategori_id' => $request->kategori_id,
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama, 
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual
        ]);

        return redirect('/Barang')->with('success', 'Data Barang berhasil diubah');

        
    }

    // Menghapus data Barang
public function destroy(string $id)
{
    $check = BarangModel::find($id);
    if (!$check) { // untuk mengecek apakah data Barang dengan id yang dimaksud ada atau tidak
        return redirect('/Barang')->with('error', 'Data Barang tidak ditemukan');
    }

    try {
        BarangModel::destroy($id); // Hapus data Barang

        return redirect('/Barang')->with('success', 'Data Barang berhasil dihapus');
    } catch (\Illuminate\Database\QueryException $e) {

        // Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
        return redirect('/Barang')->with('error', 'Data Barang gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
    }
}
}