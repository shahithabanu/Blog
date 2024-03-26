<?php
// Include necessary files
include('../connect.php');
include('../header.php');



// Fetch articles from the database
$query = "SELECT * FROM articles order by id desc";
$result = mysqli_query($conn, $query);

if(isset($_POST['delete'])){
    $id = $conn->real_escape_string($_POST['delete']);
    $sql = "DELETE FROM articles WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['success_message'] = "Record deleted successfully";
        // Redirect after the DELETE operation is complete
        echo '<script>window.location.href = "viewarticle.php";</script>';

        exit(); // Stop script execution after redirection
    } else {
        $_SESSION['error_message'] = "Error deleting record: " . $conn->error;
    }
}
?>
 <?php if(isset($_SESSION['success_message'])): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $_SESSION['success_message']; ?>
                </div>
                <?php unset($_SESSION['success_message']); // Clear the session variable ?>
            <?php endif; ?>

<div class="container">
    <div class="card p-5">
        <h2 class="text-center">View Articles</h2>
        <div class="table-responsive p-3">
            <table class="table table-bordered p-5">
                <thead class="thead-dark">
                    <tr>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch and display data in table rows
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['title'] . "</td>";
                        echo "<td>" . $row['status'] . "</td>";
                        echo "<td>
                                <form method='post' onsubmit='return confirmDelete()' action=''>
                                    <button type='button' onclick='redirectToUpdate(" . $row['id'] . ")' class='btn btn-info'>Update</button>
                                    <button type='submit' name='delete' class='btn btn-warning' value='" . $row['id'] . "'>Delete</button>
                                </form>
                              </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Bootstrap JS and jQuery (needed for Bootstrap) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

<script>
    function redirectToUpdate(id) {
        // Redirect to the update page with the ID parameter
        window.location.href = 'updatearticle.php?id=' + id;
    }

    function confirmDelete() {
        return confirm('Are you sure you want to delete this article?');
    }
</script>

</body>
</html>

<?php include('../footer.php'); ?>

