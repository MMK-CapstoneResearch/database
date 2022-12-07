<?php
    require 'connect.php';
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $delete_qry = "DELETE FROM tbl_products WHERE product_id = '$id'";
        $qry = mysqli_query($conn, $delete_qry);
        
        header('location: ITEC116_Lab1_Marion_Montana_Bustillo.php');
    }
?>

