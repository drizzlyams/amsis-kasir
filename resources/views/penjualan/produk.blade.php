<div class="modal fade" id="modal-produk">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

         <div class="modal-body">
            <table class="table table-stripped tabel-produk">
                <thead>
                    <tr>
                        <th>Kode produk</th>
                        <th>Nama produk</th>
                        <th>Harga Beli</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($produk as $data)
                    <tr>
                        <th>{{ $data->kode_produk }}</th>
                        <th>{{ $data->nama_produk }}</th>
                        <th>{{ $data->harga_beli }}</th>
                        <th>
                            <a onclick="selectItem({{ $data->kode_produk }})" class="btn btn-primary">Pilih</a>
                        </th>
                    </tr>
                    @endforeach
                </tbody>
            </table>
         </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
