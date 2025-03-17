<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use Illuminate\Http\Request;
use App\Models\StokModel;
use App\Models\UserModel;
use DateTime;
use Yajra\DataTables\Facades\DataTables;

class StokController extends Controller
{
    // Menampilkan halaman daftar stok
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar stok',
            'list' => ['Home', 'stok']
        ];

        $page = (object) [
            'title' => 'Daftar stok barang yang terdaftar dalam sistem'
        ];

        $activeMenu = 'stok'; // set menu yang sedang aktif

        $barang = BarangModel::all();
        $user = UserModel::all();

        return view('stok.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'barang' => $barang,
            'user' => $user,
            'activeMenu' => $activeMenu
        ]);
    }

    // Mengambil data stok dalam bentuk JSON untuk datatables
    public function list(Request $request)
    {
        $stok = StokModel::select('stok_id', 'barang_id', 'use_id', 'stok_tanggal','stok_jumlah')
            ->with('barang', 'user');

        if ($request->barang_id && $request->user_id) {
            $stok->where('barang_id', $request->barang_id);
            $stok->where('user', $request->user_id);
        }
        

        return DataTables::of($stok->get())
        ->addIndexColumn()
        ->addColumn('aksi', function ($stok) {
            $btn = '<a href="' . url('/stok/' . $stok->stok_id) . '" class="btn btn-info btn-sm">Detail</a>';
            $btn .= '<a href="' . url('/stok/' . $stok->stok_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a>';
            $btn .= '<form class="d-inline-block" method="POST" action="' . url('/stok/' . $stok->stok_id) . '">' .
                csrf_field() . method_field('DELETE') . 
                '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
            return $btn;
        })
        ->rawColumns(['aksi'])
        ->make(true);
    
    }

    // Menampilkan halaman form tambah stok
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah stok',
            'list' => ['Home', 'stok', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah stok baru'
        ];

        $barang = BarangModel::all();
        $user = UserModel::all();
        $activeMenu = 'stok';

        return view('stok.create', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'barang' => $barang,
            'user'=> $user,
            'activeMenu' => $activeMenu
        ]);
    }

    // Menyimpan data stok baru
    public function store(Request $request)
    {
        $request->validate([
            'stok_id' => 'required|integer|exists:m_stok,stok_id',
            'barang_id' => 'required|integer|exists:m_barang,barang_id',
            'user_id' => 'required|integer|exists:m_user,user_id',
            'stok_tanggal' => 'required|date',
            'stok_jumlah' => 'required|integer|min:0'
        ]);
        

        StokModel::create([
            'stok_id' =>  $request->stok_id,
            'barang_id' =>  $request->barang_id,
            'user_id' =>  $request->user_id,
            'stok_tanggal' =>  $request->stok_tanggal,
            'stok_jumlah' =>  $request->stok_jumlah,
        ]);

        return redirect('/stok')->with('success', 'Data stok berhasil disimpan');
    }

    // Menampilkan detail stok
    public function show(string $id)
    {
        $stok = StokModel::with('barang','user')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail stok',
            'list' => ['Home', 'stok', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail stok'
        ];

        $activeMenu = 'stok';

        return view('stok.show', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'stok' => $stok,
            'activeMenu' => $activeMenu
        ]);
    }

    // Menampilkan halaman form edit stok
    public function edit(string $id)
    {
        $stok = StokModel::find($id);
        $barang = BarangModel::all();
        $user = UserModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit stok',
            'list' => ['Home', 'stok', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit stok'
        ];

        $activeMenu = 'stok';

        return view('stok.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'stok' => $stok,
            'barang' => $barang,
            'user'=> $user,
            'activeMenu' => $activeMenu
        ]);
    }

    // Menyimpan perubahan data stok
    public function update(Request $request, string $id)
    {
        $request->validate([
            'stok_id' => 'required|integer|exists:m_stok,stok_id',
            'barang_id' => 'required|integer|exists:m_barang,barang_id',
            'user_id' => 'required|integer|exists:m_user,user_id',
            'stok_tanggal' => 'required|date',
            'stok_jumlah' => 'required|integer|min:0'
        ]);        

        StokModel::create([
            'stok_id' =>  $request->stok_id,
            'barang_id' =>  $request->barang_id,
            'user_id' =>  $request->user_id,
            'stok_tanggal' =>  $request->stok_tanggal,
            'stok_jumlah' =>  $request->stok_jumlah,
        ]);

        return redirect('/stok')->with('success', 'Data stok berhasil disimpan');
    }

    // Menghapus data stok
    public function destroy(string $id)
    {
        $check = StokModel::find($id);

        if (!$check) {
            return redirect('/stok')->with('error', 'Data stok tidak ditemukan');
        }

        try {
            StokModel::destroy($id);
            return redirect('/stok')->with('success', 'Data stok berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/stok')->with('error', 'Data stok gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}