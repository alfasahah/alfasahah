<?php
require('../includes/config.php');
if(!$_GET['id']) {
    echo "You have not selected any channel to edit.";
    die();
}
$id = $_GET['id'];
$query_selectChannel = "SELECT channel_name,channel_desc FROM channel WHERE channel_id=$id";
$result_selectChannel = $con->query($query_selectChannel);
$row_selectChannel = $result_selectChannel->fetch_array();
$err_channelName = $err_image = $gen_error = '';
if($_SERVER['REQUEST_METHOD'] == "POST") {
    $channel_name = $channel_desc ='';
    if(!empty($_POST['txtChannelName'])) {
        $channel_name = trim($_POST['txtChannelName']);
    }
    else {
        $err_channelName = "* required";
    }
    $channel_desc = trim($_POST['txtChannelDesc']);
    if($channel_name != '') {
        $query_updateChannel = "UPDATE channel SET channel_name='$channel_name',channel_desc='$channel_desc' WHERE channel_id='$id'";
        if($con->query($query_updateChannel)){
            echo "<script> alert(\"Channel Updated Successfully\"); </script>";
            header('Refresh:0;url=view_channel.php');
        }
        else {
            echo "<script> alert(\"Channel Updatio Failed\"); </script>";
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
    <title>Edit Channel</title>
    <link rel="stylesheet" href="../includes/main_style.css" >
</head>
<body>
<?php
include("../includes/header_admin.inc.php");
include("../includes/nav_admin.inc.php");
include("../includes/aside_admin.inc.php");
?>
<section>
    <h1>Edit Channel</h1>
    <form action="" method="POST" enctype="multipart/form-data" class="form">
        <ul class="form-list">
            <li>
                <div class="label-block"> <label for="channelName">Channel Name</label> </div>
                <div class="input-box"><input type="text" name="txtChannelName" id="channelName" placeholder="Channel Name *" value="<?php echo $row_selectChannel['channel_name']; ?>" /> </div> <span class="error_message"><?php echo $err_channelName; ?></span>
            </li>
            <li>
                <div class="label-block"> <label for="channelDesc">Channel Description</label> </div>
                <div class="input-box"><textarea name="txtChannelDesc" id="channelDesc"><?php echo $row_selectChannel['channel_desc']; ?></textarea></div>
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