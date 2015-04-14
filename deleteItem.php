<?php
/**
 * Created by PhpStorm.
 * User: A.S.MMehediHasan
 * Date: 4/15/2015
 * Time: 12:16 AM
 */



$connection = new mysqli("localhost","root","","ajax");
$id = $_GET['id'];
$sql = "DELETE FROM `company_details` WHERE id=".$id;

if($connection->query($sql))
{
    $sql = "SELECT * FROM `company_details`";

    $res = $connection->query($sql);

    $response = "";
    if($res->num_rows >0)
    {
        //$response = "<table border='1' collapse='none'><tr><th>Name</th><th>Email</th><th>phone</th></tr>";
        $response  = "";
        while($rows = $res->fetch_assoc())
        {
            $response .="<tr><td>".$rows['name']."</td>";
            $response .="<td>".$rows['company']."</td>";
            $response .="<td>".$rows['email']."</td>";
            $varid = $rows['id'];
            $response .="<td><a class=\"btn btn-success\" id=\"del".$varid."\" onclick=\"deleteItem($varid)\">Remove</a></td></tr>";
        }
    }

    $response.="";
    echo $response;
}

