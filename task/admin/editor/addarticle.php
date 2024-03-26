<?php
// Include necessary files
include('../connect.php');
include('../header.php');
// Initialize variables to store error messages
$errors = array();
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $title = $_POST['title'];
    $content = $_POST['content'];
    $status = $_POST['status'];

    // Validate form inputs
    if (empty($title)) {
        $errors['title'] = "Please enter a title.";
    }
    if (empty($content)) {
        $errors['content'] = "Please enter content.";
    }
    if (empty($status)) {
        $errors['status'] = "Please select a status.";
    }

    // If there are no errors, proceed with database insertion
    if (empty($errors)) {
        // Sanitize input using mysqli_real_escape_string
        $title = mysqli_real_escape_string($conn, $title);
        $content = mysqli_real_escape_string($conn, $content);
        $status = mysqli_real_escape_string($conn, $status);

        // Construct SQL query
        $query = "INSERT INTO articles (title, content, status) VALUES ('$title', '$content', '$status')";

        // Execute the query
        if (mysqli_query($conn, $query)) {
            echo '<div class="alert alert-success text-center" role="alert">Article added successfully.</div>';
        } else {
            echo "Error adding article: " . mysqli_error($conn);
        }
    }
}

?>


<div class="container mt-5">
    <div class="card p-3">
        <div class="col-md-8 offset-md-2">
            <h2 class="mt-5">Add Article</h2>
            <?php if (!empty($success_message)) { ?>
                <div class="alert alert-success text-center" role="alert">
                    <?php echo $success_message; ?>
                </div>
            <?php } ?>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="title" class="form-label">Title:</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?php echo isset($_POST['title']) ? htmlspecialchars($_POST['title']) : ''; ?>">
                    <span class="error"><?php echo $errors['title'] ?? ''; ?></span>
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Content:</label>
                    <!-- Summernote's textarea -->
                    <textarea class="form-control" id="content" name="content"></textarea>
                    <span class="error"><?php echo $errors['content'] ?? ''; ?></span>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status:</label>
                    <select class="form-select" id="status" name="status">
                        <option value="">Select Status</option>
                        <option value="published"  <?php if(isset($_POST['status']) && $_POST['status'] == 'published') echo 'selected'; ?>>Published</option>
                        <option value="draft"  <?php if(isset($_POST['status']) && $_POST['status'] == 'draft') echo 'selected'; ?>>Draft</option>
                    </select>
                    <span class="error"><?php echo $errors['status'] ?? ''; ?></span>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <?php if (!empty($errors['database'])) { ?>
                <div class="alert alert-danger mt-3" role="alert">
                    <?php echo $errors['database']; ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<!-- Initialize Summernote -->
<script>
$(document).ready(function() {
    $('#content').summernote({
        height: 200
    });
});
</script>

<?php include('../footer.php'); ?>
