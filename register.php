<?php
//including the database connection file
include_once("connection.php");

// Fetch municipalities
$municipalities = $conn->query("SELECT id, name FROM tbl_municipalities ORDER BY name ASC");

// Fetch barangays based on selected municipality (handled via AJAX)
if (isset($_POST['municipality_id'])) {
    $municipality_id = $_POST['municipality_id'];
    $barangays = $conn->query("SELECT id, name FROM tbl_barangay WHERE muni_id = '$municipality_id' ORDER BY name ASC");
    $options = "<option value=''>Select Barangay</option>";
    while ($row = $barangays->fetch_assoc()) {
        $options .= "<option value='{$row['id']}'>{$row['name']}</option>";
    }
    echo $options;
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $brgy_id = $_POST['barangay'];

    $query = "INSERT INTO tbl_users (email, password, brgy_id) VALUES ('$email', '$password', '$brgy_id')";
    if ($conn->query($query)) {
        echo "<script>alert('Registration successful!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <script src="jquery-3.6.0.min.js"></script>
</head>
<body>
    <h2>Register</h2>
    <form method="post">
        <label>Email:</label>
        <input type="email" name="email" required><br><br>
        
        <label>Password:</label>
        <input type="password" name="password" required><br><br>
        
        <label>Municipality:</label>
        <select name="municipality" id="municipality" required>
            <option value="">Select Municipality</option>
            <?php while ($row = $municipalities->fetch_assoc()) { ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
            <?php } ?>
        </select><br><br>
        
        <label>Barangay:</label>
        <select name="barangay" id="barangay" required>
            <option value="">Select Barangay</option>
        </select><br><br>
        
        <button type="submit" name="register">Register</button>
    </form>

    <br>
    <a href="index.php">Log In</a>

    <script>
        $(document).ready(function () {
            $('#municipality').change(function () {
                var municipality_id = $(this).val();
                $.post('register.php', { municipality_id: municipality_id }, function (data) {
                    $('#barangay').html(data);
                });
            });
        });
    </script>
</body>
</html>
