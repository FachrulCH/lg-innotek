<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Result Analisa</h3>
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
                            <th>ResultID</th>
                            <th>NGID</th>
                            <th>Submit Date</th>
                            <th>Customer Name</th>
                            <th>Part no</th>
                            <th>Model</th>
                            <th>Qty</th>
                            <th>Result Analisa</th>
                            <th>File Analisa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>2323232</td>
                            <td>A1111</td>
                            <td>01-Jan-2016</td>
                            <td>Unyil Usro</td>
                            <td>Mnt121212</td>
                            <td>12</td>
                            <td>3</td>
                            <td>OK</td>
                            <td>
                                <button class="btn btn-success btn-xs btn-edit"><i class="fa fa-download"></i> Download</button>
                            </td>
                        </tr>
                        <tr>
                            <td>2323232</td>
                            <td>A1111</td>
                            <td>01-Jan-2016</td>
                            <td>Unyil Usro</td>
                            <td>Mnt121212</td>
                            <td>12</td>
                            <td>3</td>
                            <td>OK</td>
                            <td>
                                <button class="btn btn-success btn-xs btn-edit"><i class="fa fa-download"></i> Download</button>
                            </td>
                        </tr>
                        <tr>
                            <td>2323232</td>
                            <td>A1111</td>
                            <td>01-Jan-2016</td>
                            <td>Unyil Usro</td>
                            <td>Mnt121212</td>
                            <td>12</td>
                            <td>3</td>
                            <td>OK</td>
                            <td>
                                <button class="btn btn-success btn-xs btn-edit"><i class="fa fa-download"></i> Download</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
<script type="text/javascript">
    $(function () {
        table = $("#tbl-customers").dataTable();

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
