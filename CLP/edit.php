<?php
define("HOSTNAME", "localhost");
define("USERNAME", "root");
define("PASSWORD", "5sabbirSaba");
define("DATABASE_NAME", "online_quiz");
$conn = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE_NAME);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$name = "";
$dept = "";
$updateid = 0;

if (isset($_GET['id'])) {
    $updateid = $_GET['id'];


    $sql = "SELECT * FROM student WHERE id=$updateid";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $name = $row['name'];
        $dept = $row['dept'];
    } else {
        echo "Student not found!";
        exit();
    }
} else {
    echo "Invalid student ID";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $dept = $_POST['dept'];
    $updateid = $_POST['updateid'];

    $sql = "UPDATE student SET name='$name', dept='$dept' WHERE id=$updateid";
    $run = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if ($run) {
        header("Location: index.php");
        exit();
    } else {
        echo "<h1>Error Updating Data</h1>";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Student</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div class="form-container">
        <form action="edit.php?id=<?php echo $updateid; ?>" method="POST" style="background-color: #f0f0f0; padding: 30px; border-radius: 5px; width: 400px; margin: 20px;">
            <input type="hidden" name="updateid" value="<?php echo $updateid; ?>">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>" style="width: 94%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 4px;"><br>

            <label for="dept">Dept.:</label><br>
            <input type="text" id="dept" name="dept" value="<?php echo $dept; ?>" style="width: 94%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 4px;"><br>
            <div class="btn">
                <input type="submit" class="button" value="Update">

            </div>
        </form>
    </div>
</body>

</html>