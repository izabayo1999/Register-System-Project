<?php
$deceasedperson = $_POST['deceasedperson'];
$numberID = $_POST['numberID'];
$spause = $_POST['spause'];
$father = $_POST['father'];
$mather = $_POST['mather'];
$gender = $_POST['gender'];
$province = $_POST['province'];
$district = $_POST['district'];
$sector = $_POST['sector'];
$bday = $_POST['bday'];
$dday = $_POST['dday'];

if (!empty($deceasedperson) || !empty($numberID) || !empty($spause) || !empty($father) || !empty($mather) || !empty($gender) || !empty($province) || !empty($district) || !empty($sector) || !empty($bday) || !empty($dday)){
    $host = "localhost";
    $dbdeceasedperson = "root";
    $dbnumberID = "";
    $dbname = "deathregistration";

    $connect = mysqli_connect($host, $dbdeceasedperson, $dbnumberID, $dbname);
    if (mysqli_connect error()){
        die('Connect Error('. mysqli_connect_error().')'. mysqli_connect_error());
    }else{
        $SELECT = "SELECT numberID From deathregistration Where numberID = ? Limit 1";
        $INSERT = "INSERT Into register(deceasedperson, numberID, spause, father, mather, gender, province, district, sector, bday, dday) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $numberID);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        if ($rnum==0){
            $stmt->close();

            $stmt= $conn->prepare($INSERT);
             $stmt->bind_param("sisssssssii",$deceasedperson, $numberID, $spause, $father, $mather, $gender, $province, $district,
            $sector, $bday, $dday);
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
