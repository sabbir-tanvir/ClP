<!DOCTYPE html>
<html>

<head>
  <title>Your Form</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

  <?php

  define("HOSTNAME", "localhost");
  define("USERNAME", "root");
  define("PASSWORD", "5sabbirSaba");
  define("DATABASE_NAME", "online_quiz");
  $conn = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE_NAME);


  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  if (isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];

    $sql = "DELETE FROM student WHERE id='$id'";
    $run = mysqli_query($conn, $sql);

    if ($run) {
      echo "<h1>Data Deleted</h1>";
      header("Location: index.php"); 
      exit();
    } else {
      echo "<h1>Data not Deleted</h1>";
    }
  }
  ?>

  <div class="form-container">
    <form action="data_insert.php" method="POST" style="background-color: #f0f0f0; padding: 30px; border-radius: 5px; width: 400px; margin: 20px;">
      <label for="name">Name:</label><br>
      <input type="text" id="name" name="name" style="width: 94%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 4px;"><br>

      <label for="dept">Dept.:</label><br>
      <input type="text" id="dept" name="dept" style="width: 94%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 4px;"><br>
      <div class="btn">
        <input type="submit" class="button" value="Submit">

      </div>
    </form>
  </div>
  <br>
  <br>

  <div class="output">
    <?php

    $sql = "SELECT * FROM student"; 

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {

      echo "<table>";
      echo "<tr><th>ID</th><th>Student Name</th><th>Student Dept.</th><th>Edit</th><th>Delete</th></tr>";

      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>"; 
        echo "<td>" . $row["name"] . "</td>"; 
        echo "<td>" . $row["dept"] . "</td>"; 
        echo "<td><a href='edit.php?id=" . $row["id"] . "'>Edit</a></td>"; 
        echo "<td><a href='index.php?deleteid=" . $row["id"] . "' onclick=\"return confirm('Are you sure you want to delete this record?');\">Delete</a></td>"; 
        echo "</tr>";
      }

      echo "</table>";
    } else {
      echo "No students found";
    }

    mysqli_close($conn);
    ?>
  </div>
</body>

</html>