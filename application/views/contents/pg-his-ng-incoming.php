<?php
//print_r($get_data);
//echo '<hr/>count='.count($detail_data);
//echo "<br/><pre>";
//print_r($detail_data);
//echo "</pre>";
?>
<!-- daterange picker -->
<link rel="stylesheet" href="<?= base_url('assets/plugins/daterangepicker/daterangepicker-bs3.css'); ?>" rel="stylesheet" type="text/css">
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Kedatangan NG Customer</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="div-filter">                    
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="cust-name" class="col-sm-2 control-label">Tanggal Kedatangan</label>
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
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default"> <i class="fa fa-search"></i> Search</button>
                            </div>
                        </div>
                    </form>
                </div>




                <table id="tbl-incoming" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Incoming ID</th>
                            <th>Incoming Date</th>
                            <th>Customer Name</th>
                            <th>Part No</th>
                            <th>Model</th>
                            <th>No CIPL Customer</th>
                            <th>No AWB Customer</th>
                            <th>Employee ID</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($detail_data) > 0) {
                            foreach ($detail_data as $idx => $detail) {
                                echo '
                                    <tr data-idx="' . $idx . '">
                                        <td>' . $detail['id'] . '</td>
                                        <td>' . $detail['date'] . '</td>
                                        <td>' . $detail['cust_name'] . '</td>
                                        <td>' . $detail['part_no'] . '</td>
                                        <td>' . $detail['model'] . '</td>
                                        <td>' . $detail['no_cipl'] . '</td>
                                        <td>' . $detail['no_awb'] . '</td>
                                        <td>' . $detail['empl_id'] . '</td>
                                        <td><a class="btn btn-success btn-xs btn-edit"><i class="fa fa-edit"></i> Edit</a> | <a  class="btn btn-danger btn-xs btn-delete"><i class="fa fa-trash-o"></i> Delete</a></td>
                                    </tr>
                                ';
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <br/>
                <div id="pilihan-aksi">
                    <button class="btn btn-success" id="btn-add"> <i class="fa fa-plus"></i> Add</button>
                    <?php
                    if (count($detail_data) > 0) {
                        $get = $this->input->get();
                        ?>
                        <a href="<?= base_url('report/incoming?startdate=' . $get['startdate'] . '&enddate=' . $get['enddate'] . ''); ?>" target="_blank" class="btn btn-default" id="btn-print"> <i class="fa fa-print"></i> Print</a>
                        <?php
                    }
                    ?>
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
                <h2 class="modal-title">Add new incoming NG Customer</h2>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="<?= base_url('history/simpanngincoming') ?>" method="post">
                    <div class="form-group">
                        <label for="cust-name" class="col-sm-3 control-label">Incoming ID</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="mdl-ng-id" readonly="" name="mdl-ng-id" placeholder="Will be generated by sistem">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cust-name" class="col-sm-3 control-label">Incoming Date</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="mdl-sub-date" disabled="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label">Customer Name</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="customer" id="mdl-cust">
                                <option>-Pilih Customer-</option>
                                <?php
                                foreach ($list_customer as $customer) {
                                    $active = "";
                                    if ($customer['id'] == @$get_data['customer']) {
                                        $active = 'selected=""';
                                    }
                                    echo '<option value="' . $customer['id'] . '" ' . $active . '>' . $customer['id'] . ' - ' . $customer['name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label">Part No</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="part_no" id="ng-part">
                                <option value="0">-Pilih Part no-</option>
                                <?php
                                foreach ($product_list as $product) {
                                    echo '<option value="' . $product['part_no'] . '">' . $product['part_no'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label">Model</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="ng-model" placeholder="Model" disabled="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label">No CIPL Customer</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="mdl-cipl" name="mdl-cipl">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label">No AWB Customer</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="mdl-awb" name="mdl-awb">
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
                Are you sure to delete this data?
            </div>
            <div class="modal-footer">
                <form action="<?= base_url('history/hapusngincoming') ?>" method="post">
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
if (count(@$detail_data) > 0) {
    echo 'window.NG_DETAIL=' . json_encode($detail_data) . ';';
} else {
    echo "$('#tbl-incoming').hide();";
}
?>
    window.produk = {<?php
foreach ($product_list as $product) {
    echo '"' . $product['part_no'] . '":"' . $product['model'] . '",';
}
?>};

    newForm = function (tipe) {
        $('#mdl-sub-date').val(moment().format('YYYY-MM-DD'));

        if (tipe === 'baru') {
            $('#mdl-tambah').modal('show');
        } else {
            var datanya = NG_DETAIL[dataIdx];

            console.log("edit");
            $('#mdl-ng-id').val(datanya.id);
            $('#mdl-cust').val(datanya.cust_id);
            $('#mdl-sub-date').val(moment().format('YYYY-MM-DD'));
            $('#ng-part').val(datanya.part_no);
            $('#ng-model').val(datanya.model);
            $('#mdl-cipl').val(datanya.no_cipl);
            $('#mdl-awb').val(datanya.no_awb);

            $('#mdl-tambah').modal('show');
        }
    };
    $(function () {
        table = $("#tbl-customers").dataTable({"filter": false});

        $('#btn-add').on('click', function () {
            newForm('baru');
        });

        $('.btn-edit').on('click', function () {

            var tr = $(this).parents('tr');
            window.dataIdx = $(tr).attr('data-idx');

            newForm('edit');
        });

        $('#ng-part').on('change', function () {
            idx = $('#ng-part').val();
            $('#ng-model').val(produk[idx]);
        });

        $('.btn-delete').on('click', function () {

            var tr = $(this).parents('tr');
            dataIdx = $(tr).attr('data-idx');
            var datanya = NG_DETAIL[dataIdx];

            $('#delete-ng').val(datanya.id);
            $('#delete-user').val(datanya.cust_id);
            $('#delete-file').val();

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
