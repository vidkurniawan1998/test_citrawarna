<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BarangMasuk;
use Illuminate\Support\Facades\Storage;

class BarangMasukController extends Controller
{
    // Untuk Menampilkan Data Barang Masuk
    public function index()
    {
        $barangMasuk = BarangMasuk::paginate(5);
        return view('pages.barangmasuk', compact('barangMasuk'));
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

        $barangMasuk = BarangMasuk::create([
            'nama_barang' => $request->nama_barang,
            'deskripsi' => $request->deskripsi,
            'qty' => $request->qty,
            'harga_barang' => $request->harga_barang,
            'image' => request('image')->store('uploads/barangmasuk')
        ]);

        if ($barangMasuk) {
            return redirect()->back()->with(['success' => 'Data Barang Masuk Berhasil Tersimpan'], 201);
        } else {
            return redirect()->back()->with(['error' => 'Data Barang Masuk Gagal Tersimpan'], 500);
        }
    }

    public function show($id)
    {
        $barangMasuk = BarangMasuk::find($id);

        $res = [
            'nama_barang' => $barangMasuk->nama_barang,
            'id' => $barangMasuk->id,
            'deskripsi' => $barangMasuk->deskripsi,
            'qty' => $barangMasuk->qty,
            'harga_barang' => $barangMasuk->harga_barang,
            'image' => asset('storage/' . $barangMasuk->image)
        ];

        return response()->json($res);
    }

    public function update(Request $request, $id)
    {
        $barangMasuk = BarangMasuk::find($id);

        $this->validate($request,   [
            'nama_barang' => 'required',
            'deskripsi' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg',
            'qty' => 'required|numeric',
            'harga_barang' => 'required|numeric'
        ]);

        if ($request->hasFile('image') == "") {
            $barangMasuk->update([
                'nama_barang' => $request->nama_barang,
                'deskripsi' => $request->deskripsi,
                'qty' => $request->qty,
                'harga_barang' => $request->harga_barang,
            ]);
        } else {

            Storage::disk('local')->delete('uploads/barangmasuk' . $barangMasuk->image);

            $barangMasuk->update([
                'nama_barang' => $request->nama_barang,
                'deskripsi' => $request->deskripsi,
                'image' => request('image')->store('uploads/barangmasuk'),
                'qty' => $request->qty,
                'harga_barang' => $request->harga_barang
            ]);
        }

        //Validasi Untuk Menampilkan Notifikasi Apabila Berhasil dan Gagal Dalam Mengubah Data
        if ($barangMasuk) {
            return response()->json($barangMasuk);
        } else {
            return response()->json(['error' => 'Error Update']);
        }
    }

    public function destroy($id)
    {
        $barangMasuk = BarangMasuk::find($id);

        Storage::disk('local')->delete('uploads/barangmasuk' . $barangMasuk->image);

        $barangMasuk->delete();
        return redirect()->back()->with(['success' => 'Data Barang Masuk Berhasil Dihapus'], 201);
    }
}
