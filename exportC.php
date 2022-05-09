<?php
    // ไฟล์ส่วนที่ใช้ Export ข้อมูลของหน้า "PM2.5 ในแต่ละปี" ออกมาเป็นไฟล์ excel
    include('config.php');
    // ประกาศ session_start เพื่อให้สามารถใช้ตัวแปรแบบ session ข้ามหน้าได้
    session_start();
    // รับค่าตัวแปร country มาจาก $_SESSION['country] จากหน้า SearchC
    $country = $_SESSION['country'];
    
    // Query ข้อมูลจากฐานข้อมูล
    $sql = "SELECT avg(pm25) as avgPM25, year FROM AirPollutionPM25 WHERE Country = :country GROUP BY year ORDER BY year";
    $query = $dbconn->prepare($sql);
    $query->bindParam(':country', $country, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_OBJ);
    // ตัวแปร html จะอยู้ในรูปแบบ table เพื่อให้ export ไปใส่ใน table excel ได้
    $html = '<table><tr><th>PM2.5</th><th>Year</th></tr>';
    foreach($result as $res){
        $html.="<tr><td>$res->avgPM25</td><td>$res->year</td></tr>";
    }
    $html.="</table>";
    // ตั้งค่านามสกุลไฟล์เป็น xls
    header('Content-Type:application/xls');
    // ตั้งชื่อไฟล์ที่จะ export 
    header('Content-Disposition:attachment;filename='.$country.'PM2.5Report.xls');
    echo $html;

?>