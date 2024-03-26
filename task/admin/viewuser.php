<?php 

include('connect.php');

if (isset($_POST['delete'])) {
    include('../admin/connect.php');

    $id = $conn->real_escape_string($_POST['delete']);
    $sql = "DELETE FROM usertable WHERE id = $id";
    
    if ($conn->query($sql) === TRUE) {
        // Set success message in session
        $_SESSION['success_message'] = "Record deleted successfully.";
    } else {
        // Set error message in session
        $_SESSION['error_message'] = "Error deleting record: " . $conn->error;
    }

    // Redirect after the DELETE operation is complete
    header("Location: ".$admin_url."viewuser.php");
    exit(); // Stop script execution after redirection
}
include('header.php');
?>

<div class="card">
<h2 class="text-center mt-5">List Of User Details</h2>

<div class="table-container p-4">
<?php
if (isset($_SESSION['success_message'])) {
    echo '<div class="alert alert-success" role="alert">';
    echo $_SESSION['success_message'];
    echo '</div>';

    // Remove success message from session to avoid displaying it again
    unset($_SESSION['success_message']);
}
if(isset($_SESSION['update_success_message'])): ?>
    <div class="alert alert-success"><?php echo $_SESSION['update_success_message']; ?></div>
    <?php unset($_SESSION['update_success_message']); ?>
<?php endif;


$sql = "SELECT * FROM usertable ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $counter = 1; // Initialize counter
    echo "<form method='post'>";
    echo "<table class='table table-bordered p-5'>";
    echo "<thead class='thead-dark'>";
    echo "<tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>role</th>
        <th>status</th>
        <th>Action</th>
    </tr>";
    echo "</thead>";
    
    echo "<tbody>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $counter++ . "</td>";
        echo "<td>" . $row["user_name"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["role"] ."</td>";
        echo "<td>" . $row["status"] ."</td>";

        echo "<td>
                <button type='button' onclick='redirectToUpdate(".$row['id'].")' class='btn btn-info'>Update</button>
                <button type='submit' name='delete' class='btn btn-warning' value='".$row['id']."' onclick='return confirmDelete()'>Delete</button>
              </td>";
        echo "</tr>";
    }
    
    echo "</tbody>"; 
    echo "</table>";
    echo "</form>";
} else {
    echo "0 results";
}

$conn->close();
?>
</div>
</div>

<?php include('footer.php'); ?>

<script>
function redirectToUpdate(id) {
    window.location.href = 'update.php?id=' + id;
}

function confirmDelete() {
    return confirm("Are you sure you want to delete this user?");
}
</script>
