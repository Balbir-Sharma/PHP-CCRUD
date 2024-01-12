<!DOCTYPE html>
<html>
<head>
  <title>Insert Page Data</title>
</head>
<body>
  <?php
  include('config.php');

  ?>
  <?php
  if (isset($_POST['submit'])) {
    if (!empty($_POST['chk_hobby'])) {
      foreach ($_POST['chk_hobby'] as $value) {
        echo "value : " . $value . '<br/-->';
      }
    }
  }
  ?>

<?php 
$statusMsg = ''; 
 
// File upload directory 
$targetDir = "image/"; 
 
if(isset($_POST["submit"])){ 



  $name =  $_REQUEST['Empname'];
  $email =  $_REQUEST['email'];
  $pass = $_REQUEST['password'];
  $phone = $_REQUEST['Phone'];
  $address = $_REQUEST['address'];
  $gender = $_REQUEST['gender'];
  $dob = $_REQUEST['dob'];
  $dept = $_REQUEST['dept'];
  $image = $_REQUEST['image'];
  
    if(!empty($_FILES["file"]["image"])){ 

        $image = basename($_FILES["file"]["image"]); 
        $targetFilePath = $targetDir . $image; 
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION); 
     
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            // Upload file to server 
            if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){ 
                // Insert image file name into database 
                $sql = "INSERT INTO `empcon` (name,email,`password`,phone,`address`,gender,chk_hobby,dob,dept,`image`)
                 VALUES ('$name','$email','$pass','$phone','$address','$gender', '$hobbiesString','$dob','$dept','$image')";
  
                // $insert = $db->query("INSERT INTO empcon (file_name, uploaded_on) VALUES ('".$image."', NOW())"); 
                if($sql){ 
                    $statusMsg = "The file ".$image. " has been uploaded successfully."; 
                }else{ 
                    $statusMsg = "File upload failed, please try again."; 
                }  
            }else{ 
                $statusMsg = "Sorry, there was an error uploading your file."; 
            } 
        }else{ 
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
        } 
    }else{ 
        $statusMsg = 'Please select a file to upload.'; 
    } 
    if (mysqli_query($conn, $sql)) {
    }
    header("Location: index.php");
} 
 // Display status message 
echo $statusMsg; 
?>

</body>

</html>