<?php
session_start();

require_once("db.php");

$limit = 4;

if(isset($_GET["page"])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

$start_from = ($page-1) * $limit;

$sql = "SELECT * FROM job_post LIMIT $start_from, $limit";
$result = $conn->query($sql);

if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $sql1 = "SELECT * FROM company WHERE id_company='$row[id_company]'";
        $result1 = $conn->query($sql1);
        if($result1->num_rows > 0) {
            $row1 = $result1->fetch_assoc();
            ?>
            <div class="attachment-block clearfix" style="background-color: #0F1A2A; color: #FFFFFF; padding: 15px; border-radius: 4px; margin-bottom: 15px; box-shadow: 0 1px 3px rgba(0,0,0,0.12);">
                <div class="row">
                    <div class="col-md-2">
                        <img class="attachment-img img-responsive" src="uploads/logo/<?php echo $row1['logo']; ?>" alt="Company Logo" style="max-width: 100%; max-height: 80px; object-fit: contain;">
                    </div>
                    <div class="col-md-10">
                        <h4 class="attachment-heading">
                            <a href="view-job-post.php?id=<?php echo $row['id_jobpost']; ?>" style="color: #4A90E2;"><?php echo $row['jobtitle']; ?></a> 
                            <span class="attachment-heading pull-right">$<?php echo $row['maximumsalary']; ?>/Month</span>
                        </h4>
                        <div class="attachment-text" style="color: #B0B0B0; margin-top: 5px;">
                            <div><strong><?php echo $row1['companyname']; ?> | <?php echo $row1['city']; ?> | Experience <?php echo $row['experience']; ?> Years</strong></div>
                            <div style="margin-top: 10px;">
                                <?php echo substr($row['description'], 0, 150) . '...'; ?>
                            </div>
                            <div style="margin-top: 10px;">
                                <a href="view-job-post.php?id=<?php echo $row['id_jobpost']; ?>" class="btn btn-primary btn-sm">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
} else {
    echo '<div class="alert alert-info text-center">No job posts available at this time.</div>';
}

$conn->close();
?>
