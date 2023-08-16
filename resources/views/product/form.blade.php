<div class="modal fade" id="modal-form">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form class="form-horizontal" data-toggle="validator" method="post">
                {{ csrf_field() }}{{ method_field('POST') }}


                <div class="modal-header">
                    <h4 class="modal-title">Default Modal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama" class=" control-label">Kode Produk</label>
                                <input type="text" name="kode_produk" id="kode_produk" class="form-control">
                                <span class="help-block with-errors"> </span>
                            </div>
                            <div class="form-group">
                                <label for="nama" class=" control-label">Nama Produk</label>
                                <input type="text" name="nama_produk" id="nama_produk" class="form-control">
                                <span class="help-block with-errors"> </span>
                            </div>
                            <div class="form-group">
                                <label for="nama" class=" control-label">Kategori</label>
                                <select name="kategori" id="kategori" class="form-control">
                                    <option value=""> -- Pilih Kategori -- </option>
                                    @foreach ($kategori as $list)
                                    <option value="{{$list->id_kategori}}"> {{$list->nama_kategori}} </option>
                                    @endforeach
                                </select>
                                <span class="help-block with-errors"> </span>
                            </div>
                            <div class="form-group">
                                <label for="nama" class=" control-label">Merek</label>
                                <input type="text" name="merek" id="merek" class="form-control">
                                <span class="help-block with-errors"> </span>
                            </div>
                            <div class="form-group">
                                <label for="nama" class=" control-label">Foto</label>
                                <input type="file" name="foto" id="foto" class="form-control">
                                <span class="help-block with-errors"> </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama" class=" control-label">Harga Beli</label>
                                <input type="text" name="harga_beli" id="harga_beli" class="form-control">
                                <span class="help-block with-errors"> </span>
                            </div>
                            <div class="form-group">
                                <label for="nama" class=" control-label">Harga Jual</label>
                                <input type="text" name="harga_jual" id="harga_jual" class="form-control">
                                <span class="help-block with-errors"> </span>
                            </div>
                            <div class="form-group">
                                <label for="nama" class=" control-label">Diskon</label>
                                <input type="text" name="diskon" id="diskon" class="form-control">
                                <span class="help-block with-errors"> </span>
                            </div>
                            <div class="form-group">
                                <label for="nama" class=" control-label">Stok</label>
                                <input type="text" name="stok" id="stok" class="form-control">
                                <span class="help-block with-errors"> </span>
                            </div>
                            <div class="form-group">
                                <label for="nama" class=" control-label">satuan</label>
                                <select name="satuan" id="satuan" class="form-control">
                                    <option value=""> -- Pilih Satuan -- </option>
                                    <option value="dus">Dus</option>
                                    <option value="pcs">Pcs</option>
                                    <option value="pak">Pak</option>
                                    <option value="rcg">Renceng</option>
                                    <option value="ktg">Kantong</option>
                                    <option value="kg">Kilogram</option>
                                </select>
                                <span class="help-block with-errors"> </span>
                            </div>
                        </div>
                    </div>



                </div>
                <div class="modal-footer justify-content-between">
                    <button type="reset" class="btn btn-default btn-save" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
