<?php
include('../admin/connect.php');

$articlesPerPage = 5; // Change to 5 articles per page
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $articlesPerPage;

$query = "SELECT * FROM articles WHERE status='published' ORDER BY id DESC LIMIT $offset, $articlesPerPage";
$result = mysqli_query($conn, $query);

$articles_html = '';
while ($row = mysqli_fetch_assoc($result)) {
    // Generate HTML for articles
    $articles_html .= '<div class="col-md-10 col-lg-8 col-xl-7">';
    $articles_html .= '<div class="post-preview">';
    $articles_html .= '<a href="post.php?id=' . $row['id'] . '">';
    $articles_html .= '<h2 class="post-title">' . $row['title'] . '</h2>';
    $articles_html .= '</a>';
    $articles_html .= '<p class="post-subtitle">';
    
    $string = strip_tags($row['content']); // Remove html tags, ensure to give plain text
    if (strlen($string) > 100) { // Check the string length
        // Truncate string
        $stringCut = substr($string, 0, 100); // Show first 100 characters
        $endPoint = strrpos($stringCut, ' '); // Find the last space in the truncated string
        // If the string doesn't contain any space, it will cut without word basis.
        $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
        $string .= '... <a href="post.php?id=' . $row['id'] . '" class="read-more text-success">Read More</a>';
    }
    
    $articles_html .= $string . '</p>';
    $articles_html .= '<p class="post-meta">Posted<a href="#!"></a> on March 26, 2024</p>';
    $articles_html .= '</div>';
    $articles_html .= '</div>';

}

// Return HTML response
echo $articles_html;
?>
