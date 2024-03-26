<?php include('header.php'); ?>

<!-- Main Content-->

<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center" id="articles-container">
        <h1 class="post-title text-center"><u>Blogs</u></h1>
        <?php
        include('../admin/connect.php');

        $articlesPerPage = 5; // Change to 5 articles per page
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
        $offset = ($page - 1) * $articlesPerPage;

        $query = "SELECT * FROM articles WHERE status='published' ORDER BY id DESC LIMIT $offset, $articlesPerPage";
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            // Generate HTML for articles
            echo '<div class="col-md-10 col-lg-8 col-xl-7">';
            echo '<div class="post-preview">';
            echo '<a href="post.php?id=' . $row['id'] . '">';
            echo '<h2 class="post-title">' . $row['title'] . '</h2>';
            echo '</a>';
            echo '<p class="post-subtitle">';
            
            $string = strip_tags($row['content']); // Remove html tags, ensure to give plain text
            if (strlen($string) > 100) { // Check the string length
                // Truncate string
                $stringCut = substr($string, 0, 100); // Show first 100 characters
                $endPoint = strrpos($stringCut, ' '); // Find the last space in the truncated string
                // If the string doesn't contain any space, it will cut without word basis.
                $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                $string .= '... <a href="post.php?id=' . $row['id'] . '" class="read-more text-success">Read More</a>';
            }
            
            echo $string . '</p>';
            echo '<p class="post-meta">Posted<a href="#!"></a> on March 26, 2024</p>';
            echo '</div>';
            echo '</div>';
        }
        ?>

    </div>
    <!-- Pager-->
    <div class="d-flex justify-content-end mb-4" id="load-more-btn"><a class="btn btn-primary text-uppercase" href="javascript:void(0)">Older Blogs →</a></div>
    <div class="alert alert-info text-center" role="alert"  id="no-more-articles" style="display: none;">No more articles</div>
</div>

<?php include('footer.php'); ?>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        var page = 2; // Initial page number for loading more articles
        var loading = false;

        $('#load-more-btn').click(function () {
            if (loading) return; // Prevent loading if already loading
            loading = true;
            $.ajax({
                url: 'load_more_articles.php', // PHP script to handle AJAX request for more articles
                type: 'GET',
                data: {
                    page: page
                },
                dataType: 'html', // Expect HTML data type for the response
                success: function (response) {
                    if (response.trim() !== '') {
                        $('#articles-container').append(response); // Append new articles to the container
                        page++; // Increment page number
                    } else {
                        $('#load-more-btn').hide(); // Hide the button if no more articles to load
                        $('#no-more-articles').show(); // Show the indicator for no more articles
                    }
                    loading = false;
                }
            });
        });
    });
</script>
