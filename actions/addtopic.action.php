<?php
/*
 * addtopic.action.php-	mpw-forum v0.1
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

	/*
	 * @return Integer Errorcode 0 if successfully added Topic
	 * @return Integer Errorcode -1 if Owner Username is invalid
	 * @return Integer Errorcode -2 if title is invalid
	 * @return Integer Errorcode -3 if body invalid
	 * @return Integer Errorcode -4 on DB insertion failures
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

	if( isset($_POST['addtopic-is-posting']) && $_POST['addtopic-is-posting'] == "true" ) {
		if( !isset($_POST['addtopic-username']) ) {
?>
				<div class="container">
					<div class="title">
						Add Topic Error (1)
					</div>
					<div class="content">
						The Username was missing
					</div>
				</div>
<?php
		} else if ( !isset($_POST['addtopic-title']) ) {
?>
				<div class="container">
					<div class="title">
						Add Topic Error (2)
					</div>
					<div class="content">
						The Title was missing
					</div>
				</div>
<?php
		} else if ( !isset($_POST['addtopic-body']) ) {
?>
				<div class="container">
					<div class="title">
						Add Topic Error (3)
					</div>
					<div class="content">
						The second Password was missing
					</div>
				</div>
<?php
		} else { 	// All checks passed
			// Instantiate the Forum object
			include_once( "forum.php" );
			$object_forum = new Forum();
			
			$int_addTopicResult = $object_forum->addTopic( $_POST['addtopic-username'], $_POST['addtopic-title'], $_POST['addtopic-body'] );
			if( $int_addTopicResult === 0 ) {
?>
				<div class="container">
					<div class="title">
						Add Topic Success!
					</div>
					<div class="content">
						The new topic was successfully added to the Forum system!<br>
						Click <a href="index.php">here</a> to return to the Forum index.
					</div>
				</div>
<?php
			} else {

				switch( $int_addTopicResult ) {
					case -1:
?>
				<div class="container">
					<div class="title">
						Add Topic Error (Username)
					</div>
					<div class="content">
						Your Username was rejected.
					</div>
				</div>
<?php
						break;
					case -2:
?>
				<div class="container">
					<div class="title">
						Add Topic Error (Title)
					</div>
					<div class="content">
						The entered Title was rejected.
					</div>
				</div>
<?php
						break;
					case -3:
?>
				<div class="container">
					<div class="title">
						Add Topic Error (Body)
					</div>
					<div class="content">
						The entered Body was rejected.
					</div>
				</div>
<?php
						break;
					case -4:
?>
				<div class="container">
					<div class="title">
						Add Topic Error (DB Insert)
					</div>
					<div class="content">
						The Database was connected but the Insert statement failed.
					</div>
				</div>
<?php
						break;
					default:
?>
				<div class="container">
					<div class="title">
						Add Topic Error (?)
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
						Add New Forum Topic
					</div>
					<div class="content">
						<form method="POST" action="index.php?doAction=addtopic">
							<fieldset>
								<legend>Topic Details</legend>
								<label for="addtopic-title">Title</label>
								<input type="text" name="addtopic-title" required><br>
								<label for="addtopic-body">Body</label><br>
								<textarea name="addtopic-body" rows="6" cols="35" required></textarea>
							</fieldset>
							<input type="hidden" name="addtopic-is-posting" value="true">
							<input type="hidden" name="addtopic-username" value="<?=$object_user->getUsername();?>">
							<input type="submit" value="Add">
						</form>
					</div>
				</div>
<?php
	}// end if
	
}// end if

?>
