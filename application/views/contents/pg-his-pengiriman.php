<!-- daterange picker -->
<link rel="stylesheet" href="<?= base_url('assets/plugins/daterangepicker/daterangepicker-bs3.css'); ?>" rel="stylesheet" type="text/css">
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">History CIPL & AWB Pengiriman</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="div-filter">                    
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="cust-name" class="col-sm-2 control-label">Request Date</label>
                            <div class="col-sm-4">
                                <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                                    <span></span> <b class="caret"></b>
                                </div>
                            </div>
                            <input type="hidden" name="startdate" id="start-date">
                            <input type="hidden" name="enddate" id="end-date">
                        </div>
                        <div class="form-group">
                            <label for="cust-name" class="col-sm-2 control-label">Customer Name</label>
                            <div class="col-sm-3">
                                <select class="form-control" name="customer">
                                    <option>-Pilih Customer-</option>
                                    <?php
                                    foreach ($list_customer as $customer) {
                                        $active = "";
                                        if ($customer['id'] == @$get_data['customer']) {
                                            $active = 'selected=""';
                                        }
                                        echo '<option value="' . $customer['id'] . '" ' . $active . '>' . $customer['name'] . '</option>';
                                    }
                                    ?>
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
                            <th>NGID</th>
                            <th>Submit Date</th>
                            <th>Upload Date</th>
                            <th>Deskripsi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($detail_data) > 0) {
                            foreach ($detail_data as $idx => $detail) {
                                $tgl = (is_null($detail['out_sub_date'])) ? '(kosong)' : format_tgl($detail['out_sub_date']);
                                $desc = (is_null($detail['out_description'])) ? '(kosong)' : $detail['out_description'];
                                echo '<tr data-idx="' . $idx . '">
                                        <td>' . $detail['ng_item_id'] . '</td>
                                        <td>' . format_tgl($detail['req_date']) . '</td>
                                        <td>' . $tgl . '</td>
                                        <td>' . $desc . '</td>
                                        <td>';
                                // kalo masih lom di upload tombol download jadi non
                                if ($detail['out_file_name'] !== null) {
                                    echo'<a href="' . base_url() . 'unduh/file/' . $detail['out_file_name'] . '" class="btn btn-success btn-xs btn-download"><i class="fa fa-download"></i> Download</a> ';
                                    echo '<button class="btn btn-danger btn-xs btn-delete"><i class="fa fa-trash"></i> Delete</button>';
                                } else {
                                    echo'<button class="btn btn-info btn-xs btn-download" disabled="disabled"><i class="fa fa-download"></i> Download</button> ';
                                    echo '<button class="btn btn-danger btn-xs btn-delete" disabled="disabled"><i class="fa fa-trash" ></i> Delete</button>';
                                }
                                echo'
                                        </td>
                                    </tr>';
                            }
                        }
                        ?>
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
                <h2 class="modal-title">Upload CIPL & AWB Pengiriman</h2>
            </div>
            <div class="modal-body form-horizontal">
                <?php echo form_open_multipart('history/simpanpengiriman'); ?>
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="cust-name" class="col-sm-3 control-label">NGID</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="mdl-ng-id" readonly="" name="mdl-ng-id">
                            <input type="hidden" name="mdl-cust-name" id="mdl-cust-name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cust-name" class="col-sm-3 control-label">Submit Date</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="mdl-sub-date" disabled="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label">File</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control" name="fileupload"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label">Deskripsi</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" rows="5" name="mdl-desc" id="mdl-desc"></textarea>
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
                <p>Are you sure to delete this file upload and rollback to <b>Progress 3</b>?</p>
            </div>
            <div class="modal-footer">
                <form action="<?= base_url('history/hapuspengiriman') ?>" method="post">
                    <input type="hidden" name="delete-ng" id="delete-ng">
                    <input type="hidden" name="delete-user" id="delete-user">
                    <input type="hidden" name="delete-file" id="delete-file">
                    <button class="btn btn-danger" type="submit">Yes</button>
                    <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- date-range-picker -->
<script src="<?= base_url('assets/plugins/daterangepicker/moment.min.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/daterangepicker/daterangepicker.js'); ?>"></script>
<script type="text/javascript">
<?php
if (count($detail_data) > 0) {
    echo 'window.NG_DETAIL=' . json_encode($detail_data) . ';';
}
?>
    $(function () {
        table = $("#tbl-customers").dataTable();

        $('#btn-add').on('click', function () {
            var datanya = NG_DETAIL[dataIdx];
            $('#mdl-ng-id').val(datanya.ng_item_id);
            $('#mdl-sub-date').val(moment().format('YYYY-MM-DD'));
            $('#mdl-desc').html(datanya.ng_result);
            $('#mdl-cust-name').val(datanya.cust_id);

            $('#mdl-tambah').modal('show');
        });

        $('.btn-edit').on('click', function () {
            $('#mdl-tambah').modal('show');
        });

        $('.btn-delete').on('click', function () {
            try {
                if (dataIdx) {
                    var datanya = NG_DETAIL[dataIdx];
                }
            } catch (e) {
                console.log("lom tau");
                var tr = $(this).parents('tr');
                dataIdx = $(tr).attr('data-idx');
                var datanya = NG_DETAIL[dataIdx];
            }

            $('#delete-ng').val(datanya.ng_item_id);
            $('#delete-user').val(datanya.cust_id);
            $('#delete-file').val(datanya.ng_file_name);

            $('#mdl-hapus').modal('show');
        });

        $('#tbl-customers tbody').on('click', 'tr', function () {
//            IBU.pilihan = table.row(this).data();
            window.dataIdx = $(this).attr('data-idx');

            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
                $('#pilihan-aksi').fadeOut('slow');
            } else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
                $('#pilihan-aksi').fadeIn('slow');
            }
        });


        function cb(start, end) {
            $('#start-date').val(start.format('YYYY-MM-DD'));
            $('#end-date').val(end.format('YYYY-MM-DD'));

            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
<?php
if (!is_null(@$get_data['startdate']) && !is_null(@$get_data['enddate'])) {
    echo 'cb(moment("' . $get_data['startdate'] . '"), moment("' . $get_data['enddate'] . '"));';
} else {
    ?>
            cb(moment().subtract(7, 'days'), moment());
    <?php
}
?>
        $('#reportrange').daterangepicker({
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);
    });
</script>
