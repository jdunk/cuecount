<?php
	$conn3 = mysqli_connect("localhost","cuecount_wp653","cuecount123$","cuecount_proto") or die('error');
	$result = mysqli_query($conn3,"SELECT id FROM decision_post ORDER BY id DESC LIMIT 1");
    while($row=mysqli_fetch_assoc($result)) {	
		foreach ($result as $row) {
    		$highest_id = $row['id']+1;
		}
	}
?>