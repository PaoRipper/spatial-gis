<!-- อ้างถึงไฟล์ config.php ที่ใช้ตั้งค่าฐานข้อมูล -->
<?php include('config.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200;400&display=swap" rel="stylesheet">
    <style>
        *{
            font-family: "Kanit", sans-serif;
        }
        .container{
            width: 50%;
        }
    </style>
    
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">PM2.5 (2008-2017)</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="index.php">แผนที่โลก</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="insert.php">เพิ่มข้อมูล</a>
                </li>            
                <li class="nav-item">
                    <a class="nav-link" href="searchC.php">PM 2.5 ในแต่ละปี</a>
                </li>       
                <li class="nav-item">
                    <a class="nav-link" href="searchYearColor.php">คนที่ได้รับผลกระทบ</a>
                </li>   
                <li class="nav-item">
                    <a class="nav-link" href="AllCityofCountry.php">รายชื่อเมือง</a>
                </li>  
                <li class="nav-item">
                    <a class="nav-link" href="colorShowPM25.php">PM 2.5 ตามสี</a>
                </li>    
            </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-3">
        <h1>INSERT DATA</h1>
    <!-- ส่วน Form Insert ข้อมูลเข้า table AirPollution -->
        <form method="POST" action="">
            <div class="mb-3">
                <label class="form-label" for="">Country: </label>
                <input class="form-control" type="text" name="country" id="" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="">City: </label>
                <input class="form-control" type="text" name="city" id="" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="">Year: </label>
                <input class="form-control" type="number" name="year" id="" step="0.01" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="">PM2.5: </label>
                <input class="form-control" type="number" name="pm25" id="" step="0.01" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="">Latitude: </label>
                <input class="form-control" type="number" name="latitude" id="" step="0.01" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="">Longtitude: </label>
                <input class="form-control" type="number" name="longtitude" id="" step="0.01" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="">Polulation: </label>
                <input class="form-control" type="number" name="population" id="" step="0.01" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="">wbinc16_text: </label>
                <input class="form-control" type="text" name="wbinc" id="">
            </div>
            <div class="mb-3">
                <label class="form-label" for="">Region: </label>
                <input class="form-control" type="text" name="region" id="" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="">conc_pm25 (ช่วงค่า PM2.5 EX: 20-15): </label>
                <input class="form-control" type="text" name="conc" id="" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="">color_pm25: </label>
                <input class="form-control" type="text" name="color" id="" >
            </div>
            <div class="mb-3">
                <input class="btn btn-primary"type="submit" value="Insert" name="submit">
            </div>
        </form>  
    </div>

    <!-- โค้ด php logic ของการ insert ข้อมูลลง Table AirPollutionPM25 -->
<?php
    // เช็คว่าถ้ามีการกดปุ่ม submit ให้ทำคำสั่งต่อไปนี้
    if (isset($_POST['submit'])) {
        try {
            // รับค่าตัวแปรมาจากฟอร์ม
            $country = $_POST['country'];
            $city = $_POST['city'];
            $year = floatval($_POST['year']);
            $pm25 = floatval($_POST['pm25']);
            $latitude =floatval($_POST['latitude']);
            $longtitude = floatval($_POST['longtitude']);
            $population = floatval($_POST['population']);
            $region = $_POST['region'];
            $wbinc = $_POST['wbinc'];
            $conc = $_POST['conc'];
            $color = $_POST['color'];

            // รันคำสั่ง SQL เพื่อ insert ข้อมูล
            $sql = "INSERT INTO AirPollutionPM25 (country, city, year, pm25, latitude, longtitude, population, region, wbinc16_text, conc_pm25, color_pm25)
            VALUES (:country, :city, :year, :pm25, :latitude, :longtitude, :population, :region, :wbinc, :conc, :color)";
            //prepare $sql ที่เราจะใช้
            $query = $dbconn->prepare($sql);
            // Bind Parameter เพราะว่าเราจะไม่ใส่ค่าที่รับมาจากฟอร์มเข้าไปใน query ตรงๆ เพื่อป้องกัน SQL Injection
            $query->bindParam(':country', $country); //Bind ตัวแปร $country เข้าไปยัง :country แล้วจึงเอา :country ไปใส่ใน query
            $query->bindParam(':city', $city); //Bind ตัวแปร $city เข้าไปยัง :city แล้วจึงเอา :city ไปใส่ใน query
            $query->bindParam(':year', $year);
            $query->bindParam(':pm25', $pm25);
            $query->bindParam(':latitude', $latitude);
            $query->bindParam(':longtitude', $longtitude);
            $query->bindParam(':population', $population);
            $query->bindParam(':region', $region);
            $query->bindParam(':wbinc', $wbinc);
            $query->bindParam(':conc', $conc);
            $query->bindParam(':color', $color);
            $result = $query->execute();
            // อัพเดท Column Geom ทีหลังด้วยค่า lat, long และ SRID เป็น 4326
            $sql2 = "update AirPollutionPM25 set Geom = geometry::Point(latitude, longtitude, 4326)";
            $query2 = $dbconn->prepare($sql2);
            $query2->execute();
            echo "<script>alert('เพิ่มข้อมูลสำเร็จ!')</script>";
        } catch (Exception $e) {
            echo "<script>alert('มีบางอย่างผิดพลาด (เพิ่มข้อมูลไม่สำเร็จ)')</script>";
            //$error คือข้อความที่จะใช้เป็น error
            $error = $e->getMessage();
            //$path คือที่อยู่ของไฟล์ log ที่จะใช้เก็บ error 
            $path = "./ERROR_LOG/err_log.log";
            error_log($error, 3, $path);
        }
    }
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>







