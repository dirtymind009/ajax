<?php

sleep(3);

$connection = new mysqli("localhost","root","","ajax");

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