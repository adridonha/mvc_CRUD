<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "
    http://www.w3.org/TR/html4/loose.dtd">
<!-- Server Side WEB Development -->
<!-- Unit 2: Working with databases in PHP -->
<!-- Exercise: PDO CRUD -->

<html>
    <head></head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Exercise Unit 2. PDO CRUD for stock table</title>
        <link href="dwes.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <style>
            tr,td,th{
                border: 1px solid black;
            }
        </style>
        <div id="header">
            
            <?php
            require_once('../model/stock.php');
            $stock = new Stock();
            
            require_once '../controller/controlerDefault.php';
            // Llamar al método para mostrar la vista
            ControlerDefault::mostrarBotonesHeader();
            ?>
            <table >
                <form action='<?php echo $_SERVER['PHP_SELF']; ?>' method='post'>
                    <tr>
                        <td>
                            <select name="product">
                                <?php foreach ($stock->getProducts() as $key => $value) { ?>
                                    <option value='<?php echo $key; ?>'><?php echo $key; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td>
                            <select name="store">
                                <?php foreach ($stock->getStores() as $key => $value) { ?>
                                    <option value='<?php echo $key; ?>'><?php echo $key; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td><input type='text' name='units' /></td>
                        <td><input type='submit' name='insert' value='Insert' rowspan="2"/></td>
                    </tr>
                </form>

                <?php foreach ($stock->getStock() as $row) { ?>
                    <form action='<?php echo $_SERVER['PHP_SELF']; ?>' method='post'>
                        <tr>
                            <td><input type='text' name='product' value='<?php echo $row['product']; ?>' readonly /></td>
                            <td><input type='text' name='store' value='<?php echo $row['store']; ?>' readonly /></td>
                            <td><input type='text' name='units' value='<?php echo $row['units']; ?>' /></td>
                            <td><input type='submit' name='update' value='Update' /></td>
                            <td><input type='submit' name='delete' value='Delete' /></td>
                        </tr>
                    </form>
                <?php } ?>
            </table>
        </div>
        <div id="content"></div>
        <div id="footer">
            <?php unset($dwes); ?>
        </div>
    </body>
</html>

