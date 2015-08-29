<?php
require('../includes/config.php');
$err_designerName = $err_image = $gen_error = '';
$holder_designerName = $holder_designerDesc = '';
if($_SERVER['REQUEST_METHOD'] == "POST") {
    $designer_name = $designer_desc ='';
    if(!empty($_POST['txtDesignerName'])) {
        $designer_name = trim($_POST['txtDesignerName']);
        $holder_designerName = trim($_POST['txtDesignerName']);
    }
    else {
        $err_designerName = "* required";
    }
    $designer_desc = trim($_POST['txtDesignerDesc']);
    $holder_designerDesc = trim($_POST['txtDesignerDesc']);
    if($designer_name != NULL) {
        /*$query_InsertCategory="INSERT INTO category (category_name,section_id) VALUES('$cat_name','$section_id')";
        if($con->query($query_InsertCategory) === TRUE) {
            echo "<script>alert(\"New category added successfully\");</script>";
            header('Refresh:0');
        }
        else {
            echo "<script>alert(\"There was some problem adding this category\");</script>";
            header('Refresh:0');
        }*/
        //------------ Image Handling Code --------------//
        if(!isset($_FILES['image']) || $_FILES['image']['error'] == UPLOAD_ERR_NO_FILE) {
            $image_name = NULL;
        } else {
            $target_dir = "../images/images_designer/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            $new_image_name = $target_dir . $designer_name . '.' . pathinfo($target_file,PATHINFO_EXTENSION);
            // Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) {
                $check = getimagesize($_FILES["image"]["tmp_name"]);
                if($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
            }
            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }
            // Check file size
            if ($_FILES["image"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $new_image_name)) {
                    //echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
            
            $image_name=$designer_name . "." .pathinfo($target_file,PATHINFO_EXTENSION);
            /*$from_name = $designer_name . '.' . pathinfo($target_file,PATHINFO_EXTENSION);//$image_name;
            $to_name = $designer_name . '.' . pathinfo($target_file,PATHINFO_EXTENSION);//$image_name;
            // save to file (true) or output to browser (false)
            $save_to_file = true;
            // Quality for JPEG and PNG.
            // 0 (worst quality, smaller file) to 100 (best quality, bigger file)
            // Note: PNG quality is only supported starting PHP 5.1.2
            $image_quality = 100;
            // resulting image type (1 = GIF, 2 = JPG, 3 = PNG)
            // enter code of the image type if you want override it
            // or set it to -1 to determine automatically
            $image_type = -1;
            // maximum thumb side size
            $max_x = 224;
            $max_y = 126;
            // cut image before resizing. Set to 0 to skip this.
            $cut_x = 0;
            $cut_y = 0;
            // Folder where source images are stored (thumbnails will be generated from these images).
            // MUST end with slash.
            $images_folder = '../images/images_designer/';
            // Folder to save thumbnails, full path from the root folder, MUST end with slash.
            // Only needed if you save generated thumbnails on the server.
            // Sample for windows:     c:/wwwroot/thumbs/
            // Sample for unix/linux:  /home/site.com/htdocs/thumbs/
            $thumbs_folder = '../images/thumb_designer/';
            
            // include image processing code
            include('thumb_generator/image.class.php');
            $img = new Zubrag_image;

            // initialize
            $img->max_x        = $max_x;
            $img->max_y        = $max_y;
            $img->cut_x        = $cut_x;
            $img->cut_y        = $cut_y;
            $img->quality      = $image_quality;
            $img->save_to_file = $save_to_file;
            $img->image_type   = $image_type;

            // generate thumbnail
            $img->GenerateThumbFile($images_folder . $from_name, $thumbs_folder . $to_name);*/
        }

        if($image_name != NULL) {
            $sql="INSERT INTO designer (designer_name,designer_desc,designer_image) VALUES ('$designer_name','$designer_desc','$image_name')";
            if($con->query($sql)===TRUE) {
                echo "<script> alert(\"Designer Added Successfully\"); </script>";
                header('Refresh:0');
            }
            else {
                echo "Query Fail.";
            } 
        }
        
        else {
                echo "<script> alert(\"Sorry, there was an error uploading your file.\"); </script>";
                header('Refresh:0');
            }
            }
            
            
            //------------ Image Handling Code --------------//
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
    <title>Add Designer</title>
    <link rel="stylesheet" href="../includes/main_style.css" >
</head>
<body>
<?php
include("../includes/header_admin.inc.php");
include("../includes/nav_admin.inc.php");
include("../includes/aside_admin.inc.php");
?>
<section>
    <h1>Add Designer</h1>
    <form action="" method="POST" enctype="multipart/form-data" class="form">
        <ul class="form-list">
            <li>
                <div class="label-block"> <label for="designerName">Designer Name</label> </div>
                <div class="input-box"><input type="text" name="txtDesignerName" id="designerName" placeholder="Designer Name *" value="<?php echo $holder_designerName; ?>" /> </div> <span class="error_message"><?php echo $err_designerName; ?></span>
            </li>
            <li>
                <div class="label-block"> <label for="designerDesc">Designer Description</label> </div>
                <div class="input-box"><textarea name="txtDesignerDesc" id="designerDesc"><?php echo $holder_designerDesc; ?></textarea></div>
            </li>
            <!-- image -->
            <li>
                <div class="label-block"> <label for="image">Image</label> </div>
                <div class="input-box"><input type="file" name="image" id="image" /> </div> <span class="error_message"><?php echo $err_image; ?></span>
            </li>
            <li>
                <input type="submit" value="Add Designer" class="submit_button" /> <span class="error_message"><?php echo $gen_error; ?></span>
            </li>
        </ul>
    </form>
</section>
<?php
include("../includes/footer_admin.inc.php");
?>
</body>
</html>