<?php include('header.php'); ?>
<?php

// Fetch articles from the database
$query = "SELECT * FROM articles WHERE status='published' ORDER BY id DESC LIMIT 6";
$result = mysqli_query($conn, $query);
?>

<!-- Main Content-->
<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
            <h1 class="post-title"><u>Latest Blogs</u></h1>

            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <!-- Post preview-->
                <div class="post-preview">
                    <a href="<?php echo $url ?>post.php?id=<?php echo  $row['id'] ?>">
                        <h2 class="post-title"><?php echo $row['title']; ?></h2>   
                    </a>
                    <p class="post-subtitle"><?php
                        $string = strip_tags($row['content']); // Remove html tags, ensure to give plain text
                        if (strlen($string) > 100) { // Check the string length
                            // Truncate string
                            $stringCut = substr($string, 0, 100); // Show first 100 characters
                            $endPoint = strrpos($stringCut, ' '); // Find the last space in the truncated string
                            // If the string doesn't contain any space, it will cut without word basis.
                            $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                            $string .= '...<a class="read-more" href="post.php?id=' . $row['id'] . '" class="text-success">Read More</a>';
                        }
                        echo $string;
                        ?></p>
                    <p class="post-meta">
                        Posted
                        on <?php echo date("F j, Y", strtotime($row['created_at'])); ?> <!-- Displaying created date -->
                    </p>
                </div>
            <?php } ?>

            <!-- Pager-->
            <div class="d-flex justify-content-end mb-4">
                <a class="btn btn-primary text-uppercase" href="<?php echo $url ?>view.php">View All blogs →</a>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>
