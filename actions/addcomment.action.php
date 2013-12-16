<?php
/*
 * addcomment.action.php-	mpw-forum v0.1
 * 
 * 		Description:		Very simple web forum. A throwback to the
 * 							Bulletin Board Systems of the past.
 * 							Organized into Topics and Topic Comments.
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

	if( isset($_POST['addcomment-is-posting']) && $_POST['addcomment-is-posting'] == "true" ) {
		if( !isset($_POST['addcomment-title']) ) {
?>
				<div class="container">
					<div class="title">
						Add Comment Error (1)
					</div>
					<div class="content">
						The Title was missing
					</div>
				</div>
<?php
		} else if ( !isset($_POST['addcomment-body']) ) {
?>
				<div class="container">
					<div class="title">
						Add Comment Error (2)
					</div>
					<div class="content">
						The Body was missing
					</div>
				</div>
<?php
		} else if ( !isset($_POST['addcomment-oname']) ) {
?>
				<div class="container">
					<div class="title">
						Add Comment Error (3)
					</div>
					<div class="content">
						The Owner Name was missing
					</div>
				</div>
<?php
		} else if ( !isset($_POST['addcomment-tid']) ) {
?>
				<div class="container">
					<div class="title">
						Add Comment Error (3)
					</div>
					<div class="content">
						The Topic ID was missing
					</div>
				</div>
<?php
		} else { 	// All checks passed
			// Instantiate the Forum object
			include_once( "forum.php" );
			$object_forum = new Forum();
			
			$int_addCommentResult = $object_forum->addComment( $_POST['addcomment-tid'], $_POST['addcomment-oname'], $_POST['addcomment-title'], $_POST['addcomment-body'] );
			if( $int_addCommentResult === 0 ) {
?>
				<div class="container">
					<div class="title">
						Add Comment Success!
					</div>
					<div class="content">
						The new comment was successfully added to the Forum system!<br>
						Click <a href="index.php?doAction=showtopic&topicID=<?=$_POST['addcomment-tid'];?>">here</a> to return to the Topic.
					</div>
				</div>
<?php
			} else {

				switch( $int_addCommentResult ) {
					case -1:
?>
				<div class="container">
					<div class="title">
						Add Comment Error (Topic ID)
					</div>
					<div class="content">
						Your Topic ID was rejected.
					</div>
				</div>
<?php
						break;
					case -2:
?>
				<div class="container">
					<div class="title">
						Add Comment Error (Owner Name)
					</div>
					<div class="content">
						The entered Owner Name was rejected.
					</div>
				</div>
<?php
						break;
					case -3:
?>
				<div class="container">
					<div class="title">
						Add Comment Error (Title)
					</div>
					<div class="content">
						The entered Title was rejected.
					</div>
				</div>
<?php
						break;
					case -4:
?>
				<div class="container">
					<div class="title">
						Add Comment Error (Body)
					</div>
					<div class="content">
						The entered Body was rejected.
					</div>
				</div>
<?php
						break;
					case -5:
?>
				<div class="container">
					<div class="title">
						Add Comment Error (DB Connect)
					</div>
					<div class="content">
						The Database Connect failed.
					</div>
				</div>
<?php
						break;
					case -6:
?>
				<div class="container">
					<div class="title">
						Add Comment Error (DB Insert)
					</div>
					<div class="content">
						The Database Insert failed.
					</div>
				</div>
<?php
						break;
					default:
?>
				<div class="container">
					<div class="title">
						Add Comment Error (?)
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
						Add Comment Error (1)
					</div>
					<div class="content">
						This is a Controller Action. It's not meant to be used by itself.
					</div>
				</div>
<?php
	}// end if
	
}// end if

?>
