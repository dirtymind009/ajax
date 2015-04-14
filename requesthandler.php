<?php
/**
 * Created by PhpStorm.
 * User: A.S.MMehediHasan
 * Date: 4/8/2015
 * Time: 02:18 AM
 */

$name = $_POST['names'];
$email = $_POST['emails'];
$company = $_POST['companys'];

$connection = new mysqli("localhost","root","","ajax");

if($connection->connect_error)
{
    echo "Failed To retrieve";
    exit();
}
//$idnum = (int) $_GET['id'];
$sql = "INSERT INTO `ajax`.`company_details` (`id`, `name`, `company`, `email`) VALUES (NULL, '".$name."', '".$company."', '".$email."');";
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
else
{
    echo "Some thing wrong occured";
}




$connection->close();