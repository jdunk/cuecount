<?php

require('db_conn3.php');
$result = mysqli_query($conn3,"SELECT id FROM decision_post ORDER BY id DESC LIMIT 1");
while($row=mysqli_fetch_assoc($result)) {
	foreach ($result as $row) {
		$highest_id = $row['id']+1;
	}
}