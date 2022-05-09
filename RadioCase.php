<!-- ส่วน Logic สำหรับการ Filter -->
<?php
    // เช็คว่าถ้ามีการกด submit
    if(isset($_POST['submit'])){
        // เช็คว่าตัวแปรมีค่าหรือไม่ ถ้ามีค่อยทำในเงื่อนไข เพื่อป้องกันกรณี user ไม่ใส่ค่าแต่กด submit มาเลย
        if(isset($_POST['ans'])){
            // ให้ตัวแปร ans รับค่าเก็บไว้
            $ans = $_POST['ans']; 
            // ใช้ switch เพื่อเลือกแต่ละเคส แล้ว break ออกเลย
            switch($ans){
            case 'CYear':
                header('location: 50cityNearBangkok.php');
                break;
            case '50city':
                header('location: 50cityNearBangkok.php');
                break;
            case 'neightborTH':
                header('location: cityBorderThailand.php');
                break;
            case '4pMBR':
                header('location: NoInformation.php');
                break;
            case 'highC':
                header('location: CountyHighestCity2011.php');
                break;
            case '':
                header('location: index.php');
        }
        } 
    }
?>