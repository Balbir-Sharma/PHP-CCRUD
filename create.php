<?php include 'config.php'; ?>

<?php
// define variables and set to empty values
$nameErr = $emailErr = $passwordErr = $phoneErr = $addressErr = $genderErr =  $dobErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {

        if (empty($_POST["Empname"])) {
            $nameErr = "Name is required";
        } else {
            $Empname = test_input($_POST["Empname"]);
        }

        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            $email = test_input($_POST["email"]);
        }
        if (empty($_POST["password"])) {
            $passwordErr = "Password is required";
        } else {
            $password = test_input($_POST["password"]);
        }
        if (empty($_POST["phone"])) {
            $phoneErr = "Phone is required";
        } else {
            $phone = test_input($_POST["phone"]);
        }
        if (empty($_POST["address"])) {
            $addressErr = "Address is required";
        } else {
            $address = test_input($_POST["address"]);
        }
        if (empty($_POST["dob"])) {
            $dobErr = "This field is required";
        } else {
            $dob = test_input($_POST["dob"]);
        }


        // Check if the hobbies array is set
        if (isset($_POST["chk_hobby"])) {
            // Get the selected hobbies
            $selectedHobbies = $_POST["chk_hobby"];

            // Serialize the array into a comma-separated string
            $hobbiesString = implode(",", $selectedHobbies);
        }
        if ($nameErr == '' && $emailErr == '' && $passwordErr == '' && $phoneErr == '' && $addressErr == '' && $genderErr == '' && $dobErr == '') {

            // Check connection
            if ($conn === false) {
                die("ERROR: Could not connect. "
                    . mysqli_connect_error());
            }

            $name =  $_POST['Empname'];
            $email =  $_POST['email'];
            $pass = $_POST['password'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $gender = $_POST['gender'];
            $dob = $_POST['dob'];
            $dept = $_POST['dept'];

            $image = $_FILES["image"]["name"];
            $tempname = $_FILES["image"]["tmp_name"];
            $folder = "./image/" . $image;
    
            if (move_uploaded_file($tempname, $folder)) {
                echo "<h3>  Image uploaded successfully!</h3>";
            } else {
                echo "<h3>  Failed to upload image!</h3>";
            }

            // here our table name is empcon
            $sql = "INSERT INTO `empcon` (`name`,`email`,`password`,`phone`,`address`,`gender`,`chk_hobby`,dob,`dept`,`image`) VALUES ('$name','$email','$pass','$phone','$address','$gender','$hobbiesString','$dob','$dept','$image')";
            if (mysqli_query($conn, $sql)) {
                //   print_r($gender);
                //    exit();
                header("Location: index.php");
            }
        }

        // Close connection
        // mysqli_close($conn);
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Register</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        table {
            border-collapse: collapse;
            margin-left: 10%;
            margin-top: 1%;
        }

        th,
        td {
            border: 1px solid orange;
            padding: 10px;
            text-align: center;
        }

        th {
            text-align: center;
        }

        h4 {
            text-align: center;
            margin-top: 5ch;
        }

        h3 {
            text-align: center;
        }

        .error {
            color: #FF0000;
        }

        .modal-title {
            text-align: center;
            justify-content: center;
            background-color: aquamarine;
            margin-left: 20%;
            padding-left: 5ch;
            padding-right: 5ch;
            padding-top: 1ch;
            padding-bottom: 1ch;
        }
    </style>
</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


<body>

    <div class="modal-body">
        <main>
            <form class="container-centre" id="centre" action="" method="POST" enctype="multipart/form-data">
                <h3>Sign Up</h3>
                <!-- <p><span class="error">* required field</span></p> -->
                <div class="col-md-">
                    <label for="username" class="form-label">Your Name: </label>
                    <input type="text" name="Empname" id="username">
                    <br><span class="error">* <?php echo $nameErr; ?></span>

                </div><br>
                <div class="col-md-10">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email">
                    <br> <span class="error">* <?php echo $emailErr; ?></span>

                </div><br>
                <div class="col-md-12">
                    <label for="password" class="form-label">Password</label>
                    <input type="text" name="password" id="password">
                    <br><span class="error">* <?php echo $passwordErr; ?></span>

                </div><br>
                <div class="col-md-12">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="number" name="phone" id="phone">
                    <br><span class="error">* <?php echo $phoneErr; ?></span>
                </div><br>
                <div class="col-md-12">
                    <label for="Address" class="form-label">Address</label>
                    <textarea name="address" class="form-control" rows="2" cols="30"></textarea>
                    <br><span class="error">* <?php echo $addressErr; ?></span>

                </div><br>

                <div class="col-12">
                    <label for="Gender"> Choose Your Gender : </label>
                    <label for="Male" class="form-label"> <input type="radio" name="gender" id="male" value="Male">Male</label>
                    <label for="Female" class="form-label"> <input type="radio" name="gender" id="female" value="Female">Female</label>
                    <label for="Other" class="form-label"> <input type="radio" name="gender" id="Other" value="Other">Other</label>
                    <br><span class="error">* <?php echo $genderErr; ?></span>
                </div><br>
                <div class="col-10">
                    <label for="dob" class="form-label">Enter Your Date of Birth</label>
                    <input type="date" class="form-control" name="dob" id="dob">
                    <br><span class="error">* <?php echo $dobErr; ?></span>
                </div><br>
                <div class="col-10">
                    <label for="Hobbies" class="form-label">Hobbies</label><br>
                    <input type="checkbox" name="chk_hobby[]" id="chk_hobby" value='reading'>Reading<br>
                    <input type="checkbox" name="chk_hobby[]" id="chk_hobby" value='Playing'>Playing<br>
                    <input type="checkbox" name="chk_hobby[]" id="chk_hobby" value='Swimming'>Swimming<br>
                </div><br>

                <div class="col-md-6">
                    <label for="Depart" class="form-label">Select Department</label>
                    <select name="dept" class="form-control" id="dept">
                        <option value="">Select</option>
                        <option value="Public Sector">Public Sector</option>
                        <option value="Employee">Employee</option>
                        <option value="Student">Student</option>
                        <option value="Staff">Staff</option>
                    </select>
                </div><br>
                
                <div class="col-10">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" name="image" id="image" value="" >
                </div><br>


                <button type="submit" class="btn btn-primary" value="Submit" name="submit">Register</button>

            </form>
            
         
            <?php
            if (isset($_POST['submit'])) {

                if (!empty($_POST['chk_hobby'])) {

                    foreach ($_POST['chk_hobby'] as $value) {
                        echo "value : " . $value . '<br/>';
                    }
                }
            }
            ?>

          


        </main>
    </div>
</body>

</html>