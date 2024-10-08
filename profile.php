<?php
include("webcomponents/header.php");
if($_SESSION['userrole']!="user"){
    echo "<script>
    location.assign('index.php')
    </script>";
}
?>
profile
<?php
include("webcomponents/footer.php");
?>