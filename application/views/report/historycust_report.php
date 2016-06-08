<!DOCTYPE html>
<html>
    <head>
        <title>Report Table</title>
        <style type="text/css">
            body {
                font-family: Arial, Helvetica, sans-serif;
            }
            #footer1 {
                width: 90%;
            }

            .table-bordered {
                border: 3px solid #ddd;
                border-collapse: collapse;
            }

            .table-bordered td, th {
                border: 3px solid black;
                padding: 5px;
            }
            #ttd{
                text-align: right;
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
                    <h1>History NG Customer</h1>
                    <table class="table-bordered">
                        <thead>
                            <tr>
                                <th>Customer ID</th>
                                <th>Customer Name</th>
                                <th>NG ID</th>
                                <th>Request Date</th>
                                <th>Part No</th>
                                <th>Model</th>
                                <th>Quantity</th>
                                <th>Remark</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (count($detail_data) > 0) {
                            foreach ($detail_data as $idx => $detail) {
                                if ($detail['status'] == 0) {
                                    $el = 'Request';
                                } elseif ($detail['status'] == 1) {
                                    $el = 'Progress 1';
                                } elseif ($detail['status'] == 2) {
                                    $el = 'Progress 2';
                                } elseif ($detail['status'] == 3) {
                                    $el = 'Progress 3';
                                } elseif ($detail['status'] == 4) {
                                    $el = 'Closed';
                                }else{
                                    $el = "-";
                                }
                                
                                echo '
                                    <tr>
                                        <td>'.$detail['cust_id'].'</td>
                                        <td>'.$detail['cust_name'].'</td>
                                        <td>'.$detail['ng_item_id'].'</td>
                                        <td>'.$detail['req_date'].'</td>
                                        <td>'.$detail['part_no'].'</td>
                                        <td>'.$detail['model'].'</td>
                                        <td>'.$detail['quantity'].'</td>
                                        <td>'.$detail['remark'].'</td>
                                        <td>'.$el.'</td>
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
                    <p>Sign by &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                    <br/>
                    <img src="assets/img/signature.png" width="150"/>
                    <br/>
                    <p>Department Head OQA</p>
                </td>
            </tr>
        </table>
    </body>
</html>