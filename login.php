<?php
$Uname = $_POST['Uname'];
$Pass = $_POST['Pass'];


if (!empty($Uname) || !empty($Pass)){
    $host = "localhost";
    $dbUname = "root";
    $dbPass = "";
    $dbname = "DeathRegistration";

    $connect = mysqli_connect($host, $dbUname, $dbPass, $dbname);
    if (mysqli_connect error()){
        die('Connect Error('. mysqli_connect_error().')'. mysqli_connect_error());
    }else{
        $SELECT = "SELECT numberID From DeathRegistration Where numberID = ? Limit 1";
        $INSERT = "INSERT Into register(Uname, Pass) values(?, ?)";

        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $Pass);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        if ($rnum==0){
            $stmt->close();

            $stmt= $conn->prepare($INSERT);
             $stmt->bind_param("ss",$Uname, $Pass);
            $stmt->execute();
            echo "New record inserted successfully";
        }
        else{
            echo "Someone already register using this email";

        }

    $stmt->close();
    $conn->close();

    }

}else
echo "All field are required";
die();
}
?>
