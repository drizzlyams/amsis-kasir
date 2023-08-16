<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            // $data = member::select('*');
            $data = Member::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('nomor', function ($row) {

                    return $row->id;
                })
                // ->addColumn('cek', function ($item) {
                //     $cek = "<input type='checkbox' id='".$item->id_member."' name='someCheckbox'/>";
                //     return $cek;
                // })
                ->addColumn('action', function ($row) {
                    $btn = '<div class="btn-group">
            <a onclick="editForm(' . $row->id . ')" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
            <a onclick="deleteData(' . $row->id . ')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        
        return view('member.index');
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
        $member = new Member;
        $member->kode_member= $request['kode_member'];
        $member->nama_member= $request['nama_member'];
        $member->alamat= $request['alamat'];
        $member->telepon= $request['telepon'];
        $member->save();
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
        $member = Member::find($id);
        echo json_encode($member);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $member = Member::find($id);
        $member->kode_member= $request['kode_member'];
        $member->nama_member= $request['nama_member'];
        $member->alamat= $request['alamat'];
        $member->telepon= $request['telepon'];
        $member->update();
        echo json_encode(array('msg'=>'success'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        //
        $member = Member::find($id);
        $member->delete();
    }
}
