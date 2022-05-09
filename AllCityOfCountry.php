<!-- อ้างถึงส่วน Config php เพื่อใช้ Query ข้อมูลจาก Database  -->
<?php include('config.php') ?>
<!-- ประกาศ session เพื่อให้สามารถใช้ตัวแปรแบบ session ได้ -->
<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All City of selected Country</title>
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
                    <a class="nav-link active" href="AllCityofCountry.php">รายชื่อเมือง</a>
                </li> 
                <li class="nav-item">
                    <a class="nav-link" href="colorShowPM25.php">PM 2.5 ตามสี</a>
                </li>     
            </ul>
            </div>
        </div>
    </nav>
    <!-- ฟอร์มกรอกประเทศเพื่อ Query ข้อมูลออกมา -->
    <div class="container mt-3">
        <div class="mb-3">
            <form action="" method="GET">
            <label class="form-label"for="">Country: </label>
            <select name="country" id="country" class="btn btn-primary mx-2 mb-2">
                <option value=""><-- Please Select Country --></option>
                <?php
                    $sql = "SELECT DISTINCT Country from AirPollutionPM25 ORDER BY Country";
                    $query = $dbconn->prepare($sql);
                    $query->execute();
                    $result = $query->fetchAll(PDO::FETCH_OBJ);
                    foreach($result as $res){
                ?>
                    <option value="<?php echo $res->Country ?>"><?php echo $res->Country ?></option>"
                <?php 
                    } 
                ?>
            </select>
        </div>
        
            <div class="mb-3">
                <input type="submit" value="Search" class="btn btn-primary" name="submit" >
            </div>
        </form>
    </div> 

    <!-- Table ที่ใช้แสดงผลข้อมูลที่ Query ออกมา ประกอบไปด้วย Country, City -->
    <table id = "myTable" class="table table-hover">
        <tr>
            <th>Country</th>
            <th>City</th>
        </tr>
            <?php 
                if(isset($_GET['submit'])){
                    $country = $_GET['country'];
                    $_SESSION['country'] = $country;
                    $sql = "SELECT DISTINCT city, country FROM AirPollutionPM25 WHERE Country = :country ORDER BY City";
                    $query = $dbconn->prepare($sql);
                    $query->bindParam(':country', $country, PDO::PARAM_STR);
                    $query->execute();
                    $result = $query->fetchAll(PDO::FETCH_OBJ);
                    foreach ($result as $res) {
            ?>
                <tr>
                        <td><?php echo $res->country ?></td>        
                        <td><?php echo $res->city."<br>"; ?></td>     
                <?php } ?>
            <?php } ?>
    </table>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <!-- ส่วน Script ของ Libary "DataTable" เพื่อให้การแสดงผลแบบตารางสำเร็จรูป -->
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </>
</body>
</html>