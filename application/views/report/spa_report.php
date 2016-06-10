<!DOCTYPE html>
<html>
    <head>
        <title>Report Table</title>
        <style type="text/css">
            body {
                font-family: Arial, Helvetica, sans-serif;
            }
            #footer1 {
                width: 70%;
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
                text-align: center;
            }
            /*.table-bordered tbody tr:nth-child(even) {background-color: #f2f2f2}*/

            h1{
                text-decoration: underline;
            }
            #main{
                width: 550px;
            }

            #spa{
                border: 3px solid black;
                padding: 7px;
                width: 500px;
            }
            #spa td{
                padding: 5px;
            }

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
                    <h1>Surat Perintah Analisa</h1>
                    <table id="spa">
                        <tr>
                            <td style="width: 60%">Request Date</td>
                            <td><?= format_tgl($detail['req_date']) ?></td>
                        </tr>
                        <tr>
                            <td>NG Id</td>
                            <td><?= $detail['ng_item_id'] ?></td>
                        </tr>
                        <tr>
                            <td>Customer Id</td>
                            <td><?= $detail['cust_id'] ?></td>
                        </tr>
                        <tr>
                            <td>Customer Name</td>
                            <td><?= $detail['cust_name'] ?></td>
                        </tr>
                        <tr>
                            <td>Part No</td>
                            <td><?= $detail['part_no'] ?></td>
                        </tr>
                        <tr>
                            <td>Model</td>
                            <td><?= $detail['model'] ?></td>
                        </tr>
                        <tr>
                            <td>Quantity</td>
                            <td><?= $detail['quantity'] ?></td>
                        </tr>
                        <tr>
                            <td>Id Staff</td>
                            <td><?= $detail['sp_employee_id'] ?></td>
                        </tr>
                        <tr>
                            <td>Nama Staff</td>
                            <td><?= $detail['empl_name'] ?></td>
                        </tr>
                        <tr>
                            <td>Id Inspector</td>
                            <td><?= $detail['sp_inspector_id'] ?></td>
                        </tr>
                        <tr>
                            <td>Nama Inspector</td>
                            <td><?= $detail['inspector_name'] ?></td>
                        </tr>

                    </table>
                </td>
            </tr>
            <tr id="footer">
                <td id="footer1"></td>
                <td id="ttd">
                    <p><u>Requester</u></p>
                    <br/>
                    <br/>
                    <br/>
                    <p><?= $this->session->username ?></p>
                </td>
            </tr>
        </table>
    </body>
</html>