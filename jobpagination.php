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
                while($row1 = $result1->fetch_assoc()) 
                {
             ?>
		
		<div class="attachment-block clearfix" style="background-color: #0F1A2A; color: #FFFFFF; padding: 10px; border-radius: 4px; display: flex; align-items: center;">
		    <img class="attachment-img" src="uploads/logo/<?php echo $row1['logo']; ?>" alt="Attachment Image" style="max-width: 100px; max-height: 100px; object-fit: cover; margin-right: 10px;">
		    <div class="attachment-pushed" style="flex-grow: 1;">
		        <h4 class="attachment-heading" style="margin: 0 0 5px 0;">
		            <a href="user/view-job-post.php?id=<?php echo $row['id_jobpost']; ?>" style="color: #4A90E2; text-decoration: none;"><?php echo $row['jobtitle']; ?></a> 
		            <span class="attachment-heading pull-right" style="float: right; color: #B0B0B0;">$<?php echo $row['maximumsalary']; ?>/Month</span>
		        </h4>
		        <div class="attachment-text" style="color: #B0B0B0;">
		            <div><strong><?php echo $row1['companyname']; ?> | <?php echo $row1['city']; ?> | Experience <?php echo $row['experience']; ?> Years</strong></div>
		        </div>
		    </div>
		</div>

		<?php
			}
		}
	}
}

$conn->close();


