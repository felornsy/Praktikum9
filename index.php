<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "karyawan";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if (isset($_GET['delete'])) {
    $sql = "DELETE FROM karyawan WHERE id=".$_GET['delete'];

if ($conn->query($sql) === TRUE) {
  echo "Record deleted successfully";
  header('Location: '.$_SERVER['PHP_SELF']);
} else {
  echo "Error deleting record: " . $conn->error;
}
}

if (count($_POST)) {
    $sql = "INSERT INTO karyawan (name, email, address, gender, position, status)
    VALUES ('".$_POST['name']."', '".$_POST['email']."', '".$_POST['address']."', '".$_POST['gender']."', '".$_POST['position']."', '".$_POST['status']."')";

    if (mysqli_query($conn, $sql)) {
      echo "New record created successfully";
      header('Location: '.$_SERVER['PHP_SELF']);
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

$sql = "SELECT id, name, email, address, gender, position, status FROM karyawan";
$result = $conn->query($sql);
$conn->close();
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Praktikum 9</title>
  </head>
  <body>
    <div class="container row">
        <div class="col-12">
            <h1 class="text-center">Praktikum 9</h1>
        <table class="table table-success table-striped">
        <tr>
            <th>
                #
            </th>
            <th>
                name
            </th>
            <th>
                email
            </th>
            <th>
                address
            </th>
            <th>
                gender
            </th>
            <th>
                position
            </th>
            <th>
                status
            </th>
            <th>action</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['name']."</td>";
            echo "<td>".$row['email']."</td>";
            echo "<td>".$row['address']."</td>";
            echo "<td>".$row['gender']."</td>";
            echo "<td>".$row['position']."</td>";
            echo "<td>".$row['status']."</td>";
            echo "<td><a href='?delete=".$row['id']."' class='btn btn-danger me-md-2'>Delete</a></td>";
            echo "</tr>";
        }
        }
        ?>

        </table>
        <form action="?" method="post">
        <div class="mb-3">
            <label for="exampleInputName" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="exampleInputName">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputAddress" class="form-label">Address</label>
            <input type="text" name="address" class="form-control" id="exampleInputAddress">
        </div>
        <div class="mb-3">
            <label for="exampleInputGender" class="form-label">Gender</label>
            <select class="form-select" name="gender" aria-label="Default select example">
            <option value="Female">Female</option>
            <option value="Male">Male</option>
        </select>
        </div>
        <div class="mb-3">
            <label for="exampleInputPosition" class="form-label">Position</label>
            <input type="text" name="position" class="form-control" id="exampleInputPosition">
        </div>
        <div class="mb-3">
            <label for="exampleInputStatus" class="form-label">Status</label>
            <select class="form-select" name="status" aria-label="Default select example">
            <option value="Fulltime">Fulltime</option>
            <option value="Parttime">Parttime</option>
            <option value="Intern">Intern</option>
        </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>