<?php

namespace App\Http\Controllers;

use App\Models\SuplierModel;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
// use Illuminate\Support\Facades\Hash;


class SuplierController extends Controller
{
    // Menampilkan halaman awal suplier
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar suplier',
            'list' => ['Home', 'suplier']
        ];

        $page = (object) [
            'title' => 'Daftar suplier yang terdaftar dalam sistem'
        ];

        $activeMenu = 'suplier'; // set menu yang sedang aktif

        return view('suplier.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    // Ambil data suplier dalam bentuk json untuk datatables
    public function list(Request $request)
    {
        $supliers = SuplierModel::select('suplier_id', 'suplier_kode', 'suplier_nama', 'suplier_alamat');

        return DataTables::of($supliers)
            // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addIndexColumn()
            ->addColumn('aksi', function ($suplier) { // menambahkan kolom aksi
                // $btn = '<a href="' . url('/suplier/' . $suplier->suplier_id) . '" class="btn btn-info btn-sm">Detail</a>';
                // $btn .= '<a href="' . url('/suplier/' . $suplier->suplier_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a>';
                // $btn .= '<form class="d-inline-block" method="POST" action="' . url('/suplier/' . $suplier->suplier_id) . '">' .
                //     csrf_field() . method_field('DELETE') .
                //     '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                // return $btn;

                $btn = '<button onclick="modalAction(\'' . url('/suplier/' . $suplier->suplier_id .
                    '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/suplier/' . $suplier->suplier_id .
                    '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/suplier/' . $suplier->suplier_id .
                    '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';

                return $btn;
            })->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    // Menampilkan halaman form tambah suplier
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah suplier',
            'list' => ['Home', 'suplier', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah suplier baru'
        ];


        $activeMenu = 'suplier'; // set menu yang sedang aktif

        return view('suplier.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    // Menyimpan data suplier baru
    public function store(Request $request)
    {
        $request->validate([
            // suplier_kode harus diisi, berupa string, minimal 3 karakter, dan bernilai unik di tabel m_suplier kolom suplier_kode
            'suplier_kode' => 'required|string|min:3|unique:m_suplier,suplier_kode',
            'suplier_nama' => 'required|string|max:100',
            'suplier_alamat' => 'required|string|max:255'

        ]);

        SuplierModel::create([
            'suplier_kode' => $request->suplier_kode,
            'suplier_nama' => $request->suplier_nama,
            'suplier_alamat' => $request->suplier_alamat,
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
    // Menampilkan halaman form edit suplier
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

    // Menyimpan perubahan data suplier
    public function update(Request $request, string $id)
    {
        $request->validate([
            // suplier_kode harus diisi, berupa string, minimal 3 karakter,
            // dan bernilai unik di tabel m_suplier kolom suplier_kode kecuali untuk suplier dengan id yang sedang diedit
            'suplier_kode' => 'required|string|min:3|unique:m_suplier,suplier_kode,' . $id . ',suplier_id',
            'suplier_nama' => 'required|string|max:100',
            'suplier_alamat' => 'required|string|max:255'
        ]);

        SuplierModel::find($id)->update([
            'suplier_kode' => $request->suplier_kode,
            'suplier_nama' => $request->suplier_nama,
            'suplier_alamat' => $request->suplier_alamat,
        ]);

        return redirect('/suplier')->with('success', 'Data suplier berhasil diubah');
    }

    public function destroy(string $id)
    {
        $check = SuplierModel::find($id);

        if (!$check) {
            // Mengecek apakah data suplier dengan ID yang dimaksud ada atau tidak
            return redirect('/suplier')->with('error', 'Data suplier tidak ditemukan');
        }

        try {
            SuplierModel::destroy($id);
            return redirect('/suplier')->with('success', 'Data suplier berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            // Jika terjadi error ketika menghapus data,  kembali ke halaman dengan pesan error
            return redirect('/suplier')->with('error', 'Data suplier gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }

    public function create_ajax()
    {
        $suplier = SuplierModel::select('suplier_id', 'suplier_nama', 'suplier_alamat')->get();

        return view('suplier.create_ajax', ['suplier' => $suplier]);
    }

    public function store_ajax(Request $request)
    {
        //cek apakah ada request berupa ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'suplier_kode' => 'required|string|max:10|unique:m_suplier,suplier_kode',
                'suplier_nama' => 'required|string|max:100',
            ];

            // use Illuminate\Support\Facades\Validator
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            SuplierModel::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Data suplier berhasil disimpan'
            ]);
        }
    }

    public function edit_ajax(string $id)
    {
        $suplier = SuplierModel::find($id);
        return view('suplier.edit_ajax', ['suplier' => $suplier]);
    }

    public function update_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'suplier_kode' => 'required|string|max:10|unique:m_suplier,suplier_kode,' . $id . ',suplier_id',
                'suplier_nama' => 'required|string|max:100',
            ];
            // use Illuminate\Support\Facades\Validator;
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false, // respon json, true: berhasil, false: gagal
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors() // menunjukkan field mana yang error
                ]);
            }
            $check = SuplierModel::find($id);
            if ($check) {
                $check->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/suplier');
    }

    public function confirm_ajax(string $id)
    {
        $suplier = SuplierModel::find($id);

        return view('suplier.confirm_ajax', ['suplier' => $suplier]);
    }

    public function delete_ajax(Request $request, $id)
    {
        //cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $suplier = SuplierModel::find($id);
            //cek apakah request dari ajax
            if ($suplier) {
                $suplier->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            } else {
                return  response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }

    public function import()
    {
        return view('suplier.import');
    }

    public function import_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {

            $rules = [
                // Validasi file harus xlsx, maksimal 1MB
                'file_suplier' => ['required', 'mimes:xlsx', 'max:1024']
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status'   => false,
                    'message'  => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            // Ambil file dari request
            $file = $request->file('file_suplier');

            // Membuat reader untuk file excel dengan format Xlsx
            $reader = IOFactory::createReader('Xlsx');
            $reader->setReadDataOnly(true); // Hanya membaca data saja

            // Load file excel
            $spreadsheet = $reader->load($file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet(); // Ambil sheet yang aktif

            // Ambil data excel sebagai array
            $data = $sheet->toArray(null, false, true, true);
            $insert = [];

            // Pastikan data memiliki lebih dari 1 baris (header + data)
            if (count($data) > 1) {
                foreach ($data as $baris => $value) {
                    if ($baris > 1) { // Baris pertama adalah header, jadi lewati
                        $insert[] = [
                            'suplier_kode'   => $value['A'],
                            'suplier_nama'   => $value['B'],
                            'suplier_alamat' => $value['C'],
                            'created_at'      => now(),
                        ];
                    }
                }

                if (count($insert) > 0) {
                    // Insert data ke database, jika data sudah ada, maka diabaikan
                    SuplierModel::insertOrIgnore($insert);
                }

                return response()->json([
                    'status'  => true,
                    'message' => 'Data berhasil diimport'
                ]);
            } else {
                return response()->json([
                    'status'  => false,
                    'message' => 'Tidak ada data yang diimport'
                ]);
            }
        }
        return redirect('/');
    }

    public function export_excel()
    {
        //Ambil value barang yang akan diexport
        $suplier = SuplierModel::select(
            'suplier_kode',
            'suplier_nama',
            'suplier_alamat'
        )
            ->orderBy('suplier_id')
            ->get();

        //load library excel
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet(); //ambil sheet aktif

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Kode suplier');
        $sheet->setCellValue('C1', 'Nama suplier');
        $sheet->setCellValue('D1', 'Alamat suplier');

        $sheet->getStyle('A1:D1')->getFont()->setBold(true); // Set header bold

        $no = 1; //Nomor value dimulai dari 1
        $baris = 2; //Baris value dimulai dari 2
        foreach ($suplier as $key => $value) {
            $sheet->setCellValue('A' . $baris, $no);
            $sheet->setCellValue('B' . $baris, $value->suplier_kode);
            $sheet->setCellValue('C' . $baris, $value->suplier_nama);
            $sheet->setCellValue('D' . $baris, $value->suplier_alamat);
            $no++;
            $baris++;
        }

        foreach (range('A', 'D') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true); //set auto size untuk kolom
        }

        $sheet->setTitle('Data suplier'); //set judul sheet
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx'); //set writer
        $filename = 'Data_suplier_' . date('Y-m-d_H-i-s') . '.xlsx'; //set nama file

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');

        $writer->save('php://output'); //simpan file ke output
        exit; //keluar dari scriptA
    }

    public function export_pdf()
    {
        $suplier = SuplierModel::select(
            'suplier_kode',
            'suplier_nama',
            'suplier_alamat'
        )
            ->orderBy('suplier_id')
            ->orderBy('suplier_kode')
            ->get();

        // use Barryvdh\DomPDF\Facade\Pdf;
        $pdf = PDF::loadView('suplier.export_pdf', ['suplier' => $suplier]);
        $pdf->setPaper('A4', 'portrait'); // set ukuran kertas dan orientasi
        $pdf->setOption("isRemoteEnabled", true); // set true jika ada gambar dari url
        $pdf->render(); // render pdf

        return $pdf->stream('Data suplier ' . date('Y-m-d H-i-s') . '.pdf');
    }
}
