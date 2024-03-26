<?php
include('connect.php');
include('header.php');


$sql = "SELECT COUNT(*) AS user_count FROM usertable";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_count = $row['user_count'];
} else {
    $user_count = 0; 
} 

//articl
$sql_article_count = "SELECT COUNT(*) AS article_count FROM articles";
$result_article_count = $conn->query($sql_article_count);

if ($result_article_count->num_rows > 0) {
    $row_article_count = $result_article_count->fetch_assoc();
    $article_count = $row_article_count['article_count'];
} else {
    $article_count = 0; 
} 

//feedback

$sql_feedback_count = "SELECT COUNT(*) AS feedback_count FROM feedback";
$result_feedback_count = $conn->query($sql_feedback_count);

if ($result_feedback_count->num_rows > 0) {
    $row_feedback_count = $result_feedback_count->fetch_assoc();
    $feedback_count = $row_feedback_count['feedback_count'];
} else {
    $feedback_count = 0; 
}
?>

<div class="container-fluid">
<div class="row">
    <div class="col-md-4 mt-5">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Total Users</h5>
                <h3 class="card-text"><?php echo $user_count; ?></h3>
            </div>
        </div>
    </div>
    <div class="col-md-4 mt-5">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Total Articles</h5>
                <h3 class="card-text"><?php echo $article_count; ?></h3>
            </div>
        </div>
    </div>
    <div class="col-md-4 mt-5">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Total feedback</h5>
                <h3 class="card-text"><?php echo $feedback_count; ?></h3>
            </div>
        </div>
    </div>
</div>
</div>





<?php include('footer.php'); ?>

<!-- Bootstrap Bundle with Popper -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
