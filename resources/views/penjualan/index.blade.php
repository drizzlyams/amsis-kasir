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

            <form method="post" class="form-horizontal form-produk">
                {{ csrf_field() }}
                <input type="hidden" name="idpenjualan" value="{{ $idpenjualan }}">
                <div class="form-group">
                    <label for="kode_produk" class="col-md-2">Kode Produk</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <input type="text" class="form-control" name="kode" id="kode" autofocus>

                            <span class="input-group-btn">
                                <button onclick="showProduct()" type="button" class="btn btn-info">Cari Barang</button>

                            </span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form class="form-keranjang">
                {{ csrf_field() }} {{ method_field('PATCH') }}
                <table class="table table-bordered tabel-penjualan">
                    <thead>
                        <tr>

                            <th width ="30">No</th>
                            <th>Kode Produk</th>
                            <th>Nama Produk</th>
                            <th align="right">Harga</th>
                            <th>Jumlah</th>
                            <th>Diskon</th>
                            <th align="right">Sub Total</th>
                            <th width="100">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>


                    </tbody>

                </table>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    @include('penjualan.produk')
    <script>
        var table, save_method;
        $(function() {
            $('.tabel-produk').DataTable();

            table + $('.tabel-penjualan').DataTable({
                "dcm": 'brt',
                "bSort": false,
                "processing": true,
                "ajax": {
                    "url": "{{route('penjualan.data', $idpenjualan) }}",
                    "type": "GET"
                }
            }).on('draw.dt', function(){
                loadForm($('#diskon)').val());
            });
        });


        function showProduct() {
            $('#modal-produk').modal('show');
            // alert('TEST');
        }

        function selectItem(kode) {
            alert(kode);
            $('#kode').val(kode);
            $('#modal-produk').modal('hide');
            addItem();

        }

        function addItem() {
            $.ajax({
                type: "POST",
                "_token": "{{ csrf_token() }}",
                url: "{{ route('penjualan.store') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: $('.form-produk').serialize(),
                success: function(response) {
                    $('#kode').val('').focus();
                    table.ajax.reload(function() {
                        // loadForm($('#diskon').val());
                    });

                },
                error: function() {
                    alert("Tidak Dapat Menyimpan Data!");
                }
            });

        }
    </script>
@endsection
