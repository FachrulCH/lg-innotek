<style>
    input{
        text-transform: uppercase;
    }
</style>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Data Produk</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <table id="tbl-customers" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Part No</th>
                            <th>Model</th>
                            <th>Acction</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($tabel_data as $data){
                            echo '
                                <tr>
                                    <td>'.$data['part_no'].'</td>
                                    <td>'.$data['model'].'</td>
                                    <td>
                                        <button class="btn btn-warning btn-xs btn-edit" data-no="'.$data['part_no'].'" data-model="'.$data['model'].'"><i class="fa fa-edit"></i> Edit</button>
                                        <button class="btn btn-danger btn-xs btn-delete" data-no="'.$data['part_no'].'"><i class="fa fa-trash"></i> Delete</button>
                                    </td>
                                </tr>
                            ';
                        }
                        ?>
                    </tbody>
                </table>
                <button class="btn btn-success" id="btn-add"> <i class="fa fa-plus"></i> Add</button>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->

<div class="modal fade" id="mdl-tambah" tabindex="-1" role="dialog" aria-labelledby="mdl-tambah" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h2 class="modal-title">Master Produk</h2>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="form-product" action="<?= base_url('product/simpan') ?>" method="POST">
                    <div class="form-group">
                        <label for="part-no" class="col-sm-4 control-label">Part No</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="part-no" name="part_no" placeholder="No Part" maxlength="20">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="model" class="col-sm-4 control-label">Model</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="model" name="model" placeholder="Model" maxlength="10">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                            <button type="submit" class="btn btn-default">Save</button>
                            <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="mdl-hapus" tabindex="-1" role="dialog" aria-labelledby="mdl-hapus" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h2 class="modal-title">Confirm</h2>
            </div>
            <div class="modal-body">
                Are you sure to delete this item?
            </div>
            <div class="modal-footer">
                <form action="<?= base_url('product/hapus') ?>" method="POST">
                    <input type="hidden" id="id-delete" name="id"/>
                    <button class="btn btn-danger" type="submit">Yes</button>
                <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $("#tbl-customers").dataTable();

        $('#btn-add').on('click', function () {
            $('#mdl-tambah').modal('show');
        });
        
        $('.btn-edit').on('click', function () {
            $('#part-no').val($(this).attr('data-no'));
            $('#model').val($(this).attr('data-model'));
            $('#mdl-tambah').modal('show');
        });
        
        $('.btn-delete').on('click', function () {
            $('#id-delete').val($(this).attr('data-no'));
            $('#mdl-hapus').modal('show');
        });

    });
</script>
