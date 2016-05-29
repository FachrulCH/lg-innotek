<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">History CAR</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="div-filter">                    
                    <form class="form-horizontal">
                        <div class="form-group form-inline">
                            <label for="cust-name" class="col-sm-2 control-label">Request Date </label>
                            <div class="col-sm-9 form-group">
                                <input type="date" class="form-control"> - 
                                <input type="date" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cust-name" class="col-sm-2 control-label">Customer Name</label>
                            <div class="col-sm-2">
                                <select class="form-control">
                                    <option>-Pilih Customer-</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default"> <i class="fa fa-search"></i> Search</button>
                            </div>
                        </div>
                    </form>
                </div>




                <table id="tbl-customers" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>CARID</th>
                            <th>NGID</th>
                            <th>Submit Date</th>
                            <th>Deskripsi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>2323232</td>
                            <td>A1111</td>
                            <td>01-Jan-2016</td>
                            <td>Rusak nih coy</td>
                            <td>
                                <button class="btn btn-success btn-xs btn-edit"><i class="fa fa-download"></i> Download</button>
                                <button class="btn btn-danger btn-xs btn-delete"><i class="fa fa-trash"></i> Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>2323232</td>
                            <td>A1111</td>
                            <td>01-Jan-2016</td>
                            <td>Rusak nih coy</td>
                            <td>
                                <button class="btn btn-success btn-xs btn-edit"><i class="fa fa-download"></i> Download</button>
                                <button class="btn btn-danger btn-xs btn-delete"><i class="fa fa-trash"></i> Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>2323232</td>
                            <td>A1111</td>
                            <td>01-Jan-2016</td>
                            <td>Rusak nih coy</td>
                            <td>
                                <button class="btn btn-success btn-xs btn-edit"><i class="fa fa-download"></i> Download</button>
                                <button class="btn btn-danger btn-xs btn-delete"><i class="fa fa-trash"></i> Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div id="pilihan-aksi" style="display: none">
                    <button class="btn btn-success" id="btn-add"> <i class="fa fa-upload"></i> Upload</button>
                    <button class="btn btn-default" id="btn-print"> <i class="fa fa-close"></i> Cancel</button>
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->

<div class="modal fade" id="mdl-tambah" tabindex="-1" role="dialog" aria-labelledby="mdl-tambah" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h2 class="modal-title">Upload CAR</h2>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="cust-name" class="col-sm-3 control-label">CARID</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="cust-name" disabled="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cust-name" class="col-sm-3 control-label">NGID</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="cust-name" disabled="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cust-name" class="col-sm-3 control-label">Submit Date</label>
                        <div class="col-sm-9">
                            Senin, 01-jan-2016
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label">File</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label">Deskripsi</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <button type="submit" class="btn btn-default">Save</button>
                            <button type="reset" class="btn btn-default">Reset</button>
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
                <button class="btn btn-danger">Yes</button>
                <button class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        table = $("#tbl-customers").dataTable();

        $('#btn-add').on('click', function () {
            $('#mdl-tambah').modal('show');
        });

        $('.btn-edit').on('click', function () {
            $('#mdl-tambah').modal('show');
        });

        $('.btn-delete').on('click', function () {
            $('#mdl-hapus').modal('show');
        });

        $('#tbl-customers tbody').on('click', 'tr', function () {
//            IBU.pilihan = table.row(this).data();
            console.log("di klik");
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
                $('#pilihan-aksi').fadeOut('slow');
            } else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
                $('#pilihan-aksi').fadeIn('slow');
            }
        });
    });
</script>
