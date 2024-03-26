<?php
include('connect.php');
include('header.php');


?>

<!-- Fetch and Display User Feedback in Table Format -->
<div class="container mt-5">
    <div class="col-md-10 offset-md-1">
        <div class="card p-4">
            <h3 class="text-center mb-4">Users Feedback</h3>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Article</th>
                            <th>Name</th>
                            
                            <th>Comment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fetch user feedback from the database
                        $sql = "SELECT f.*,a.title FROM feedback f left join articles a on  a.id = f.article_id  ";
                        $result = $conn->query($sql);

                        // Check if any feedback is found
                        if ($result->num_rows > 0) {
                            // Output data of each row
                            $count = 1;
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $count . "</td>";
                                echo "<td>" . $row['title'] . "</td>";
                                echo "<td>" . $row['name'] . "</td>";
                         
                                echo "<td>" . $row['comment'] . "</td>";
                                echo "</tr>";
                                $count++;
                            }
                        } else {
                            echo "<tr><td colspan='3'>No feedback found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include('../admin/footer.php'); ?>
