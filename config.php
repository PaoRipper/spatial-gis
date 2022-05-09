<?php
    // ไฟล์ Config.php ใช้สำหรับการตั้งค่าการเชื่อมต่อฐานข้อมูลที่จะใข้
    $servername = "LAPTOP-CI8C3PSJ\\SQLEXPRESS"; //servername สำหรับ SQL SERVER
    $username = ""; //ไม่มี username เพราะไม่ได้ตั้ง ให้ Window Authentication
    $password = ""; //ไม่มี username เพราะไม่ได้ตั้ง ให้ Window Authentication
    $dbname = "AirPollution"; //ฐานข้อมูลที่จะใช้ชื่อ AirPollution

    try{
        $dbconn = new PDO("sqlsrv:server=$servername ; Database = $dbname", $username, $password);
        //set the PDO error mode to exception
        $dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
    }catch(PDOException $e){
        echo "Failed to connect to database ". $e->getMessage();
    }

?>