<?php
/*
 * register.action.php-	mpw-forum v0.1
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
 
//"NewUserTest",0,"test","test@testdomain.co.uk","M","2013-11-10","test","test","A5M-7M2"

if( isset($_POST['register-is-registering']) && $_POST['register-is-registering'] == "true" ) {
	if( !isset($_POST['register-username']) ) {
?>
				<div class="container">
					<div class="title">
						Registration Error (1)
					</div>
					<div class="content">
						The Username was missing
					</div>
				</div>
<?php
	} else if ( !isset($_POST['register-password-a']) ) {
?>
				<div class="container">
					<div class="title">
						Registration Error (2)
					</div>
					<div class="content">
						The first Password was missing
					</div>
				</div>
<?php
	} else if ( !isset($_POST['register-password-b']) ) {
?>
				<div class="container">
					<div class="title">
						Registration Error (3)
					</div>
					<div class="content">
						The second Password was missing
					</div>
				</div>
<?php
	} else if ( !isset($_POST['register-email']) ) {
?>
				<div class="container">
					<div class="title">
						Registration Error (4)
					</div>
					<div class="content">
						The eMail Address was missing
					</div>
				</div>
<?php
	} else if ( !isset($_POST['register-fname']) ) {
?>
				<div class="container">
					<div class="title">
						Registration Error (5)
					</div>
					<div class="content">
						The First Name was missing
					</div>
				</div>
<?php
	} else if ( !isset($_POST['register-lname']) ) {
?>
				<div class="container">
					<div class="title">
						Registration Error (6)
					</div>
					<div class="content">
						The Last Name was missing
					</div>
				</div>
<?php
	} else if ( !isset($_POST['register-sex']) ) {
?>
				<div class="container">
					<div class="title">
						Registration Error (8)
					</div>
					<div class="content">
						The Sex was missing
					</div>
				</div>
<?php
	} else if ( !isset($_POST['register-bdate']) ) {
?>
				<div class="container">
					<div class="title">
						Registration Error (9)
					</div>
					<div class="content">
						The Birth Date was missing
					</div>
				</div>
<?php
	} else if ( !isset($_POST['register-pcode']) ) {
?>
				<div class="container">
					<div class="title">
						Registration Error (10)
					</div>
					<div class="content">
						The Postal Code was missing
					</div>
				</div>
<?php
	} else { 	// All checks pass! :)
		if( $object_user->Register($_POST['register-username'], 0, $_POST['register-password-a'], $_POST['register-email'], $_POST['register-sex'], $_POST['register-bdate'], $_POST['register-fname'], $_POST['register-lname'], $_POST['register-pcode']) ) {
?>
				<div class="container">
					<div class="title">
						Registration Success!
					</div>
					<div class="content">
						The new user to was successfully registered!<br>
						Click <a href="index.php">here</a> to return to the Forum index.
					</div>
				</div>
<?php
		} else {
?>
				<div class="container">
					<div class="title">
						Registration Error (11)
					</div>
					<div class="content">
						The new user failed to be Registered. Call Oprah Winfrey! CALL TOM CRUISE! :(
					</div>
				</div>
<?php
		}// end if
	}// end if
} else {
?>
				<div class="container">
					<div class="title">
						Register
					</div>
					<div class="content">
						<form method="POST" action="index.php?doAction=register">
							<fieldset>
								<legend>Account Details</legend>
								<label for="register-username">Username</label>
								<input type="text" name="register-username" required>
								<label for="register-password-a">Password</label>
								<input type="password" name="register-password-a" required>
								<label for="register-password-b">Repeat Password</label>
								<input type="password" name="register-password-b" required>
								<label for="register-email">eMail Address</label>
								<input type="email" name="register-email" required>
							</fieldset>
							<fieldset>
								<legend>User Profile</legend>
								<label for="register-fname">First Name</label>
								<input type="text" name="register-fname" required>
								<label for="register-lname">Last Name</label>
								<input type="text" name="register-lname" required>
								<label for="register-sex">Sex</label>
								<input type="text" name="register-sex" required>
								<label for="register-bdate">Birth Date (YYYY-MM-DD)</label>
								<input type="text" name="register-bdate" required>
								<label for="register-pcode">Postal Code (A1B-2C3)</label>
								<input type="text" name="register-pcode" required>
							</fieldset>
							<input type="hidden" name="register-is-registering" value="true">
							<input type="submit" value="Register">
						</form>
					</div>
				</div>
<?php
}// end if

?>
