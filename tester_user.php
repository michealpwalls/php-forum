<?php
/*
 *      tester_user.php
 *      
 *      Copyright 2013 Micheal Walls <michealpwalls@gmail.com>
 *      
 *      This program is free software; you can redistribute it and/or modify
 *      it under the terms of the GNU General Public License as published by
 *      the Free Software Foundation; either version 2 of the License, or
 *      (at your option) any later version.
 *      
 *      This program is distributed in the hope that it will be useful,
 *      but WITHOUT ANY WARRANTY; without even the implied warranty of
 *      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *      GNU General Public License for more details.
 *      
 *      You should have received a copy of the GNU General Public License
 *      along with this program; if not, write to the Free Software
 *      Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 *      MA 02110-1301, USA.
 *      
 *      
 */

?>
<!DOCTYPE html>

<html lang="en">

	<head>
		<title>Tester for User objects</title>
		<meta charset="UTF-8">
		<meta name="generator" content="Geany 0.20">
	</head>

	<body>
		<em><u>Yes tests (Should all be yes)</u></em><br>
<?php
	include( "validator.php" );
	include( "user.php" );
	$object_user = new User();
?>
		Can we get our Username?&nbsp;&nbsp;
<?php
	echo( "		<strong><em><font color=\"green\">" . $object_user->getUsername() . "</font></em></strong>\n<br>" );
?>
		<p>
			<br>Test the <a href="tester_user_login.php">Login</a> method now!
		</p>
	</body>
</html>
