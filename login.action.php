<?php
/*
 * login.action.php -			mpw-forum v0.1
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


if( isset($_POST['login-username']) && isset($_POST['login-password']) ) {
	// Attempt to Login the user
	if( $object_user->Login($_POST['login-username'],$_POST['login-password']) ) {
?>
				<div class="container">
					<div class="title">
						Login Success!
					</div>
					<div class="content">
						You have been successfully logged into the Forum System!<br>
						Click <a href="index.php">here</a> to return to the Forum Demo
				</div>
<?php
	} else {
?>
				<div class="container">
					<div class="title">
						Login Error (2)
					</div>
					<div class="content">
						The Username or Password you entered was invalid
					</div>
				</div>
<?php
	} // end if
} else {
?>
				<div class="container">
					<div class="title">
						Login Error (1)
					</div>
					<div class="content">
						The Username or Password you entered was invalid
					</div>
				</div>

<?php
}// end if
?>
