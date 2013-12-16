<?php
/*
 * forum.php	-	mpw-forum v0.1
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

/**
 * This class defines Forum objects. Forum objects are extensions of the
 * Validator class.
 * 
 * I think an instance of the Forum object represents the Model in the 
 * MVC design. Something like that, anyways :)
 * 
 * @author Micheal Walls
 */
class Forum extends Validator {
	// Instance variables

	public function __construct() {
		// Initialize instance variables
		
		
	}// end Constructor
	
	/**
	 * The addTopic method is used to add new Topics into the Forum system
	 * 
	 * @param $mixed_ownerNameIn String to define the Owner of the new Topic
	 * @param $mixed_titleIn String to set to the new Topic's Title
	 * @param $mixed_bodyIn String to set the new Topic's Body (Content)
	 * @return Integer Errorcode 0 if successfully added Topic
	 * @return Integer Errorcode -1 if ownerID is invalid
	 * @return Integer Errorcode -2 if title is invalid
	 * @return Integer Errorcode -3 if body invalid
	 * @return Integer Errorcode -4 on DB insertion failures
	 */
	public function addTopic( $mixed_ownerNameIn, $mixed_titleIn, $mixed_bodyIn ) {
		// Validate the OwnerID
		$this->setUserInput( $mixed_ownerNameIn );
		if( $this->isUsername() === false ) {
			return (int)-1;
		}// end if
		
		// Validate the Title
		$this->setUserInput( $mixed_titleIn );
		if( $this->isString() === false ) {
			return (int)-2;
		}// end if
		
		// Validate the Body
		$this->setUserInput( $mixed_bodyIn );
		if( $this->isString() === false ) {
			return (int)-3;
		}// end if
		
		// Connect to the Database
		include( "lib/dbconnect.php" );
		
		// Make sure we actually connected
		if( !isset($object_dbConnection) || is_null($object_dbConnection) ) {
			return (int)-4;
		}// end if
		
		// Get the current date and time
		$array_dateTime = getdate();
		$string_currentDateTime = $array_dateTime["year"] . "-" . $array_dateTime["mon"] . "-" . $array_dateTime["mday"] . " " . $array_dateTime["hours"] . ":" . $array_dateTime["minutes"] . ":" . $array_dateTime["seconds"];
		
		// Prepare the SQL statement using Named params
		$object_dbPreparedStatement = $object_dbConnection->prepare( "INSERT INTO mpw_forum_topics(ONAME,TITLE,BODY,CDATE) VALUES(:oname,:title,:body,:cdate);" );

		// Bind the parameters to the local variables
		$object_dbPreparedStatement->bindParam( ":oname", $mixed_ownerNameIn );
		$object_dbPreparedStatement->bindParam( ":title", $mixed_titleIn );
		$object_dbPreparedStatement->bindParam( ":body", $mixed_bodyIn );
		$object_dbPreparedStatement->bindParam( ":cdate", $string_currentDateTime );

		// Query the db
		$integer_rowsAffected = $object_dbPreparedStatement->execute();

		// Disconnect from the Database
		$object_dbConnection = null;
		unset( $object_dbConnection );
		
		// Make sure the new topic was properly inserted in the Database
		if( $integer_rowsAffected != 1 ) {
			return (int)-4;
		}// end if

		// Return errorcode 0 to show successfull Registration.
		return (int)0;
	}// end addTopic method
	
	/**
	 * This method will iterate through all the Topics in the Forum
	 * System.
	 * 
	 * @return Integer Errorcode 0 on successfull iteration
	 * @return Integer Errorcode -1 on Database Connection failure.
	 * @return Integer Errorcode -2 on empty ResultSet (No Topics in Forum)
	 */
	public function showTopics() {
		// Connect to the Database
		include( "lib/dbconnect.php" );
		
		// Make sure we actually connected
		if( !isset($object_dbConnection) || is_null($object_dbConnection) ) {
			return (int)-1;
		}// end if
		
		// Query the Database for the Forum Topics
		$object_dbResultSet = $object_dbConnection->query( "SELECT * FROM mpw_forum_topics;" );

		// Disconnect from the Database
		$object_dbConnection = null;
		unset( $object_dbConnection );

		// Make sure our ResultSet actually contains something
		if( is_bool($object_dbResultSet) ) {
			return (int)-2;
		} else {

			include_once( "views/forum_topicindex_header.txt" );

			// Ready to iterate through the Forum Topics
			while( $array_dbRow = $object_dbResultSet->fetch() ) {
				include( "views/forum_topicindex_body.txt" );
			}// end while loop

			include_once( "views/forum_topicindex_footer.txt" );

		}// end if
		
		// Return with Errorcode 0 to show no errors were thrown.
		return (int)0;
		
	}// end showTopics() method
	
	/**
	 * This method will display a Forum Topic.
	 * 
	 * @return Integer Errorcode 0 on successfull display
	 * @return Integer Errorcode -1 when Input is not valid Topic ID
	 * @return Integer Errorcode -2 when Database Connection fails
	 * @return Integer Errorcode -3 when Topic not found
	 */
	public function showTopic( $mixed_topicIDIn ) {
		// Validate the input
		$this->setUserInput( $mixed_topicIDIn );
		if( $this->isWholeNumber() === false ) {
			return (int)-1;
		}// end if

		// Connect to the Database
		include( "lib/dbconnect.php" );
		
		// Make sure DB is actually connected
		if( !isset($object_dbConnection) || is_null($object_dbConnection) ) {
			return (int)-2;
		}// end if
		
		// Create a Prepared Statement for the Query
		$object_dbPreparedStatement = $object_dbConnection->prepare( "SELECT * FROM mpw_forum_topics WHERE TID=:mixed_topicIDIn;" );

		// Bind the parameters
		$object_dbPreparedStatement->bindParam( ":mixed_topicIDIn", $mixed_topicIDIn );

		// Execute the statement
		$object_dbPreparedStatement->execute();

		// Disconnect from the Database
		$object_dbConnection = null;
		unset( $object_dbConnection );

		// Make sure the ResultSet actually contains something
		if( is_bool($object_dbPreparedStatement) ) {
			return (int)-3;
		} else {
			$array_dbRow = $object_dbPreparedStatement->fetch();

			// Display the requested Forum Topic
			include( "views/forum_showTopic.txt" );
		}// end if

		// Return with Errorcode 0 to show no errors were thrown.
		return (int)0;
	}// end showTopic() method
	
	/**
	 * This method will iterate through the any Comments associated with a Topic.
	 * 
	 * @return Integer Errorcode 0 on successfull iteration
	 * @return Integer Errorcode -1 on invalid Topic ID
	 * @return Integer Errorcode -2 on invalid User Name
	 * @return Integer Errorcode -3 when Database Connection fails
	 */
	public function showComments( $mixed_topicIDIn, $mixed_userNameIn ) {
		// Validate the Topic ID
		$this->setUserInput( $mixed_topicIDIn );
		if( $this->isWholeNumber() === false ) {
			return (int)-1;
		}// end if
		
		// Validate the User Name
		$this->setUserInput( $mixed_userNameIn );
		if( $this->isUsername() === false ) {
			return (int)-2;
		}// end if

		// Connect to the Database
		include( "lib/dbconnect.php" );
		
		// Make sure DB is actually connected
		if( !isset($object_dbConnection) || is_null($object_dbConnection) ) {
			return (int)-3;
		}// end if
		
		// Create a Prepared Statement for the Query
		$object_dbPreparedStatement = $object_dbConnection->prepare( "SELECT * FROM mpw_forum_comments WHERE TID=:mixed_topicIDIn;" );

		// Bind the parameters
		$object_dbPreparedStatement->bindParam( ":mixed_topicIDIn", $mixed_topicIDIn );

		// Execute the statement
		$object_dbPreparedStatement->execute();

		// Disconnect from the Database
		$object_dbConnection = null;
		unset( $object_dbConnection );

		// Comments' header
		include_once( "views/forum_showTopic_comments_header.txt" );

		// Show the comments if there are any
		if( is_bool($object_dbPreparedStatement) ) {
			include( "views/forum_showTopic_comments_bodyEmpty.txt" );
		} else {

			// Iterate through the Topics' Comments
			while( $array_dbRow = $object_dbPreparedStatement->fetch() ) {
				include( "views/forum_showTopic_comments_body.txt" );
			}// end while loop

		}// end if
		
		// Comments' footer
		if( $mixed_userNameIn === "Guest" ) {
			include_once( "views/forum_showTopic_comments_footerNoPosting.txt" );
		} else {
			include_once( "views/forum_showTopic_comments_footer.txt" );
		}// end if

		// Return with Errorcode 0 to show no errors were thrown.
		return (int)0;
	}// end showComments() method
	
	/**
	 * The addComment method will add a new Comment and associate it with
	 * a Topic in the Forum System.
	 * 
	 * Validates Owner Name as Username and all other inputs as Strings.
	 * See Validator Object for more information on valid Strings.
	 * 
	 * @param $mixed_topicIDIn Integer The Topic ID to associate the Comment with.
	 * @param $mixed_ownerNameIn String The Username of the Comment Owner.
	 * @param $mixed_titleIn String The Title of the Comment.
	 * @param $mixed_bodyIn String The Body of the Comment.
	 * @return Integer Errorcode 0 on successfull Comment.
	 * @return Integer Errorcode -1 on invalid Topic ID (WholeNumber).
	 * @return Integer Errorcode -2 on invalid Owner Name (Username).
	 * @return Integer Errorcode -3 on invalid title (String).
	 * @return Integer Errorcode -4 on invalid body (String).
	 * @return Integer Errorcode -5 when Database Connect fails.
	 * @return Integer Errorcode -6 when Database Insertion fails.
	 */
	 public function addComment( $mixed_topicIDIn, $mixed_ownerNameIn, $mixed_titleIn, $mixed_bodyIn ) {
		 // Validate the Topic ID
		$this->setUserInput( $mixed_topicIDIn );
		if( $this->isWholeNumber() === false ) {
			return (int)-1;
		}// end if
		
		// Validate the Owner Name
		$this->setUserInput( $mixed_ownerNameIn );
		if( $this->isUsername() === false ) {
			return (int)-2;
		}// end if
		
		// Validate the Title
		$this->setUserInput( $mixed_titleIn );
		if( $this->isString() === false ) {
			return (int)-3;
		}// end if
		
		// Validate the Body
		$this->setUserInput( $mixed_bodyIn );
		if( $this->isString() === false ) {
			return (int)-4;
		}// end if

		// Connect to the Database
		include( "lib/dbconnect.php" );
		
		// Make sure DB is actually connected
		if( !isset($object_dbConnection) || is_null($object_dbConnection) ) {
			return (int)-5;
		}// end if
		
		// Create a Prepared Statement for the Query
		$object_dbPreparedStatement = $object_dbConnection->prepare( "INSERT INTO mpw_forum_comments(TID,ONAME,TITLE,BODY,CDATE) VALUES(:tid,:oname,:title,:body,:cdate);" );

		// Get the current date and time
		$array_dateTime = getdate();
		$string_currentDateTime = $array_dateTime["year"] . "-" . $array_dateTime["mon"] . "-" . $array_dateTime["mday"] . " " . $array_dateTime["hours"] . ":" . $array_dateTime["minutes"] . ":" . $array_dateTime["seconds"];

		// Bind the parameters
		$object_dbPreparedStatement->bindParam( ":tid", $mixed_topicIDIn );
		$object_dbPreparedStatement->bindParam( ":oname", $mixed_ownerNameIn );
		$object_dbPreparedStatement->bindParam( ":title", $mixed_titleIn );
		$object_dbPreparedStatement->bindParam( ":body", $mixed_bodyIn );
		$object_dbPreparedStatement->bindParam( ":cdate", $string_currentDateTime );

		// Execute the statement
		$object_dbPreparedStatement->execute();

		// Disconnect from the Database
		$object_dbConnection = null;
		unset( $object_dbConnection );
		
		// Make sure we actually inserted the Comment
		if( $object_dbPreparedStatement->rowCount() < 1 ) {
			return (int)-6;
		}// end if
		
		// Return with Errorcode 0 to show a successful comment
		return (int)0;
	 }// end addComment method
}// end Forum class
?>
