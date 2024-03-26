<?php
include('../connect.php');
include('../header.php');


// Check if article ID is provided in the URL
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Fetch article details from the database
    $query = "SELECT * FROM articles WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $article = mysqli_fetch_assoc($result);
}

/// Handle form submission for updating article
if(isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $status = $_POST['status'];

    // Escape input variables to prevent SQL injection
    $title_escaped = mysqli_real_escape_string($conn, $title);
    $content_escaped = mysqli_real_escape_string($conn, $content);
    $status_escaped = mysqli_real_escape_string($conn, $status);
    $id_escaped = mysqli_real_escape_string($conn, $id);

    // Construct the SQL query with escaped variables
    $query = "UPDATE articles SET title = '$title_escaped', content = '$content_escaped', status = '$status_escaped' WHERE id = $id_escaped";

    // Execute the query
    if ($conn->query($query) === TRUE) {
        $_SESSION['success_message'] = "Record updated successfully.";
        // header("Location: viewarticle.php?id=$id");
        echo "<script>window.location.href = 'viewarticle.php';</script>";

        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container">
    <h2 class="mt-5 text-center">Update Article</h2>
    <form method="post" action="">
        <input type="hidden" name="id" value="<?php echo $article['id']; ?>">
        <div class="mb-3">
            <label for="title" class="form-label">Title:</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo $article['title']; ?>">
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content:</label>
            <textarea class="form-control" id="content" name="content" rows="5"><?php echo $article['content']; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status:</label>
            <select class="form-select" id="status" name="status">
                
                <option value="published" <?php if(isset($article['status']) && $article['status'] == 'published') echo 'selected'; ?>>
                    Published
                </option>
                <option value="draft" <?php if(isset($article['status']) && $article['status'] == 'draft') echo 'selected'; ?>>
                    draft
                </option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" name="update">Update</button>
    </form>
</div>
    
<!-- Bootstrap JS and jQuery (needed for Bootstrap) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

<!-- Initialize Summernote -->
<script>
$(document).ready(function() {
    $('#content').summernote({
        height: 200
    });
});
</script>

<?php include('../footer.php'); ?>
