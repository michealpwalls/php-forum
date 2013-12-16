<?php
/*
 * updateprofile.action.php-	mpw-forum v0.1
 * 
 * 		Description:			Very simple web forum. A throwback to the
 * 								Bulletin Board Systems of the past.
 * 								Organized into Topics and Topic Comments.
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

if( isset($_POST['updateprofile-is-updating']) && $_POST['updateprofile-is-updating'] == "true" ) {
	if( !isset($_POST['updateprofile-username']) ) {
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
	} else if ( !isset($_POST['updateprofile-password-a']) ) {
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
	} else if ( !isset($_POST['updateprofile-password-b']) ) {
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
	} else if ( !isset($_POST['updateprofile-email']) ) {
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
	} else if ( !isset($_POST['updateprofile-fname']) ) {
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
	} else if ( !isset($_POST['updateprofile-lname']) ) {
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
	} else if ( !isset($_POST['updateprofile-sex']) ) {
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
	} else if ( !isset($_POST['updateprofile-bdate']) ) {
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
	} else if ( !isset($_POST['updateprofile-pcode']) ) {
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
	} else { 	// All checks passed
		if( $_POST['updateprofile-password-a'] != $_POST['updateprofile-password-b'] ) {
?>
				<div class="container">
					<div class="title">
						Profile Update Error!
					</div>
					<div class="content">
						The first and second Passwords did not match.
					</div>
				</div>
<?php
		} else {
			$int_profileUpdateResult = $object_user->Register($_POST['register-username'], 0, $_POST['register-password-a'], $_POST['register-email'], $_POST['register-sex'], $_POST['register-bdate'], $_POST['register-fname'], $_POST['register-lname'], $_POST['register-pcode']);
			if( $int_profileUpdateResultResult === 0 ) {
?>
				<div class="container">
					<div class="title">
						Profile Update Success!
					</div>
					<div class="content">
						Your Profile was successfully updated!<br>
						Click <a href="index.php">here</a> to return to the Forum index.
					</div>
				</div>
<?php
			} else {

				switch( $int_profileUpdateResult ) {
					case -1:
?>
				<div class="container">
					<div class="title">
						Profile Update Error (Username)
					</div>
					<div class="content">
						The entered Usernamed was rejected.
					</div>
				</div>
<?php
						break;
					case -2:
?>
				<div class="container">
					<div class="title">
						Profile Update Error (Group)
					</div>
					<div class="content">
						The entered Group ID was rejected.
					</div>
				</div>
<?php
						break;
					case -3:
?>
				<div class="container">
					<div class="title">
						Profile Update Error (Password)
					</div>
					<div class="content">
						The entered Password was rejected.
					</div>
				</div>
<?php
						break;
					case -4:
?>
				<div class="container">
					<div class="title">
						Profile Update Error (eMail)
					</div>
					<div class="content">
						The entered eMail Address was rejected.
					</div>
				</div>
<?php
						break;
					case -5:
?>
				<div class="container">
					<div class="title">
						Profile Update Error (Sex)
					</div>
					<div class="content">
						The entered Sex was rejected.
					</div>
				</div>
<?php
						break;
					case -6:
?>
				<div class="container">
					<div class="title">
						Profile Update Error (BirthDate)
					</div>
					<div class="content">
						The entered Birth Date was rejected.
					</div>
				</div>
<?php
						break;
					case -7:
?>
				<div class="container">
					<div class="title">
						Profile Update Error (FName)
					</div>
					<div class="content">
						The entered First Name was rejected.
					</div>
				</div>
<?php
						break;
					case -8:
?>
				<div class="container">
					<div class="title">
						Profile Update Error (LName)
					</div>
					<div class="content">
						The entered Last Name was rejected.
					</div>
				</div>
<?php
						break;
					case -9:
?>
				<div class="container">
					<div class="title">
						Profile Update Error (PCode)
					</div>
					<div class="content">
						The entered Postal Code was rejected.
					</div>
				</div>
<?php
						break;
					case -10:
?>
				<div class="container">
					<div class="title">
						Profile Update Error (User Exists)
					</div>
					<div class="content">
						The specified User already exists in the Forum System.
					</div>
				</div>
<?php
						break;
					case -11:
?>
				<div class="container">
					<div class="title">
						Profile Update Error (Query Fault)
					</div>
					<div class="content">
						The Database was connected, but the Query failed to run.
					</div>
				</div>
<?php
						break;
					case -12:
?>
				<div class="container">
					<div class="title">
						Profile Update Error (Connect Fault)
					</div>
					<div class="content">
						The Database could not be connected!
					</div>
				</div>
<?php
						break;
					case -13:
?>
				<div class="container">
					<div class="title">
						Profile Update Error (DB ResultSet)
					</div>
					<div class="content">
						The ResultSet was not returned from the Duplicate-User-Check!
					</div>
				</div>
<?php
						break;
					default:
?>
				<div class="container">
					<div class="title">
						Profile Update Error (?)
					</div>
					<div class="content">
						An unknown and unhandled exception was thrown! Call Oprah Winfrey! CALL TOM CRUISE! :(
					</div>
				</div>
<?php
						break;
				}// end switch

			}// end if
		}// end if
	}// end if
} else {
?>
				<div class="container">
					<div class="title">
						Update Profile
					</div>
					<div class="content">
						<form method="POST" action="index.php?doAction=updateprofile">
							<fieldset>
								<legend>Account Details</legend>
								<label for="updateprofile-username">Username</label>
								<input type="text" name="updateprofile-username" value="<?=$object_user->getUsername();?>" required>
								<label for="updateprofile-email">eMail Address</label>
								<input type="email" name="updateprofile-email" value="<?=$object_user->getEmail();?>" required>
							</fieldset>
							<fieldset>
								<legend>User Profile</legend>
								<label for="updateprofile-fname">First Name</label>
								<input type="text" name="updateprofile-fname" value="<?=$object_user->getFirstName();?>" required>
								<label for="updateprofile-lname">Last Name</label>
								<input type="text" name="updateprofile-lname" value="<?=$object_user->getLastName();?>" required>
								<label for="updateprofile-sex">Sex</label>
								<input type="text" name="updateprofile-sex" value="<?=$object_user->getSex();?>" required>
								<label for="updateprofile-bdate">Birth Date (YYYY-MM-DD)</label>
								<input type="text" name="updateprofile-bdate" value="<?=$object_user->getBirthDateString();?>" required>
								<label for="updateprofile-pcode">Postal Code (A1B-2C3)</label>
								<input type="text" name="updateprofile-pcode" value="<?=$object_user->getPostalCode();?>" required>
							</fieldset>
							<input type="hidden" name="updateprofile-is-updating" value="true">
							<input type="hidden" name="updateprofile-uid" value="<?=$object_user->getUID();?>">
							<input type="hidden" name="updateprofile-gid" value="<?=$object_user->getGID();?>">
							<input type="submit" value="Save">
						</form>
					</div>
				</div>
<?php
}// end if

?>
