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
		$object_dbPreparedStatement->bindParam( ":oname",$mixed_ownerNameIn );
		$object_dbPreparedStatement->bindParam( ":title",$mixed_titleIn );
		$object_dbPreparedStatement->bindParam( ":body",$mixed_bodyIn );
		$object_dbPreparedStatement->bindParam( ":cdate",$string_currentDateTime );

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
		$object_dbDataset = $object_dbConnection->query( "SELECT * FROM mpw_forum_topics;" );

		// Disconnect from the Database
		$object_dbConnection = null;
		unset( $object_dbConnection );

		// Make sure our ResultSet actually contains something
		if( is_bool($object_dbDataset) ) {
			return (int)-2;
		} else {
			
			//
			// TODO: Iterate through DataSet
			//
			
		}// end if
		
	}// end showTopics() method

}// end Forum class
?>
