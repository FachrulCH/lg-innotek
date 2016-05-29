<!-- daterange picker -->
<link rel="stylesheet" href="<?= base_url('assets/plugins/daterangepicker/daterangepicker-bs3.css'); ?>" rel="stylesheet" type="text/css">
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">History NG Customer</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="div-filter">                    
                    <form class="form-horizontal" action="#" id="form-filter">
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
                            <label for="cust-name" class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-2">
                                <select class="form-control" name="status">
                                    <option value="*">-Semua status-</option>
                                    <?php
                                    $param = $this->session->param['status'];
                                    foreach ($param as $key => $value) {
                                        echo '<option value="' . $key . '">' . $value . '</option>';
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cust-name" class="col-sm-2 control-label">Model</label>
                            <div class="col-sm-2">
                                <select class="form-control" name="model">
                                    <option value="*">-Semua model-</option>
                                    <?php
                                    foreach ($product_list as $product) {
                                        echo '<option value="' . $product['model'] . '">' . $product['model'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default"> <i class="fa fa-search"></i> Cari</button>
                            </div>
                        </div>
                    </form>
                </div>

                <hr/>

                <div id="div_tabel" style="display: none">

                    <table id="tbl-customers" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>NG ID</th>
                                <th>Customer Name</th>
                                <th>Request Date</th>
                                <th>Part no</th>
                                <th>Model</th>
                                <th>Qty</th>
                                <th>Remark</th>
                                <th>Detail NG Data</th>
                                <th>CA Customer</th>
                                <th>CAR</th>
                                <th>CA Pengirim</th>
                                <th>Employee ID</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
<!--                            <tr>
                                <td>A1111</td>
                                <td>Unyil</td>
                                <td>01-Jan-2016</td>
                                <td>121212</td>
                                <td>Monitor</td>
                                <td>2</td>
                                <td>-</td>
                                <td><a href="#">View data detail</a></td>
                                <td><a href="#">View CIPL & AWB Customer</a></td>
                                <td><a href="#">View CAR</a></td>
                                <td><a href="#">View CIPL & AWB Pengiriman</a></td>
                                <td>00119900</td>
                                <td>In Progress</td>
                            </tr>
                            <tr>
                                <td>A1111</td>
                                <td>Usro</td>
                                <td>01-Jan-2016</td>
                                <td>121212</td>
                                <td>Monitor</td>
                                <td>2</td>
                                <td>-</td>
                                <td><a href="#">View data detail</a></td>
                                <td><a href="#">View CIPL & AWB Customer</a></td>
                                <td><a href="#">View CAR</a></td>
                                <td><a href="#">View CIPL & AWB Pengiriman</a></td>
                                <td>00119900</td>
                                <td>In Progress</td>
                            </tr>
                            <tr>
                                <td>A1111</td>
                                <td>Raden</td>
                                <td>01-Jan-2016</td>
                                <td>121212</td>
                                <td>Monitor</td>
                                <td>2</td>
                                <td>-</td>
                                <td><a href="#">View data detail</a></td>
                                <td><a href="#">View CIPL & AWB Customer</a></td>
                                <td><a href="#">View CAR</a></td>
                                <td><a href="#">View CIPL & AWB Pengiriman</a></td>
                                <td>00119900</td>
                                <td>In Progress</td>
                            </tr>-->

                        </tbody>
                    </table>
                </div>
                <button class="btn btn-success" id="btn-add"> <i class="fa fa-plus"></i> Request Service</button>
                <button class="btn btn-default" id="btn-print"> <i class="fa fa-print"></i> Print</button>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->

<div class="modal fade" id="mdl-tambah" tabindex="-1" role="dialog" aria-labelledby="mdl-tambah" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h2 class="modal-title">Request Service</h2>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="form-request" action="<?= base_url('customer/service_simpan') ?>" method="POST">
                    <div class="form-group">
                        <label for="cust-name" class="col-sm-3 control-label">NGID</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="ng-id" readonly="" placeholder="Generated by system" name="id">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cust-name" class="col-sm-3 control-label">Customer ID</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="cust-id" readonly="" value="<?= $this->session->user_id ?>" name="cust-id">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cust-name" class="col-sm-3 control-label">Customer Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="cust-name" readonly="" value="<?= $this->session->username ?>" name="cust-name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cust-name" class="col-sm-3 control-label">Request Date</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="ng-date" readonly="" name="cust-date">
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
                        <label for="inputPassword3" class="col-sm-3 control-label">Quantity</label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control" id="cust-name" min="1" max="1000" name="quantity">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label">AWB</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="cust-name" name="awb">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label">Remark</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" rows="5" id="ng-remark" name="remark"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <button type="button" class="btn btn-default" id="btn-add-save">Save</button>
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
<script src='<?= base_url('assets/js/common.js'); ?>'></script>
<script type="text/javascript">
    $(function () {
        $('#ng-date').val(moment().format('MMMM D, YYYY'));
//        $("#tbl-customers").DataTable();

        window.produk = {<?php
                                foreach ($product_list as $product) {
                                    echo '"' . $product['part_no'] . '":"' . $product['model'] . '",';
                                }
                                ?>};

        $('#ng-part').on('change', function () {
            idx = $('#ng-part').val();
            $('#ng-model').val(produk[idx]);
        });

        $('#btn-add').on('click', function () {
            $('#mdl-tambah').modal('show');
        });

        $('.btn-edit').on('click', function () {
            $('#mdl-tambah').modal('show');
        });

        $('.btn-delete').on('click', function () {
            $('#mdl-hapus').modal('show');
        });

        function cb(start, end) {
            $('#start-date').val(start.format('YYYY-MM-DD'));
            $('#end-date').val(end.format('YYYY-MM-DD'));

            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        cb(moment().subtract(7, 'days'), moment());

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

        $('#form-filter').on('submit', function (e) {
            e.preventDefault();
            var data = $('#form-filter').serialize();

            loading_on();
            WS.data = data;
            WS.post('nghistory', function () {

                setTimeout(function () {
                    loading_off();
                    //$('#tbl-customers').DataTable().clear().rows.add(newest).draw();

                    TABEL.name = "#tbl-customers";
                    TABEL.data = WS.result.response_data.ng_data;
                    TABEL.kolom = [
                        {data: 'id'},
                        {data: 'cust_id'},
                        {data: 'req_date'},
                        {data: 'part_no'},
                        {
                            data: 'part_no', render: function (part_no) {
                                return produk[part_no];
                            }
                        },
                        {data: 'quantity'},
                        {data: 'remark'},
                        {
                            data: 'id', render: function (id) {
                                return '<a href="#">Detail</a>';
                            }
                        },
                        {
                            data: 'id', render: function (id) {
                                return '<a href="#">Detail</a>';
                            }
                        },
                        {
                            data: 'id', render: function (id) {
                                return '<a href="#">Detail</a>';
                            }
                        },
                        {
                            data: 'id', render: function (id) {
                                return '<a href="#">Detail</a>';
                            }
                        },
                        {data: 'empl_id'},
                        {
                            data: 'status', render: function (status) {
                                if (status == 0) {
                                    var el = '<button class="btn btn-warning btn-xs btn-edit"><i class="fa fa-edit"></i> Request</button>';
                                }
                                else if (status == 1) {
                                    var el = '<button class="btn btn-warning btn-xs btn-edit"><i class="fa fa-edit"></i> Progress 1</button>';
                                }
                                else if (status == 2) {
                                    var el = '<button class="btn btn-warning btn-xs btn-edit"><i class="fa fa-edit"></i> Progress 2</button>';
                                }
                                else if (status == 3) {
                                    var el = '<button class="btn btn-warning btn-xs btn-edit"><i class="fa fa-edit"></i> Progress 3</button>';
                                }
                                else if (status == 4) {
                                    var el = '<button class="btn btn-warning btn-xs btn-edit"><i class="fa fa-edit"></i> Closed</button>';
                                }
                                return el;
                            }
                        }
                    ];
                    TABEL.inisiasi();


                    $('#div_tabel').show('slow');
                }, 1000);
            });


        });

        $('#btn-add-save').on('click', function (e) {
            e.preventDefault();
            $('#mdl-tambah').modal('hide');

            setTimeout(function () {

                $('#form-request')[0].submit();
            }, 1000);
        });


    });
</script>
