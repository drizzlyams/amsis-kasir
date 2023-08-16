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
                                <label for="nama" class=" control-label">Kode Member</label>
                                <input type="text" name="kode_member" id="kode_member" class="form-control">
                                <span class="help-block with-errors"> </span>
                            </div>
                            <div class="form-group">
                                <label for="nama" class=" control-label">Nama Member</label>
                                <input type="text" name="nama_member" id="nama_member" class="form-control">
                                <span class="help-block with-errors"> </span>
                            </div>
                           
                        </div>
                        <div class="col-md-6">
                            
                            <div class="form-group">
                                <label for="nama" class=" control-label">Alamat</label>
                                <input type="text" name="alamat" id="alamat" class="form-control">
                                <span class="help-block with-errors"> </span>
                            </div>
                            <div class="form-group">
                                <label for="nama" class=" control-label">Telepon</label>
                                <input type="text" name="telepon" id="telepon" class="form-control">
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
