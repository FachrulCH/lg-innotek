<!-- daterange picker -->
<link rel="stylesheet" href="<?= base_url('assets/plugins/daterangepicker/daterangepicker-bs3.css'); ?>" rel="stylesheet" type="text/css">
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Report NG Customer by Periodic</h3>
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
                        <br/>
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
                            <th>NG ID</th>
                            <th>Customer Name</th>
                            <th>Request Date</th>
                            <th>Part No</th>
                            <th>Model</th>
                            <th>Quantity</th>
                            <th>Remark</th>
                            <th>Status</th>
                            <th>Employee ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $param = $this->session->param;
                        $status = $param['status'];
                        if (count($detail_data) > 0) {
                            foreach ($detail_data as $idx => $detail) {
                                echo '<tr data-idx="' . $idx . '">
                                        <td>' . $detail['ng_item_id'] . '</td>
                                        <td>' . $detail['cust_name'] . '</td>
                                        <td>' . format_tgl($detail['req_date']) . '</td>
                                        <td>' . $detail['part_no'] . '</td>
                                        <td>' . $detail['model'] . '</td>
                                        <td>' . $detail['quantity'] . '</td>
                                        <td>' . $detail['remark'] . '</td>
                                        <td>' . $status[$detail['status']] . '</td>
                                        <td>' . $detail['employee_id'] . '</td>
                                    </tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>
                <?php
                $get = $this->input->get();
                if (count($detail_data) > 0) {
                    echo '<a href="' . base_url('report/filterbyperiodic?startdate=' . $get['startdate'] . '&enddate=' . $get['enddate'] . '') . '" target="_blank" class="btn btn-success" id="btn-print"> <i class="fa fa-print"></i> Print</a>';
                } else {
                    echo '<a href="#" target="_blank" class="btn btn-success" id="btn-print" disabled> <i class="fa fa-print"></i> Print</a>';
                }
                ?>

            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->

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
        table = $("#tbl-customers").dataTable({"filter": false});

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
