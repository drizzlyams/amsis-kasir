@extends('layouts.app')
@section('content')
    <!-- /.card -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Member</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Member</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="card">
        <div class="card-header">
            <a onclick="addForm()" class="btn btn-primary" href="#" role="button"><i class="fa fa-plus-circle"
                    aria-hidden="true"></i> Tambah</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        {{-- <th width="20"><input type="checkbox" name="" id="select-all"></th> --}}
                      
                        <th>Kode Member</th>
                        <th>Nama Member</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                        <th width="100">Aksi</th>
                    </tr>
                </thead>
                <tbody>


                </tbody>

            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    @include('member.form')
    <script>
        var table, save_method;
        $(function() {
             table = $(".table").DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": '{!! route('member.index') !!}',
                columns: [
                    // {
                    //     data: 'cek',
                    //     name: 'cek'
                    // },
                    {
                        data: 'kode_member',
                        name: 'kode_member'
                    },
                    {
                        data: 'nama_member',
                        name: 'nama_member'
                    },
                    {
                        data: 'alamat',
                        name: 'alamat'
                    },
                    {
                        data: 'telepon',
                        name: 'telepon'
                    },
                   
                  
                    {
                        data: 'action',
                        name: 'action',

                        orderable: true,
                        searchable: true
                    },
                ]

            });

            $('#modal-form form').on('submit', function(e) {
                if (!e.isDefaultPrevented()) {
                    var id = $('#id').val();
                    if (save_method == "add") url = "{{ route('member.store') }}";
                    else url = "member/" + id;

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: $('#modal-form form').serialize(),
                        success: function(hasil) {
                            $('#modal-form').modal('hide');
                            table.ajax.reload();
                        },
                        error: function() {
                            alert("Tidak Dapat Menyimpan Data");
                        }
                    });
                    return false;
                }
            })
        });

        function addForm() {
            save_method = "add";
            $('input[name=_method]').val('POST');
            $('#modal-form').modal('show');
            $('#modal-form form')[0].reset();
            $('.modal-title').text('Tambah Produk');
        }

        function editForm(id) {
            save_method = "edit";
            $('input[name=_method]').val('PATCH');
            $('#modal-form form')[0].reset();
            $.ajax({
                type: "GET",
                url: "member/" + id + "/edit",
                dataType: "JSON",
                success: function(data) {
                    $('#modal-form').modal('show');
                    $('.modal-title').text('Edit Produk');

                    $('#id').val(data.id);
                    $('#kode_member').val(data.kode_member);
                    $('#nama_member').val(data.nama_member);
                    $('#alamat').val(data.alamat);
                    $('#telepon').val(data.telepon);
                },
                error: function() {
                    alert("Tidak Dapat Menampilkan Data");
                }
            });
        }

        function deleteData(id) {
            if (confirm("Apakah yakin data akan dihapus?")) {
                $.ajax({
                    type: "POST",
                    url: "member/" + id,
                    data: {
                        '_method': 'DELETE',
                        '_token': $('meta[name=csrf-token]').attr('content'),
                    },
                    success: function(data) {
                        table.ajax.reload();
                    },
                    error: function() {
                        alert("Tidak Dapat Menghapus Data");
                    }
                });
            }

        }
    </script>
@endsection
