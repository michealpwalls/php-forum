<!DOCTYPE html>

<?php
/*
 * index.php -			mpw-forum v0.1
 * 
 * 		Description:	Very simple web forum. A throwback to the
 * 						Bulletin Board Systems of the past.
 * 						Organized into Topics and Topic Comments.
 * 
 * Copyright 2013 Micheal Walls <michealpwalls@gmail.com>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 * 
 * 
 */
?>

<html lang="en">

	<head>
		<title>Micheal Walls' Forum</title>
		<meta charset="UTF-8">
		<meta name="generator" content="Geany 0.20">
	</head>

	<body>
		<article>
			
			<!-- START: User Navigation -->
			<section title="User Navigation">
<?php

// Include the Validator library for user-input validation
include_once( "lib/validator.php" );

// Instantiate the User object
include( "user.php" );
$object_user = new User();

// Draw the user navigation
if( $object_user->isLoggedIn() ) {
?>
				<nav id="userNavigation">
					<ul>
						<li><a href="index.php?doAction=updateprofile&uid=<?=$object_user->getUID();?>">Edit your Profile</a></li>
						<li><a href="index.php?doAction=logout">Logout</a></li>
					</ul>
				</nav>
<?php
} else {
?>
				<nav id="userNavigation">
					<form method="POST" action="index.php?doAction=login">
						<label for="login-username" required>Username:</label>
						<input type="text" name="login-username">
						<label for="login-password">Password:</label>
						<input type="password" name="login-password" required>
						<input type="submit" value="Login"> or <a href="index.php?doAction=register">Register</a>
					</form>
				</nav>
<?php
}// end if
?>
			</section>
			<!-- END: User Navigation -->
			
			<!-- START: Forum Content -->
			<section title="Forum">
<?php
if( isset($_GET['doAction']) ) {
	if( file_exists("./actions/" . $_GET['doAction'] . ".action.php") ) {
		include_once( "actions/" . $_GET['doAction'] . ".action.php" );
	} else {
		include_once( "actions/notfound.action.php" );
	}// end if
} else {
	// Instantiate the Forum object
	include_once( "forum.php" );
	$object_forum = new Forum();
	$object_forum->showTopics();
}// end if
?>
			</section>
			<!-- END: Forum Content -->
			
			<!-- START: Footer -->
			<section title="Footer (Copyright information)">
				
			</section>
			<!-- END: Footer -->
			
		</article>
	</body>

</html>
