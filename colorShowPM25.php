<!-- อ้างถึงไฟล์ config.php ที่ใช้ตั้งค่าฐานข้อมูล -->
<?php include('config.php') ?>
<!-- ประกาศ session_start เพื่อให้ใช้ตัวแปรแบบ session ได้ เพื่อส่งค่าข้ามหน้า -->
<?php session_start() ?>

<?php include ('colorPMLogic.php'); ?>

<?php $isShow = false?>

<?php
    // เช็คว่า session url มีค่าหรือไม่ (จากไฟล์ colorPMLogic.php)
    if(isset($_SESSION['url'])){
        $url = $_SESSION['url'];
    }else{
        $url = '';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search by color show PM2.5</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
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
                    <a class="nav-link" href="searchYearColor.php">คนที่ได้รับผลกระทบ</a>
                </li>   
                <li class="nav-item">
                    <a class="nav-link" href="AllCityofCountry.php">รายชื่อเมือง</a>
                </li> 
                <li class="nav-item">
                    <a class="nav-link active" href="colorShowPM25.php">PM 2.5 ตามสี</a>
                </li>     
            </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-3">
        <!-- ฟอร์มสำหรับค้นหาข้อมูล PM2.5 ในแต่ละปีของประเทศที่กรอกเป็น Input -->
        <form action="" method="GET">
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
                <a class="btn btn-warning text-dark" href="<?php echo $url ?>">ดูในแผนที่</a>
            </div> 
        </form>
    </div> 
    <!-- ส่วน table ที่ใช้แสดงข้อมูลเป็นตารางออกมา -->
    <table id = "myTable" class="table table-hover">
        <tr>
            <th>Country</th>
            <th>City</th>
            <th>Color</th>
        </tr>
            <?php 
                if(isset($_GET['submit'])){
                    $isShow = true;
                    $color = $_GET['color'];
                    $sql = "SELECT city, color_pm25, country FROM AirPollutionPM25 WHERE color_pm25 = :color GROUP BY color_pm25, city, country ORDER By Country ";
                    $query = $dbconn->prepare($sql);
                    $query->bindParam(':color', $color, PDO::PARAM_STR);
                    $query->execute();
                    $result = $query->fetchAll(PDO::FETCH_OBJ);
                    foreach ($result as $res) {
            ?>
                <tr>
                    <td><?php echo $res->country; ?></td>     
                    <td><?php echo $res->city; ?></td>     
                    <td><?php echo $res->color_pm25; ?></td>        
                <?php } ?>
            <?php } ?>
    </table>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <!-- script สำหรับสร้าง table แบบสำเร็จรูปออกมา จาก Libary DataTable ซึ่งเป็น Free Libary สำหรับ jQuery เพื่อสร้างตารางออกมาสวยๆให้เรา -->
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </>
</body>
</html>