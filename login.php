<?php

$uname1 = $_POST['uname1'];
$upswd1 = $_POST['upswd1'];

if (!empty($uname1) || !empty($upswd1))

{
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "arulkumar";


$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
    die('Connect Error ('.
      mysqli_connect_errno() .') '
       . mysqli_connect_error());
}

else{
    $SELECT = "SELECT uname1 From
      login Where uname1 = ? Limit 1"
      ;

    $INSERT = "INSERT Into login (
        uname1 , upswd1 )
        values(?,?)";



    $stmt = $conn->prepare($SELECT);
    $stmt->bind_param("s", $uname1);
    $stmt->execute();
    $stmt->bind_result($uname1);
    $stmt->store_result();
    $rnum = $stmt->num_rows;


    if ($rnum==0) {
        $stmt->close();
        $stmt = $conn->prepare($INSERT);
        $stmt->bind_param("ss", $uname1,$upswd1);
        $stmt->execute();
        echo "New record inserted sucessfully";
    } else {
        echo "someone already register
          using this email";
    }
    $stmt->close();
    $conn->close();
    }
}   else {
    echo "All field are required";
    die();
}
?>