<?php

require_once 'config/db.php';
require_once 'config/functions.php';


// get the data from the backend
$result = dispaly_data();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Invoices Table</title>
</head>


// display the data as table

<body class="bg-dark">
    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <div class="card mt-5">
                    <div class="card-header">
                        <h2 class="display-6 text-center">Invoices Table</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered text-center">
                            <tr class="bg-dark text-white">
                                <td> ID </td>
                                <td> INVOICE </td>
                                <td> Price </td>
                                <td> QUANTITY </td>
                                <td> TOTAL </td>
                            </tr>
                            <tr>
                                <?php
                                foreach ($result as $res) {
                                ?>
                                <td><?php echo $res->id; ?></td>
                                <td><?php echo $res->invoice; ?></td>
                                <td><?php echo $res->price; ?></td>
                                <td><?php echo $res->quantity; ?></td>
                                <td><?php echo $res->total; ?></td>

                            </tr>
                            <?php
                                }
                        ?>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>