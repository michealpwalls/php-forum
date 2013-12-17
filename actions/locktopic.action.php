<?php
/*
 * locktopic.action.php-	mpw-forum v0.1
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

if( $object_user->isLoggedIn() === false ) {
?>
				<div class="container">
					<div class="title">
						Not Logged In
					</div>
					<div class="content">
						You must be logged in, in order to perform this Action.
					</div>
				</div>
<?php
} else {

	if( !isset($_GET['topicID']) ) {
?>
				<div class="container">
					<div class="title">
						Input Missing
					</div>
					<div class="content">
						You did not provide a Topic ID.
					</div>
				</div>
<?php
	} else { 	// All checks passed
		// Instantiate the Forum object
		include_once( "forum.php" );
		$object_forum = new Forum();
		
		$int_lockTopicResult = $object_forum->LockTopic( $_GET['topicID'], $object_user->getUsername() );
		if( $int_lockTopicResult === 0 ) {
?>
				<div class="container">
					<div class="title">
						Lock Topic Success!
					</div>
					<div class="content">
						The new topic was successfully locked from comments<br>
						Click <a href="index.php?doAction=showtopic&topicID=<?=$_GET['topicID'];?>">here</a> to return to the Topic.
					</div>
				</div>
<?php
		} else {

			switch( $int_lockTopicResult ) {
				case -1:
?>
				<div class="container">
					<div class="title">
						Lock Topic Error (Topic ID)
					</div>
					<div class="content">
						The Topic ID was rejected.
					</div>
				</div>
<?php
					break;
				case -2:
?>
				<div class="container">
					<div class="title">
						Lock Topic Error (Username)
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
						Lock Topic Error (DB Connect)
					</div>
					<div class="content">
						Failed to connect to the Database.
					</div>
				</div>
<?php
					break;
				case -4:
?>
				<div class="container">
					<div class="title">
						Lock Topic Error (DB Query)
					</div>
					<div class="content">
						The Database Query failed.
					</div>
				</div>
<?php
					break;
				default:
?>
				<div class="container">
					<div class="title">
						Lock Topic Error (?)
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

?>
