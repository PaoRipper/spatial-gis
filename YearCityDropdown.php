<!-- ส่วน Logic สำหรับการ Filter -->
<?php
    // เช็คว่าถ้ามีการกด submit
    if(isset($_POST['submit'])){
        // เช็คว่าตัวแปรมีค่าหรือไม่ ถ้ามีค่อยทำในเงื่อนไข เพื่อป้องกันกรณี user ไม่ใส่ค่าแต่กด submit มาเลย
        if(isset($_POST['cityYear']) && $_POST['cityYear'] != 'default'){
            // ให้ตัวแปร year เก็บค่าไว้
            $year = $_POST['cityYear'];
            // ใช้ switch เพื่อ filter แต่ละเคสแล้ว break
            switch($year){
                case 2008:
                    header('location: 2008.php');
                    break;
                case 2009:
                    header('location: 2009.php');
                    break;
                case 2010:
                    header('location: 2010.php');
                    break;
                case '2011':
                    header('location: 2011.php');
                    break;
                case '2012':
                    header('location: 2012.php');
                    break;
                case '2013':
                    header('location: 2013.php');
                    break;
                case '2014':
                    header('location: 2014.php');
                    break;
                case '2015':
                    header('location: 2015.php');
                    break;
                case '2016':
                    header('location: 2016.php');
                    break;
                case '2017':
                    header('location: 2017.php');
                    break;
            }
        }
    }

?>