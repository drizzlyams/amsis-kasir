<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Kategori::select('*');
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action',function($row){
                $btn = '<div class="btn-group">
            <a onclick="editForm('.$row->id_kategori.')" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
            <a onclick="deleteData('.$row->id_kategori.')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';
            return $btn;
            })
            -> rawColumns(['action'])
            ->make(true);
        }
        return view('kategori.index');
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
        $kategori = new Kategori;
        $kategori-> nama_kategori = $request['nama'];
        $kategori->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kategori = new Kategori;
        

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        //
        $kategori = Kategori::find($id);
        echo json_encode($kategori);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $kategori = Kategori::find($id);
        $kategori-> nama_kategori = $request['nama'];
        $kategori->update();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        //
        $kategori = Kategori::find($id);
        $kategori->delete();
    }
}
