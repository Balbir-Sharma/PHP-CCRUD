<?php
include 'config.php';

$id = $_GET['updateid'];

$sql = "SELECT * FROM `empcon` where id = $id";
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['update'])) {

  // Check if the hobbies array is set
  if (isset($_POST["chk_hobby"])) {
    // Get the selected hobbies
    $hobbiesString = $_POST["chk_hobby"];

    // Serialize the array into a comma-separated string
    $hobbiesString = implode(",", $hobbiesString);
  }
}

  $name = $_POST['Empname'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $gender = $_POST['gender'];
  $hobbies = $_POST['chk_hobby'];
  $dob = $_POST['dob'];
  $dept = $_POST['dept'];

  $image = $_FILES["image"]["name"];
  $tempname = $_FILES["image"]["tmp_name"];
  $folder = "image/" . $image;

 
  $hobbie = "";
  foreach ($hobbies as $row) {
    $hobbie .= $row  . ",";
  }

  $sql = "SELECT `image` FROM `empcon` where id = $id";
  $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    if ($tempname !== ""){
      $img = $image;
    }else{
      $img = $row['image'] ;
    }
      
  $sql = "UPDATE `empcon` SET name='$name',email='$email',phone='$phone',address='$address',gender='$gender',chk_hobby='$hobbiesString',dob='$dob',dept='$dept',image='$img' where id=$id";
  // print_r($sql);
  // exit();
  $result = mysqli_query($conn, $sql);
  if ($result) {
    move_uploaded_file($tempname, $folder);
    header('location:index.php');
  } else {
    die(mysqli_connect($conn, $sql));
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employee system</title>
  <style>
    label {
      display: block;
    }

    .container-centre {
      /* text-align: center; */
      margin-top: 4%;
      margin-left: 40ch;
      margin-right: 40ch;
      background-color: beige;
      /* background-color: chocolate; */
    }

    h2 {
      text-align: center;
      margin-top: 5ch;
      padding-top: 5ch;
    }

    body {
      background-color: grey;
    }

    .container {
      text-align: center;
      margin-top: 5ch;
      margin-bottom: 5ch;
      padding-bottom: 10ch;
    }
  </style>

</head>
<?php
if (isset($_POST['submit'])) {

  if (!empty($_POST['chk_hobby'])) {

    $hobbiesString = implode(",", $_POST['chk_hobby']);

    // Insert and Update record
    $checkEntries = mysqli_query($conn, "SELECT * FROM empcon");
    if (mysqli_num_rows($checkEntries) == 0) {
      mysqli_query($con, "INSERT INTO empcon(chk_hobby) VALUES('" . $hobbiesString . "')");
    } else {
      mysqli_query($con, "UPDATE empcon SET chk_hobby='" . $hobbiesString . "' ");
    }
  }
}
?>

<body>
  <div class="container-centre">
    <h2>Employee table</h2>
    <div class="container">
      <form action="" enctype="multipart/form-data" method="post">
        <label for="name">Name :<input type="text" name="Empname" required value="<?php echo $row['name'] ?>"></label><br>
        <label for="email">Email :<input type="email" name="email" value="<?php echo $row['email'] ?>"></label><br>
        <laebl for="Phone">Phone :<input type="number" name="phone" required value="<?php echo $row['phone'] ?>"></laebl><br>
        <br><label for="Address">Address :<input type="text" name="address" required value="<?php echo $row['address'] ?>"></label><br>
        <label for="gender">Gender :
          <input type="radio" name="gender" value="Male" <?php
                                                          if ($row['gender'] == "Male") {
                                                            echo "checked";}  ?>>Male
          <input type="radio" name="gender" value="Female" <?php
                                                            if ($row['gender'] == "Female") {
                                                              echo "checked";  } ?>>Female
          <input type="radio" name="gender" value="Other" <?php
                                                          if ($row['gender'] == "Other") {
                                                            echo "checked"; } ?>>Other
        </label><br>
        <label for="hobbies">Hobbies :
          <?php

          $checked_arr = explode(",", $row['chk_hobby']);

          // Create checkboxes
          $languages_arr = array("Reading", "Playing", "Swimming");
          foreach ($languages_arr as $chk_hobby) {

            $checked = "";
            if (in_array($chk_hobby, $checked_arr)) {
              $checked = "checked";
            }
            echo '<input type="checkbox" name="chk_hobby[]" value="' . $chk_hobby . '" ' . $checked . ' > ' . $chk_hobby . ' <br/>';
          }
          ?>
          <label for="dob">Enter Your Date of Birth : &nbsp;<input type="date" name="dob" value="<?php echo $row['dob'] ?>">
          </label><br>

          <label for="Dept">Department &nbsp; : &nbsp;
            <select name="dept">
              <option value="dept" selected>select</option>
              <option value="Public Sector" <?php
                                            if ($row['dept'] == "Public Sector") {
                                              echo "selected";  }  ?>>
                Public Sector</option>
              <option value="Staff" <?php
                                    if ($row['dept'] == "Staff") {
                                      echo "selected";  }  ?>>
                staff</option>
              <option value="Employee" <?php
                                        if ($row['dept'] == "Employee") {
                                          echo "selected";  }  ?>>
                Employee</option>
              <option value="Student" <?php
                                      if ($row['dept'] == "Student") {
                                        echo "selected";
                                      }
                                      ?>>
                Student</option>
            </select></label><br>
            <label for="image">Select new :<input type="file" name="image" ></label>
            <img src="image/<?php echo $row['image'] ?>"/>
            <br>
          <button class="btn" name="update" value="update">Update</button>
          <button class="btn" name="update" value="update"><a href="index.php"> </a>Home</button>
      </form>

    </div>
  </div>

</body>

</html>