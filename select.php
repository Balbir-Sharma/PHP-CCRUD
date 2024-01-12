<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Register</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
  table {
    border-collapse: collapse;
    margin-left: 10%;
    margin-top: 1%;
  }
  th, td {
    border: 1px solid orange;
    padding: 10px;
    text-align: center;
  }
  th{
    text-align: center;
  }
  h4{
    text-align: center;
    margin-top: 5ch;
  }
</style>
<body>
    <i><h4 >Welcome to Company Details</h4></i>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<div class="centre"><br>
    <table border ="1"  style="border-collapse:collapse;">
    <thead>
        <tr>
            <th>Name</th>
            <th>Id</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Gender</th>
            <th>Hobbies</th>
            <th>D.O.B.</th>
            <th>Dept</th>
            <th>Image</th>
            <th>Action</th>
       </tr>
    </thead>
    <tbody>
    <?php
        $sql = "SELECT * FROM `empcon`";
        $result = mysqli_query($conn,$sql);
        if($result){
        $row = mysqli_fetch_assoc($result);
        while($row = mysqli_fetch_assoc($result)){
            $name = $row['name'];
            $id = $row['id'];
            $email = $row['email'];
            $phone= $row['phone'];
            $address= $row['address'];
            $gender= $row['gender'];
            $hobbies= $row['chk_hobby'];
            $dob = $row['dob'];
            $dept = $row['dept'];
            $image = $row['image'];
            echo '<tr>
            <td>'.$name.'</td>
            <td>'.$id.'</td>
            <td>'.$email.'</td>
            <td>'.$phone.'</td>
            <td>'.$address.'</td>
            <td>'.$gender.'</td>
            <td>'.$hobbies.'</td>
            <td>'.$dob.'</td>
            <td>'.$dept.'</td>
            <td>'.$image.'</td>
            <td>
                   <button><a href="delete.php?deleteid='.$id.'">Delete</a></button>
                   <button><a href="update.php?updateid='.$id.'">Update</a></button>
        </td>
            </tr>';
        }
        }
    ?>
    </tbody>
    </table>
</div>

</body>
</html>
