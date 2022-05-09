<!-- ส่วน Logic สำหรับการ Filter -->
<?php
    // เช็คว่าถ้ามีการกด submit
    if(isset($_POST['submit'])){
        // เช็คว่าตัวแปรมีค่าหรือไม่ ถ้ามีค่อยทำในเงื่อนไข เพื่อป้องกันกรณี user ไม่ใส่ค่าแต่กด submit มาเลย
        if(isset($_POST['low-income']) && $_POST['low-income'] != 'default'){
            // ให้ตัวแปล year รับค่าปีมาเก็บไว้
            $year = $_POST['low-income'];
            // ใช้ switch เพื่อเลือกแต่ละปีแล้วให้ break ออกเลย
            switch($year){
                case '2008':
                    header('location: lowi2008.php');
                    break;
                case '2009':
                    header('location: lowi2009.php');
                    break;
                case '2010':
                    header('location: lowi2010.php');
                    break;
                case '2011':
                    header('location: lowi2011.php');
                    break;
                case '2012':
                    header('location: lowi2012.php');
                    break;
                case '2013':
                    header('location: lowi2013.php');
                    break;
                case '2014':
                    header('location: lowi2014.php');
                    break;
                case '2015':
                    header('location: lowi2015.php');
                    break;
                case '2016':
                    header('location: lowi2016.php');
                    break;
                case '2017':
                    header('location: lowi2017.php');
                    break;
            }
        }
    }

?>