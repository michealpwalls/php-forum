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
						Profile Update Error (1)
					</div>
					<div class="content">
						The Username was missing
					</div>
				</div>
<?php
	} else if ( !isset($_POST['updateprofile-email']) ) {
?>
				<div class="container">
					<div class="title">
						Profile Update Error (4)
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
						Profile Update Error (5)
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
						Profile Update Error (6)
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
						Profile Update Error (8)
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
						Profile Update Error (9)
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
						Profile Update Error (10)
					</div>
					<div class="content">
						The Postal Code was missing
					</div>
				</div>
<?php
	} else { 	// All checks passed
		$int_profileUpdateResult = $object_user->UpdateProfile( $_POST['updateprofile-uid'], $_POST['updateprofile-username'], $_POST['updateprofile-gid'], $_POST['updateprofile-email'], $_POST['updateprofile-sex'], $_POST['updateprofile-bdate'], $_POST['updateprofile-fname'], $_POST['updateprofile-lname'], $_POST['updateprofile-pcode'] );
		if( $int_profileUpdateResult === 0 ) {
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
						Profile Update Error (User ID)
					</div>
					<div class="content">
						The entered User ID was rejected.
					</div>
				</div>
<?php
					break;
				case -2:
?>
				<div class="container">
					<div class="title">
						Profile Update Error (Username)
					</div>
					<div class="content">
						The entered Username was rejected.
					</div>
				</div>
<?php
					break;
				case -3:
?>
				<div class="container">
					<div class="title">
						Profile Update Error (Group ID)
					</div>
					<div class="content">
						The entered Group ID was rejected.
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
						Profile Update Error (User Not Exist)
					</div>
					<div class="content">
						The specified User does not exist in the Forum System.
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
						The ResultSet was not returned from the User-Exists-Check!
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
								<input type="text" name="updateprofile-username" value="<?=$object_user->getUsername();?>" required><br>
								<label for="updateprofile-email">eMail Address</label>
								<input type="email" name="updateprofile-email" size="20" value="<?=$object_user->getEmail();?>" required><br>
							</fieldset>
							<fieldset>
								<legend>User Profile</legend>
								<label for="updateprofile-fname">First Name</label>
								<input type="text" name="updateprofile-fname" value="<?=$object_user->getFirstName();?>" required><br>
								<label for="updateprofile-lname">Last Name</label>
								<input type="text" name="updateprofile-lname" value="<?=$object_user->getLastName();?>" required><br>
								<label for="updateprofile-sex">Sex</label>
								<input type="text" name="updateprofile-sex" value="<?=$object_user->getSex();?>" size="1" required><br>
								<label for="updateprofile-bdate">Birth Date (YYYY-MM-DD)</label>
								<input type="text" name="updateprofile-bdate" size="6" value="<?=$object_user->getBirthDateString();?>" required><br>
								<label for="updateprofile-pcode">Postal Code (A1B-2C3)</label>
								<input type="text" name="updateprofile-pcode" size="4" value="<?=$object_user->getPostalCode();?>" required><br>
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
