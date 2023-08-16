@extends('layouts.app')
@section('content')
    <!-- /.card -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Supplier</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Supplier</li>
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
                      
                        <th>Kode Supplier</th>
                        <th>Nama Supplier</th>
                        <th>Alamat Supplier</th>
                        <th>Telepon Supplier</th>
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
    @include('supplier.form')
    <script>
        var table, save_method;
        $(function() {
             table = $(".table").DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": '{!! route('supplier.index') !!}',
                columns: [
                    // {
                    //     data: 'cek',
                    //     name: 'cek'
                    // },
                    {
                        data: 'kode_sup',
                        name: 'kode_sup'
                    },
                    {
                        data: 'nama_sup',
                        name: 'nama_sup'
                    },
                    {
                        data: 'alamat_sup',
                        name: 'alamat_sup'
                    },
                    {
                        data: 'telepon_sup',
                        name: 'telepon_sup'
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
                    if (save_method == "add") url = "{{ route('supplier.store') }}";
                    else url = "supplier/" + id;

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
                url: "supplier/" + id + "/edit",
                dataType: "JSON",
                success: function(data) {
                    $('#modal-form').modal('show');
                    $('.modal-title').text('Edit Produk');

                    $('#id').val(data.id);
                    $('#kode_sup').val(data.kode_sup);
                    $('#nama_sup').val(data.nama_sup);
                    $('#alamat_sup').val(data.alamat_sup);
                    $('#telepon_sup').val(data.telepon_sup);
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
                    url: "supplier/" + id,
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
