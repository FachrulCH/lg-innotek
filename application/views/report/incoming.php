<!DOCTYPE html>
<html>
    <head>
        <title>Report Table</title>
        <style type="text/css">
            body {
                font-family: Arial, Helvetica, sans-serif;
            }
            #footer1 {
                width: 70%
            }

            .table-bordered {
                border: 3px solid #ddd;
                border-collapse: collapse;
            }

            .table-bordered td, th {
                border: 3px solid black;
                padding: 5px;
            }
            /*.table-bordered tbody tr:nth-child(even) {background-color: #f2f2f2}*/


        </style>
    </head>
    <body>

        <table id="main">
            <tr id="header">
                <td><img src="assets/img/logo-innotek.png"/> Inside your life!</td>
                <td></td>
            </tr>
            <tr id="content">
                <td colspan="2">
                    <hr/>
                    <h1>Data Kedatangan NG Customer Divisi Incoming</h1>
                    <table class="table-bordered">
                        <thead>
                            <tr>
                                <th>Kedatangan ID</th>
                                <th>Tanggal Kedatangan</th>
                                <th>Customer Id</th>
                                <th>Customer Name</th>
                                <th>Part No</th>
                                <th>Model</th>
                                <th>No CIPL Customer</th>
                                <th>No AWB Customer</th>
                                <th>Employee ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (count($detail_data) > 0) {
                            foreach ($detail_data as $idx => $detail) {
                                echo '
                                    <tr>
                                        <td>'.$detail['id'].'</td>
                                        <td>'.$detail['date'].'</td>
                                        <td>'.$detail['cust_id'].'</td>
                                        <td>'.$detail['cust_name'].'</td>
                                        <td>'.$detail['part_no'].'</td>
                                        <td>'.$detail['model'].'</td>
                                        <td>'.$detail['no_cipl'].'</td>
                                        <td>'.$detail['no_awb'].'</td>
                                        <td>'.$detail['empl_id'].'</td>
                                    </tr>
                                ';
                            }
                        }
                            ?>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr id="footer">
                <td id="footer1"></td>
                <td id="ttd">
                    <p>Staff incoming</p>
                    <br/>
                    <br/>
                    <br/>
                    <p>(<?= $this->session->username ?>)</p>
                </td>
            </tr>
        </table>
    </body>
</html>