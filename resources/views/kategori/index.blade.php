@extends('layouts.app')
@section('content')
    <!-- /.card -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Kategori</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Kategori</li>
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
                        <th>ID</th>
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>


                </tbody>

            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    @include('kategori.form')
    <script>
        var table, save_method;
        $(function() {
             table = $(".table").DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": '{!! route('kategori.index') !!}',
                columns: [{
                        data: 'id_kategori',
                        name: 'id_kategori'
                    },
                    {
                        data: 'nama_kategori',
                        name: 'nama_kategori'
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
                    if (save_method == "add") url = "{{ route('kategori.store') }}";
                    else url = "kategori/" + id;

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
            $('.modal-title').text('Tambah Kategori');
        }

        function editForm(id) {
            save_method = "edit";
            $('input[name=_method]').val('PATCH');
            $('#modal-form form')[0].reset();
            $.ajax({
                type: "GET",
                url: "kategori/" + id + "/edit",
                dataType: "JSON",
                success: function(data) {
                    $('#modal-form').modal('show');
                    $('.modal-title').text('Edit Kategori');

                    $('#id').val(data.id_kategori);
                    $('#nama').val(data.nama_kategori);
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
                    url: "kategori/" + id,
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
