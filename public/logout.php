<?php

require_once 'class.user.php';

$user = new USER();

if(!$user->is_logged_in())
{
	return redirect('');
}

$user->logout();
return redirect('');