<?php
require('../includes/config.php');
if(!$_GET['id']) {
    echo "You have not selected any designer to edit.";
    die();
}
$id = $_GET['id'];
$query_selectDesigner = "SELECT designer_name,designer_desc FROM designer WHERE designer_id=$id";
$result_selectDesigner = $con->query($query_selectDesigner);
$row_selectDesigner = $result_selectDesigner->fetch_array();
$err_designerName = $err_image = $gen_error = '';
if($_SERVER['REQUEST_METHOD'] == "POST") {
    $designer_name = $designer_desc ='';
    if(!empty($_POST['txtDesignerName'])) {
        $designer_name = trim($_POST['txtDesignerName']);
    }
    else {
        $err_designerName = "* required";
    }
    $designer_desc = trim($_POST['txtDesignerDesc']);
    if($designer_name != '') {
        $query_updateDesigner = "UPDATE designer SET designer_name='$designer_name',designer_desc='$designer_desc' WHERE designer_id='$id'";
        if($con->query($query_updateDesigner)){
            echo "<script> alert(\"Designer Updated Successfully\"); </script>";
            header('Refresh:0;url=view_designer.php');
        }
        else {
            echo "<script> alert(\"Designer Updatio Failed\"); </script>";
        }
    }
    else {
        $gen_error = "Fields marked with * are compulsory";
    }
}
$con->close();
?>

<!doctype html>
<html>
<head>
    <title>Edit Designer</title>
    <link rel="stylesheet" href="../includes/main_style.css" >
</head>
<body>
<?php
include("../includes/header_admin.inc.php");
include("../includes/nav_admin.inc.php");
include("../includes/aside_admin.inc.php");
?>
<section>
    <h1>Edit Designer</h1>
    <form action="" method="POST" enctype="multipart/form-data" class="form">
        <ul class="form-list">
            <li>
                <div class="label-block"> <label for="designerName">Designer Name</label> </div>
                <div class="input-box"><input type="text" name="txtDesignerName" id="designerName" placeholder="Designer Name *" value="<?php echo $row_selectDesigner['designer_name']; ?>" /> </div> <span class="error_message"><?php echo $err_designerName; ?></span>
            </li>
            <li>
                <div class="label-block"> <label for="designerDesc">Designer Description</label> </div>
                <div class="input-box"><textarea name="txtDesignerDesc" id="designerDesc"><?php echo $row_selectDesigner['designer_desc']; ?></textarea></div>
            </li>
            <li>
                <input type="submit" value="Update" class="submit_button" /> <span class="error_message"><?php echo $gen_error; ?></span>
            </li>
        </ul>
    </form>
</section>
<?php
include("../includes/footer_admin.inc.php");
?>
</body>
</html>