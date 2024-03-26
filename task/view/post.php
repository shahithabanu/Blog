<?php include('header.php');

if(isset($_GET['id'])) {
    $article_id = $_GET['id'];
    
    // Fetch article details from the database based on the ID
    $query = "SELECT * FROM articles WHERE id = $article_id";
    $result = mysqli_query($conn, $query);
    
    if(mysqli_num_rows($result) > 0) {
        $article = mysqli_fetch_assoc($result);
    } else {
        echo "Article not found.";
        exit(); // Stop script execution
    }
} else {
    echo "Article ID not provided.";
    exit(); // Stop script execution
}

$msg ='';
// Handle user feedback submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize user input
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);
    
    // Insert user feedback into the database
    $insertQuery = "INSERT INTO feedback (article_id, name, comment) VALUES ('$article_id', '$name', '$comment')";
    if(mysqli_query($conn, $insertQuery)) {
        $msg= '<div class="alert alert-success text-center">Thank you for your feedback!</div>';
    } else {
        $msg= '<div class="alert alert-danger">Error submitting feedback. Please try again later.</div>';
    }
}

?>
        <!-- Post Content-->
        <article class="mb-4">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-8">
                   <?php if(  $msg !=""){ echo $msg ; } ?>
                    <h2 class="post-title"> <?php echo $article['title']; ?></h2>
                    <p class="card-text mt-5" ><?php echo $article['content']; ?></p>

                    </div>
                </div>
            </div>
        </article>


        <div class="container mt-5">
    <div class="col-md-8 offset-md-2">
        <div class="card p-4">
            <h3 class="text-center mb-4">Leave a Comment</h3>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $article_id; ?>">
                <div class="mb-3">
                    <label for="name" class="form-label">Your Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="comment" class="form-label">Comment:</label>
                    <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

 <?php include('footer.php'); ?>
