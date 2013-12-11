<?php
/*
 *      tester_user_register.php
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
		<title>Tester for User objects' Register method</title>
		<meta charset="UTF-8">
		<meta name="generator" content="Geany 0.20">
	</head>

	<body>
		<em><u>No tests (Should all be No)</u></em><br>
<?php
	include( "validator.php" );
	include( "user.php" );
	$object_user = new User();
?>
		Can we Register a new user with the following information?<br>
		Username: "NewUserTest"<br>
		GID: 0<br>
		Password: "test"<br>
		Email: "test@testdomain.co.uk"<br>
		Sex: 'M'<br>
		BirthDate: "2013-11-10"<br>
		FirstName: "test"<br>
		LastName: "test"<br>
		Postal Code: "A5M-7M2" ..........
<?php
	$int_registrationResult = (int) $object_user->Register("NewUserTest",0,"test","test@testdomain.co.uk","M","2013-11-10","test","test","A5M-7M2");
	
	if( $int_registrationResult === 1 ) {
		echo( "		<strong><em><font color=\"red\">Yes!</font></em></strong><br>\n" );
	} else {
		echo( "		<strong><em><font color=\"green\">Nope!</font></em></strong><br>\n" );
		echo( "		<strong><em><font color=\"green\">Errorcode returned: " . $int_registrationResult . "</font></em></strong><br>\n" );
	}// end if
?>
		<br>Can we Register a new user with the following information?<br>
		Username: "AnotherTestUser"<br>
		GID: 0<br>
		Password: "test"<br>
		Email: "test@testdomain.co.uk"<br>
		Sex: 'M'<br>
		BirthDate: "2013-11-10"<br>
		FirstName: "test"<br>
		LastName: "test"<br>
		Postal Code: "A5M-7M2" ..........
<?php
	$int_registrationResult = (int) $object_user->Register("AnotherTestUser",0,"test","test@testdomain.co.uk","M","2013-11-10","test","test","A5M-7M2");
	
	if( $int_registrationResult === 1 ) {
		echo( "		<strong><em><font color=\"red\">Yes!</font></em></strong><br>\n" );
	} else {
		echo( "		<strong><em><font color=\"green\">Nope!</font></em></strong><br>\n" );
		echo( "		<strong><em><font color=\"green\">Errorcode returned: " . $int_registrationResult . "</font></em></strong><br>\n" );
	}// end if
?>
		<br>Can we Register a new user with the following information?<br>
		Username: "TestUserDangerousPassword"<br>
		GID: 0<br>
		Password: "'; "SPLERG!;"<br>
		Email: "test@testdomain.co.uk"<br>
		Sex: 'M'<br>
		BirthDate: "2013-11-10"<br>
		FirstName: "test"<br>
		LastName: "test"<br>
		Postal Code: "A5M-7M2" ..........
<?php
	$int_registrationResult = (int) $object_user->Register("TestUserDangerousPassword",0,"'; \"SPLERG!;","test@testdomain.co.uk","M","2013-11-10","test","test","A5M-7M2");
	
	if( $int_registrationResult === 1 ) {
		echo( "		<strong><em><font color=\"red\">Yes!</font></em></strong><br>\n" );
	} else {
		echo( "		<strong><em><font color=\"green\">Nope!</font></em></strong><br>\n" );
		echo( "		<strong><em><font color=\"green\">Errorcode returned: " . $int_registrationResult . "</font></em></strong><br>\n" );
	}// end if
?>
	</body>

</html>
