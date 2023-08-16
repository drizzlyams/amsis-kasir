@extends('layouts.app')
@section('content')
    <!-- /.card -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Produk</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Produk</li>
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
                        <th width="20">No</th>
                        <th>Kode Produk</th>
                        <th>Nama Produk</th>
                        <th>Foto</th>
                        <th>Kategori</th>
                        <th>Merk</th>
                        <th>Satuan</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Diskon</th>
                        <th>Stok</th>
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
    @include('product.form')
    <script>
        var table, save_method;
        $(function() {
             table = $(".table").DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{!! route('product.index') !!}",
                columns: [
                    // {
                    //     data: 'checkbox',
                    //     name: 'checkbox'
                    // },
                    {
                        data: 'nomor',
                        name: 'nomor'
                    },
                    {
                        data: 'kode_produk',
                        name: 'kode_produk'
                    },
                    {
                        data: 'nama_produk',
                        name: 'nama_produk'
                    },
                    {
                        data: 'gambar',
                        name: 'gambar'
                    },
                    {
                        data: 'nama_kategori',
                        name: 'nama_kategori'
                    },
                    {
                        data: 'merek',
                        name: 'merek'
                    },
                    {
                        data: 'satuan',
                        name: 'satuan'
                    },
                    {
                        data: 'harga_beli',
                        name: 'harga_beli'
                    },
                    {
                        data: 'harga_jual',
                        name: 'harga_jual'
                    },
                    {
                        data: 'diskon',
                        name: 'diskon'
                    },
                    {
                        data: 'stok',
                        name: 'stok'
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
                    if (save_method == "add") url = "{{ route('product.store') }}";
                    else url = "product/" + id;

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
                url: "product/" + id + "/edit",
                dataType: "JSON",
                success: function(data) {
                    $('#modal-form').modal('show');
                    $('.modal-title').text('Edit Produk');

                    $('#id').val(data.id);
                    $('#kode_produk').val(data.kode_produk);
                    $('#nama_produk').val(data.nama_produk);
                    $('#kategori').val(data.id_kategori);
                    $('#merek').val(data.merek);
                    $('#harga_beli').val(data.harga_beli);
                    $('#harga_jual').val(data.harga_jual);
                    $('#diskon').val(data.diskon);
                    $('#stok').val(data.stok);
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
                    url: "product/" + id,
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
