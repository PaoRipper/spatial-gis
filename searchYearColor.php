<!-- อ้างถึงไฟล์ config.php ที่ใช้ตั้งค่าฐานข้อมูล -->
<?php include('config.php') ?>
<?php $isShow = false ?>
<!-- ประกาศ session_start เพื่อให้ใช้ตัวแปรแบบ session ได้ เพื่อส่งค่าข้ามหน้า -->
<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search by Year and Color</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://js.arcgis.com/4.23/esri/themes/light/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/a0834e69e0.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                    <a class="nav-link" href="insert.php">เพิ่มข้อมูล</a>
                </li>            
                <li class="nav-item">
                    <a class="nav-link" href="searchC.php">PM 2.5 ในแต่ละปี</a>
                </li>       
                <li class="nav-item">
                    <a class="nav-link active" href="searchYearColor.php">คนที่ได้รับผลกระทบ</a>
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
        <!-- ฟอร์ม input สำหรับแสดงข้อมูลจำนวนคนที่ได้รับผลกระทบจาก PM2.5 ตามปีและสีที่ใส่ -->
        <form action="" method="GET">
            <div class="mb-3">
                <label class="form-label"for="">Year: </label>
                <select name="year" id="year" class="btn btn-primary mx-2 mb-2">
                    <option value=""><-- Please Select Year --></option>
                    <?php
                        $sql = "SELECT DISTINCT Year from AirPollutionPM25 ORDER BY Year";
                        $query = $dbconn->prepare($sql);
                        $query->execute();
                        $result = $query->fetchAll(PDO::FETCH_OBJ);
                        foreach($result as $res){
                    ?>
                        <option value="<?php echo round($res->Year, 0) ?>"><?php echo round($res->Year, 0) ?></option>"
                    <?php 
                        } 
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label"for="">Color: </label>
                <select name="color" id="color" class="btn btn-primary mx-2 mb-2">
                    <option value=""><-- Please Select Color --></option>
                    <?php
                        $sql = "SELECT DISTINCT color_pm25 from AirPollutionPM25";
                        $query = $dbconn->prepare($sql);
                        $query->execute();
                        $result = $query->fetchAll(PDO::FETCH_OBJ);
                        foreach($result as $res){
                    ?>
                        <option value="<?php echo $res->color_pm25 ?>"><?php echo $res->color_pm25 ?></option>"
                    <?php 
                        } 
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <input class="btn btn-primary" type="submit" value="Search" name="submit">
                <a href="exportCY.php" class="btn btn-success">Export <i class="fa-solid fa-file-export"></i></a>
            </div>
        </form>
    </div> 
    <!-- ส่วน table ที่ใช้แสดงข้อมูลเป็นตารางออกมา -->
    <table id = "myTable" class="table table-hover">
        <tr>
            <th>Affected Population (คน)</th>
            <th>Year</th>
            <th>Color</th>
        </tr>
            <?php 
                if(isset($_GET['submit'])){
                    $isShow = true;
                    $year = $_GET['year'];
                    $color = $_GET['color'];
                    $_SESSION['year'] = $year;
                    $_SESSION['color'] = $color;
                    $sql = "SELECT sum(population) as sumP, year, color_pm25 FROM AirPollutionPM25 WHERE year = :year AND color_pm25 = :color group by year, color_pm25";
                    $query = $dbconn->prepare($sql);
                    $query->bindParam(':year', $year, PDO::PARAM_STR);
                    $query->bindParam(':color', $color, PDO::PARAM_STR);
                    $query->execute();
                    $result = $query->fetchAll(PDO::FETCH_OBJ);
                    foreach ($result as $res) {
            ?>
                <tr>
                        <td><?php echo round($res->sumP, 0); ?></td>     
                        <td><?php echo round($res->year, 0); ?></td>        
                        <td><?php echo $res->color_pm25; ?> <?php echo ($color == 'red') ? "<i class='fa-solid fa-face-dizzy'></i>" : ''; ?>
                        <?php echo ($color == 'orange') ? "<i class='fa-solid fa-face-flushed'></i>" : ''; ?> <?php echo ($color == 'yellow') ? "<i class='fa-solid fa-face-grin-tears'></i>" : ''; ?>
                        </td>     
                <?php } ?>
            <?php } ?>
    </table>

    <!-- เมื่อกดค้นหาแล้วพบผลลัพธ์ จะแสดงข้อความ "รายละเอียดเพิ่มเติม" ออกมา -->
    <?php if($isShow): ?>
        <a href="https://www.sanook.com/health/14377/"><h4 class="more-information fw-light mt-4">รายละเอียดเพิ่มเติม</h4></a>
    <?php else: ?>
    <?php endif; ?>
    
    <script src="https://js.arcgis.com/4.23/"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></>
    // script สำหรับสร้าง table แบบสำเร็จรูปออกมา จาก Libary DataTable ซึ่งเป็น Free Libary สำหรับ jQuery เพื่อสร้างตารางออกมาสวยๆให้เรา
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
</body>
</html>