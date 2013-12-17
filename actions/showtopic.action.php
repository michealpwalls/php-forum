<?php
/*
 * showtopic.action.php -	mpw-forum v0.1
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

if( !isset($_GET['topicID']) ) {
?>
				<div class="container">
					<div class="title">
						Show Topic Error (1)
					</div>
					<div class="content">
						The Topic ID was missing
					</div>
				</div>
<?php
} else {
	// Show the Topic
	include_once( "forum.php" );
	$object_forum = new Forum();
	$int_showTopicResult = $object_forum->showTopic( $_GET['topicID'], $object_user->getUsername() );
	if( $int_showTopicResult === 0 ) {
		
	} else {
		//
		// TODO: Error handling
		//
		include( "views/forum_showTopic_notFound.txt" );
	}// end if
}// end if
