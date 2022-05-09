<!-- อ้างถึงไฟล์ PHP ส่วน Logic ที่ใช้เลือก Filter เข้ามา -->
<?php include('RadioCase.php'); ?>
<?php include('YearCityDropdown.php'); ?>
<?php include('lowIncomeCityLogic.php'); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City in 2010</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://js.arcgis.com/4.23/esri/themes/light/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://js.arcgis.com/4.23/esri/themes/light/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    

    <style>.embed-container {position: relative; padding-bottom: 80%; height: 0; max-width: 100%;} .embed-container iframe, .embed-container object, .embed-container iframe{position: absolute; top: 0; left: 0; width: 100%; height: 100%;} small{position: absolute; z-index: 40; bottom: 0; margin-bottom: -15px;}</style>

    <script src="https://js.arcgis.com/4.23/"></script>
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
                    <a class="nav-link active" aria-current="page" href="index.php">แผนที่โลก</a>
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
                    <a class="nav-link" href="colorShowPM25.php">PM 2.5 ตามสี</a>
                </li>   
            </ul>
            </div>
        </div>
    </nav>
    <!-- ส่วนแสดงแผนที่บนหน้าเว็บ -->
    <div class="embed-container"><iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="City2010" src="//aisciqq41hcqqoka.maps.arcgis.com/apps/Embed/index.html?webmap=8148a9a274ad4875a732325a14da0467&extent=-4.2354,41.7063,21.6484,51.2899&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&basemap_gallery=true&disable_scroll=false&theme=light"></iframe>
    <div class="form">
            <!-- ฟอร์มสำหรับเลือก Filter แผนที่ตามที่ต้องการ -->
            <form action="" method="POST">
                <div class="cityYear-dropdown">
                    <label for="cityYear">Show city by year:</label>
                    <select name="cityYear" id="cityYear" class="dropdown btn btn-primary mx-2">
                    <option selected value="default">Select Year</option>

                        <option value="2008">2008</option>
                        <option value="2009">2009</option>
                        <option value="2010">2010</option>
                        <option value="2011">2011</option>
                        <option value="2012">2012</option>
                        <option value="2013">2013</option>
                        <option value="2014">2014</option>
                        <option value="2015">2015</option>
                        <option value="2016">2016</option>
                        <option value="2017">2017</option>
                    </select>
                </div>
                <div class="mb-2">
                    <input class="radio" type="radio" name="ans" id="" value="50city">
                    <label for="">50 closest city from Bangkok</label>
                </div>
                <div class="mb-2">
                    <input class="radio" type="radio" name="ans" id="" value="neightborTH">
                    <label for="">City of Thailand's Neighboring Countries in 2018</label>
                </div>
                <div class="mb-2">
                    <input class="radio" type="radio" name="ans" id="" value="4pMBR">
                    <label for="">4 points of MBR in Thailand in 2009</label>
                </div>
                <div class="mb-1">
                    <input class="radio" type="radio" name="ans" id="" value="highC">
                    <label for="">Country with highest city in 2011</label>
                </div>
                <div class="cityYear-dropdown mb-2">
                    <label for="low-income">Low income city:</label>
                    <select name="low-income" id="low-income" class="dropdown btn btn-primary mx-2">
                        <option selected value="default">Select Year</option>
                        <option value="2008">2008</option>
                        <option value="2009">2009</option>
                        <option value="2010">2010</option>
                        <option value="2011">2011</option>
                        <option value="2012">2012</option>
                        <option value="2013">2013</option>
                        <option value="2014">2014</option>
                        <option value="2015">2015</option>
                        <option value="2016">2016</option>
                        <option value="2017">2017</option>
                    </select>
                </div>
                    <input type="submit" name="submit" id="" value="Submit" class="btn btn-warning text-dark">
                    <a href="index.php" class="btn btn-info text-white">กลับหน้าหลัก</a>

            </form> 
        </div>
    </div>
                    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>