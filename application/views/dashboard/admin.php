<!-- Main row -->
<!-- Info boxes -->
<link href="<?= base_url('assets/plugins/morris/morris.css'); ?>" rel="stylesheet" type="text/css" />
<div class="row">
    <?php
//    echo "<pre>";
//    print_r($data_a);
    $param = $this->session->param;
    $param_status = $param['status'];
    $status = array(
        "0" => array(
            "warna" => "bg-yellow",
            "icon" => "fa-bug",
            "label" => "label-warning"
        ),
        "1" => array(
            "warna" => "bg-red",
            "icon" => "fa-stethoscope",
            "label" => "label-danger"
        ),
        "2" => array(
            "warna" => "bg-blue",
            "icon" => "fa-file-o",
            "label" => "label-info"
        ),
        "3" => array(
            "warna" => "bg-aqua",
            "icon" => "fa-cog",
            "label" => "label-primary"
        ),
        "4" => array(
            "warna" => "bg-green",
            "icon" => "fa-smile-o",
            "label" => "label-success"
        ),
    );
    foreach ($data_a as $status_count) {
        ?>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon <?= $status[$status_count['status']]['warna'] ?>"><i class="fa <?= $status[$status_count['status']]['icon'] ?>"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text"><?= $param_status[$status_count['status']] ?></span>
                    <span class="info-box-number"><?= $status_count['jum'] ?> <small>data</small></span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->
        <?php
    }
    ?>

</div><!-- /.row -->

<div class="row">
    <div class="col-md-8">

        <!-- LINE CHART -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Jumlah NG data tahun ini</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body chart-responsive">
                <div class="chart" id="line-chart" style="height: 300px;"></div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->

    </div><!-- /.col -->
    <div class="col-md-4">
        <!-- PRODUCT LIST -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Recently Added NG Data</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                <ul class="products-list product-list-in-box">
                    <?php
                    foreach ($data_b as $data_b) {
                        ?>
                        <li class="item">
                            <div class="product-img">
                                <img src="<?= base_url(); ?>assets/dist/img/default-50x50.gif" alt="Product Image"/>
                            </div>
                            <div class="product-info">
                                <a href="javascript::;" class="product-title"><?= $data_b['cust_id'] ?> <span class="label <?= $status[$data_b['status']]['label'] ?> pull-right"><?= $param_status[$data_b['status']] ?></span></a>
                                <span class="product-description">
                                    <?= $data_b['part_no'] . "-" . $data_b['remark'] ?>
                                </span>
                            </div>
                        </li><!-- /.item -->
                        <?php
                    }
                    ?>
                </ul>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->

<script src="<?= base_url('assets/js/raphael-min.js'); ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/plugins/morris/morris.min.js'); ?>" type="text/javascript"></script>
<script>
// LINE CHART
    var line = new Morris.Line({
        element: 'line-chart',
        resize: true,
        data: [
//                      {y: '2016-01', item1: 6},
//            {y: '2016-02', item1: 7},
//            {y: '2016-03', item1: 8},
//            {y: '2016-04', item1: 5},
//            {y: '2016-05', item1: 4},
//            {y: '2016-06', item1: 7}
<?php
foreach ($data_c as $k => $periode) {
    if ($k == 0) {
        echo "{y: '" . $periode['periode'] . "', item1: " . $periode['jum'] . "}";
    } else {
        echo "
        ,{y: '" . $periode['periode'] . "', item1: " . $periode['jum'] . "}
         ";
    }
}
?>
        ],
        xkey: 'y',
        ykeys: ['item1'],
        labels: ['Jumlah'],
        xLabels: "month",
        lineColors: ['#3c8dbc'],
        hideHover: 'auto'
    });
</script>