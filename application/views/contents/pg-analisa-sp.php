<!-- daterange picker -->
<link rel="stylesheet" href="<?= base_url('assets/plugins/daterangepicker/daterangepicker-bs3.css'); ?>" rel="stylesheet" type="text/css">
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Surat Perintah Analisa</h3>
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
                            <th>Request Date</th>
                            <th>Assign Date</th>
                            <th>Customer Name</th>
                            <th>Part no</th>
                            <th>Model</th>
                            <th>Qty</th>
                            <th>Staff</th>
                            <th>Inspector</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($detail_data) > 0) {
                            foreach ($detail_data as $idx => $detail) {
                                $tgl = (is_null($detail['sp_sub_date'])) ? '(kosong)' : format_tgl($detail['sp_sub_date']);
                                $empl = (is_null($detail['sp_employee_id'])) ? '(kosong)' : $detail['sp_employee_id'];
                                $inspector = (is_null($detail['sp_inspector_id'])) ? '(kosong)' : $detail['sp_inspector_id'];
                                echo '<tr data-idx="' . $idx . '">
                                        <td>' . $detail['ng_item_id'] . '</td>
                                        <td>' . format_tgl($detail['req_date']) . '</td>
                                        <td>' . $tgl . '</td>
                                        <td>' . $detail['cust_name'] . '</td>
                                        <td>' . $detail['part_no'] . '</td>
                                        <td>' . $detail['model'] . '</td>
                                        <td>' . $detail['quantity'] . '</td>
                                        <td>' . $empl . '</td>
                                        <td>' . $inspector . '</td>
                                        <td>';
                                // kalo masih lom di upload tombol download jadi non
                                if ($detail['sp_inspector_id'] !== null) {
                                    echo'<a href="' . base_url() . 'report/spa/?spa=' . $detail['ng_item_id'] . '" class="btn btn-info btn-xs btn-print" target="_blank"><i class="fa fa-print"></i> Print</a> ';
                                    echo '<button class="btn btn-danger btn-xs btn-delete"><i class="fa fa-trash"></i> Delete</button>';
                                } else {
                                    echo'<a href="#" class="btn btn-info btn-xs btn-print" disabled="disabled"><i class="fa fa-print"></i> Print</a> ';
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
                    <button class="btn btn-success" id="btn-add"> <i class="fa fa-clipboard"></i> Request</button>
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
                <h2 class="modal-title">Request Surat Perintah Analisa</h2>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" action="<?= base_url('analisa/simpansp') ?>">
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
                        <label for="mdl-customer-name" class="col-sm-3 control-label">Customer Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="mdl-customer-name" disabled="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mdl-sub-cust-name" class="col-sm-3 control-label">Part No</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="mdl-part-no" disabled="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mdl-sub-cust-name" class="col-sm-3 control-label">Model</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="mdl-model-no" disabled="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mdl-sub-cust-name" class="col-sm-3 control-label">Quantity</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="mdl-qty" disabled="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cust-name" class="col-sm-3 control-label">Nama Staff</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="mdl_staff_id">
                                <option>-Pilih Staff-</option>
                                <?php
                                    foreach ($list_staff as $staff) {
                                        echo '<option value="' . $staff['id'] . '">' . $staff['id'] . '-' .$staff['name'] . '</option>';
                                    }
                                    ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cust-name" class="col-sm-3 control-label">Nama Inspector</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="mdl_ins_id">
                                <option>-Pilih Inspector-</option>
                                <?php
                                    foreach ($list_inspector as $inspector) {
                                        echo '<option value="' . $inspector['id'] . '">' . $inspector['id'] . '-' .$inspector['name'] . '</option>';
                                    }
                                    ?>
                            </select>
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
<!-- date-range-picker -->
<script src="<?= base_url('assets/plugins/daterangepicker/moment.min.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/daterangepicker/daterangepicker.js'); ?>"></script>
<script type="text/javascript">
<?php
//if (count($detail_data) > 0) {
    echo 'window.NG_DETAIL=' . json_encode($detail_data) . ';';
//}
?>

    $(function () {
        table = $("#tbl-customers").dataTable();

        $('#btn-add').on('click', function () {
            var datanya = NG_DETAIL[dataIdx];
            $('#mdl-ng-id').val(datanya.ng_item_id);
            $('#mdl-sub-date').val(moment().format('YYYY-MM-DD'));
            $('#mdl-desc').html(datanya.ng_result);
            $('#mdl-cust-name').val(datanya.cust_id);
            $('#mdl-part-no').val(datanya.part_no);
            $('#mdl-model-no').val(datanya.model);
            $('#mdl-qty').val(datanya.quantity);
            $('#mdl-customer-name').val(datanya.cust_id +"-"+datanya.cust_name);

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
