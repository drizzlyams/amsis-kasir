<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            // $data = Produk::select('*');
            $data = Produk::leftjoin('kategoris', 'kategoris.id_kategori', '=', 'produks.id_kategori')
            ->orderBy('produks.id', 'desc')
            ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                
                // ->addColumn('checkbox', function ($item) {
                //     $cek = "<input type='checkbox' name='id[]' value='".$item->id."' >";
                //     return $cek;
                // })
                ->addColumn('nomor', function ($row) {

                    return $row->id_produk;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<div class="btn-group">
            <a onclick="editForm(' . $row->id . ')" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
            <a onclick="deleteData(' . $row->id . ')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $kategori = Kategori::all();
        return view('product.index', compact('kategori'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $produk = new Produk;
        $produk->kode_produk= $request['kode_produk'];
        $produk->nama_produk= $request['nama_produk'];
        $produk->id_kategori= $request['kategori'];
        $produk->merek= $request['merek'];
        $produk->harga_beli= $request['harga_beli'];
        $produk->harga_jual= $request['harga_jual'];
        $produk->diskon= $request['diskon'];
        $produk->stok= $request['stok'];
        $produk->satuan= $request['satuan'];
        $produk->save();
        echo json_encode(array('msg'=>'success'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        //
        $produk = Produk::find($id);
        echo json_encode($produk);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $produk = Produk::find($id);
        $produk->kode_produk= $request['kode_produk'];
        $produk->nama_produk= $request['nama_produk'];
        $produk->id_kategori= $request['kategori'];
        $produk->merek= $request['merek'];
        $produk->harga_beli= $request['harga_beli'];
        $produk->harga_jual= $request['harga_jual'];
        $produk->diskon= $request['diskon'];
        $produk->stok= $request['stok'];
        $produk->satuan= $request['satuan'];
        $produk->update();
        echo json_encode(array('msg'=>'success'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        //
        $produk = Produk::find($id);
        $produk->delete();
    }
}