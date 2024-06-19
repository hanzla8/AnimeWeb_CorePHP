<?php 

try {
    // HOST
    $HOST   = "localhost";

    // dbname
    $DBNAME = "anime";

    // user
    $USER   = "root";

    // pass
    $PASS   = "";


    $conn = new PDO("mysql:host=".$HOST.";dbname=".$DBNAME."", $USER, $PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    // if($conn == true) {
    //     echo "db connection is a Success";
    // } else {
    //     echo "db error";
    // }

} catch (PDOException $e) {
    echo $e->getMessage();
}