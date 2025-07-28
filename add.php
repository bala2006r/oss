<?php include 'db.php'; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $event = trim($_POST['event']);

    if ($name && $email && $event) {
        $stmt = $conn->prepare("INSERT INTO registrations (participant_name, email, event_name) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $event);
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

<h2>Add Registration</h2>
<form method="POST">
    <input type="text" name="name" placeholder="Full Name" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="text" name="event" placeholder="Event Name" required><br>
    <button type="submit">Register</button>
</form>
