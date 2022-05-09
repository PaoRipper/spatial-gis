<?php
    // ไฟล์ส่วนที่ใช้ Export ข้อมูลของหน้า "คนที่ได้รับผลกระทบ" ออกมาเป็นไฟล์ excel
    include('config.php');
    // ประกาศ session_start เพื่อให้สามารถใช้ตัวแปรแบบ session ข้ามหน้าได้
    session_start();
    // รับค่าตัวแปร year, country มาจาก $_SESSION['year], $_SESSION['country] จากหน้า SearchYearColor
    $year = $_SESSION['year'];
    $color = $_SESSION['color'];

    // Query ข้อมูลจากฐานข้อมูล
    $sql = "SELECT sum(population) as sumP, year, color_pm25 FROM AirPollutionPM25 WHERE year = :year AND color_pm25 = :color group by year, color_pm25";
    $query = $dbconn->prepare($sql);
    $query->bindParam(':year', $year);
    $query->bindParam(':color', $color);
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_OBJ);
    // ตัวแปร html จะอยู้ในรูปแบบ table เพื่อให้ export ไปใส่ใน table excel ได้
    $html = '<table><tr><th>Population</th><th>Year</th><th>Color</th></tr>';
    foreach($result as $res){
        $html.="<tr><td>$res->sumP</td><td>$res->year</td><td>$res->color_pm25</td></tr>";
    }
    $html.="</table>";
    // ตั้งค่านามสกุลไฟล์เป็น xls
    header('Content-Type:application/xls');
    // ตั้งชื่อไฟล์ที่จะ export 
    header('Content-Disposition:attachment;filename='.$color.'IN'.$year.'PM2.5Report.xls');
    echo $html;

?>