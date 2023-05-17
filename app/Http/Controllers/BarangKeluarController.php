<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BarangKeluar;
use Illuminate\Support\Facades\Storage;

class BarangKeluarController extends Controller
{
    // Untuk Menampilkan Data Barang Masuk
    public function index()
    {
        $barangKeluar = BarangKeluar::paginate(5);
        return view('pages.barangkeluar', compact('barangKeluar'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_barang' => 'required',
            'deskripsi' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg',
            'qty' => 'required|numeric',
            'harga_barang' => 'required|numeric'
        ]);

        $barangKeluar = BarangKeluar::create([
            'nama_barang' => $request->nama_barang,
            'deskripsi' => $request->deskripsi,
            'qty' => $request->qty,
            'harga_barang' => $request->harga_barang,
            'image' => request('image')->store('uploads/barangkeluar')
        ]);

        if ($barangKeluar) {
            return redirect()->back()->with(['success' => 'Data Barang Keluar Berhasil Tersimpan'], 201);
        } else {
            return redirect()->back()->with(['error' => 'Data Barang Keluar Gagal Tersimpan'], 500);
        }
    }

    public function show($id)
    {
        $barangKeluar = BarangKeluar::find($id);

        $res = [
            'nama_barang' => $barangKeluar->nama_barang,
            'id' => $barangKeluar->id,
            'deskripsi' => $barangKeluar->deskripsi,
            'qty' => $barangKeluar->qty,
            'harga_barang' => $barangKeluar->harga_barang,
            'image' => asset('storage/' . $barangKeluar->image)
        ];

        return response()->json($res);
    }

    public function update(Request $request, $id)
    {
        $barangKeluar = BarangKeluar::find($id);

        $this->validate($request,   [
            'nama_barang' => 'required',
            'deskripsi' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg',
            'qty' => 'required|numeric',
            'harga_barang' => 'required|numeric'
        ]);

        if ($request->hasFile('image') == "") {
            $barangKeluar->update([
                'nama_barang' => $request->nama_barang,
                'deskripsi' => $request->deskripsi,
                'qty' => $request->qty,
                'harga_barang' => $request->harga_barang,
            ]);
        } else {

            Storage::disk('local')->delete('uploads/barangkeluar' . $barangKeluar->image);

            $barangKeluar->update([
                'nama_barang' => $request->nama_barang,
                'deskripsi' => $request->deskripsi,
                'image' => request('image')->store('uploads/barangkeluar'),
                'qty' => $request->qty,
                'harga_barang' => $request->harga_barang
            ]);
        }

        //Validasi Untuk Menampilkan Notifikasi Apabila Berhasil dan Gagal Dalam Mengubah Data
        if ($barangKeluar) {
            return response()->json($barangKeluar);
        } else {
            return response()->json(['error' => 'Error Update']);
        }
    }

    public function destroy($id)
    {
        $barangKeluar = BarangKeluar::find($id);

        Storage::disk('local')->delete('uploads/barangkeluar' . $barangKeluar->image);

        $barangKeluar->delete();
        return redirect()->back()->with(['success' => 'Data Barang Keluar Berhasil Dihapus'], 201);
    }
}
