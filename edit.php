<?php include 'db.php'; ?>
<?php
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM registrations WHERE id = $id");
$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $event = trim($_POST['event']);

    if ($name && $email && $event) {
        $stmt = $conn->prepare("UPDATE registrations SET participant_name=?, email=?, event_name=? WHERE id=?");
        $stmt->bind_param("sssi", $name, $email, $event, $id);
        if ($stmt->execute()) {
            header("Location: index.php");
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "All fields are required!";
    }
}
?>

<h2>Edit Registration</h2>
<form method="POST">
    <input type="text" name="name" value="<?= $row['participant_name'] ?>" required><br>
    <input type="email" name="email" value="<?= $row['email'] ?>" required><br>
    <input type="text" name="event" value="<?= $row['event_name'] ?>" required><br>
    <button type="submit">Update</button>
</form>
