<?php
/*
 *      tester_user_login.php
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
		<title>Tester for User objects' Login method</title>
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
		Can we Login as 'Admin' // 'test' ?&nbsp;&nbsp;
<?php
	$int_loginResult = (int) $object_user->Login('Admin', 'test');

	if( $int_loginResult === 1 ) {
		echo( "		<strong><em><font color=\"green\">Yes!</font></em></strong>\n<br>" );
	} else {
		echo( "		<strong><em><font color=\"red\">Nope!</font></em></strong>\n<br>" );
		echo( "		<strong><em><font color=\"red\">Login errorcode: " . $int_loginResult . "</font></em></strong>\n<br>" );
	}// end if
?>
		<em><u>No tests (Should all be no)</u></em><br>
		Can we Login as 'NoUser' // 'doesntmatter' ?&nbsp;&nbsp;
<?php
	$int_loginResult = (int) $object_user->Login('NoUser', 'doesntmatter');

	if( $int_loginResult === 1 ) {
		echo( "		<strong><em><font color=\"red\">Yes!</font></em></strong>\n<br>" );
	} else {
		echo( "		<strong><em><font color=\"green\">Nope!</font></em></strong>\n<br>" );
		echo( "		<strong><em><font color=\"green\">Login errorcode: " . $int_loginResult . "</font></em></strong>\n<br>" );
	}// end if
?>
	</body>

</html>
