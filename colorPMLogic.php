<?php
    //ส่วน Logic สำหรับแสดงแผนที่ตามสีที่ได้เลือก
    if(isset($_GET['submit'])){
        if(isset($_GET['color'])){
            $color = $_GET['color'];
            switch($color){
                case 'darkorange':
                    $_SESSION['url'] = 'darkorange.php';
                    break;
                case 'darkred':
                    $_SESSION['url'] = 'darkred.php';
                    break;
                case 'green':
                    $_SESSION['url'] = 'green.php';
                    break;
                case 'orange':
                    $_SESSION['url'] = 'orange.php';
                    break;
                case 'red':
                    $_SESSION['url'] = 'red.php';
                    break;
                case 'yellow':
                    $_SESSION['url'] = 'yellow.php';
                    break;
            }
        }
    }

?>