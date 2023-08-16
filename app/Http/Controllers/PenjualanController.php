<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use App\Models\Produk;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        
        $produk = Produk::all();
        $member = Member::all();
        $setting = Setting::all();
        $sesi = PenjualanDetail::first();
        $idpenjualan = session('idpenjualan');
        $idpenjualan = session($sesi->id_penjualan);
        return view('penjualan.index', compact('produk', 'member', 'setting', 'idpenjualan'));

    }
    public function listData($id)
    {
        $detail = PenjualanDetail::leftJoin('produks', 'produks.kode_produk', '=', 'penjualan_details.kode_produk')
        ->where('id_penjualan', '=', $id)
        ->get();
// print_r($detail);
// exit();
        $no = 0;
        $data = array();
        $total = 0;
        $total_item = 0;
        foreach ($detail as $list) {
            $no ++;
            $row = array();
            $row[] = $no;
            $row[] = $list->kode_produk;
            $row[] = $list->nama_produk;
            $row[] = $list->harga_jual;
            $row[] = "<input type='number' class='form-control' name='jumlah_$list->id_penjualan_detail' value='$list->jumlah' onChange='changeCount($list->id_penjualan_detail)'>";
            $row[] = $list->diskon."%";
            $row[] = $list->sub_total;
            $row[] = '<div clas+"btn-group "><a onclick="deleteItem('.$list->id_penjualan_detail.')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';
            $data[] = $row;

            $total += $list->harga_jual * $list->jumlah;
            $total_item += $list->jumlah;
        }
        $data[] = array("<span class='hide total'>$total</span><span class+'hide totalitem'>$total_item</span","","","","","","","");

        $output = array("data"=> $data);
        return response()->json($output);
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
        $produk = Produk::where('kode_produk', '=', $request['kode'])->first();
        $detail = new PenjualanDetail;
        $detail->id_penjualan = $request ['idpenjualan'];
        $detail->kode_produk = $request ['kode'];
        $detail->harga_jual = $produk->harga_jual;
        $detail->jumlah = 1;
        $detail->diskon = $produk->diskon;
        $detail->sub_total = $produk->harga_jual - ($produk->diskon/100 * $produk->harga_jual);
        $detail->save();
    }

    public function newSession()
    {
        $penjualan=new Penjualan;
        $penjualan->kode_member = 0;
        $penjualan->total_item = 0;
        $penjualan->total_harga = 0;
        $penjualan->diskon = 0;
        $penjualan->bayar = 0;
        $penjualan->diterima = 0;
        $penjualan->id_user = Auth::user()->id;
        $penjualan->save();
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
