<?php
/*
 * user.php -			mpw-forum v0.1
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
 * This class defines User objects. Extends the Validator class
 * 
 * Each forum user, even when not logged in, will be represented as
 * one of these User objects
 * 
 * @author Micheal Walls
 */
class User extends Validator {
	// Private Array to hold Property values
	private $array_properties = Array(
		"uid" => "",
		"gid" => "",
		"username" => "",
		"email" => "",
		"fname" => "",
		"lname" => "",
		"bdate" => "",
		"rdate" => "",
		"sex" => "",
		"postalCode" => ""
	);

	/**
	 * Constructor for User objects
	 * 
	 * Will check if a Session exists and load it, otherwise
	 * it loads default "Guest" values.
	 */
	function __construct() {

		// First we must start the session
		session_start();

		// Check if the user already has a session stored
		if( isset($_SESSION['properties']) ) {
			// Load from the existing session properties
			$this->array_properties = $_SESSION['properties'];
		} else {
			// Load defaults
			// TODO: Call the setters to load the default Profile
			$this->setUsername( "Guest" );
			$this->setUID( 0 );
			$this->setGID( 0 );
		}// end if

	}// end Constructor

	/**
	 * Boolean pseudo-property.
	 * 
	 * @return Boolean True if user is logged in
	 * @return Boolean False if user is not logged in
	 */
	public function isLoggedIn() {
		if( $this->getUsername() == "Guest" ) {
			return (bool)false;
		} else {
			return (bool)true;
		}// end if
	}// end isLoggedIn method

	/**
	 * Getter for the Username property. Returns the currently set Username
	 * 
	 * @return String Username.
	 */
	public function getUsername() {
		return (string)$this->array_properties["username"];
	}// end getUsername method

	/**
	 * Getter for the Email property. Returns the currently set Email Address
	 * 
	 * @return String Email.
	 */
	public function getEmail() {
		return (string)$this->array_properties["email"];
	}// end getEmail method
	
	/**
	 * Getter for the First Name property. Returns the currently set First Name
	 * 
	 * @return String First Name.
	 */
	public function getFirstName() {
		return (string)$this->array_properties["fname"];
	}// end getFirstName method
	
	/**
	 * Getter for the Last Name property. Returns the currently set Last Name
	 * 
	 * @return String Last Name.
	 */
	public function getLastName() {
		return (string)$this->array_properties["lname"];
	}// end getLastName method
	
	/**
	 * Getter for the Age pseudo-property.
	 * Returns the current Age of the user based on their Birthdate
	 * 
	 * @return Integer Age.
	 */
	public function getAge() {
		// Get the current date
		$array_currentDate = getdate();
		
		// Get the difference of the user's birth date to the current date
		$DateInterval_difference = $this->getBirthDate()->diff( $array_currentDate["year"] . "-" . $array_currentDate["mon"] . "-" . $array_currentDate["mday"] );

		// Return the difference in years
		return (int)$DateInterval_difference->y;
	}// end getAge method
	
	/**
	 * Getter for the Birth Date property. Returns the currently set Birth Date
	 * 
	 * @return DateTime Birth Date.
	 */
	public function getBirthDate() {
		$date_birthDate = DateTime::createFromFormat( "Y-m-d", $this->array_properties["bdate"] );
		return $date_birthDate;
	}// end getBirthDate method
	
	/**
	 * Getter for the Birth Date property. Returns the currently set Birth Date
	 * 
	 * @return String Birth Date as a DateTime String.
	 */
	public function getBirthDateString() {
		
		return (string)$this->array_properties["bdate"];
	}// end getBirthDate method
	
	/**
	 * Getter for the Registration Date property. Returns the currently set Birth Date
	 * 
	 * @return DateTime Registration Date.
	 */
	public function getRegistrationDate() {
		$date_registrationDate = DateTime::createFromFormat( "Y-m-d H:i:s", $this->array_properties["rdate"] );
		return $date_registrationDate;
	}// end getRegistrationDate method
	
	/**
	 * Getter for the GID (Group ID) property. Returns the currently set GID
	 * 
	 * @return Integer GID.
	 */
	public function getGID() {
		return (int)$this->array_properties["gid"];
	}// end getGID method
	
	/**
	 * Getter for the UID (User ID) property. Returns the currently set UID
	 * 
	 * @return Integer UID.
	 */
	public function getUID() {
		return (int)$this->array_properties["uid"];
	}// end getUID method
	
	/**
	 * Getter for the Sex property. Returns the currently set Sex
	 * 
	 * @return String Sex.
	 */
	public function getSex() {
		return (string)$this->array_properties["sex"];
	}// end getSex method
	
	/**
	 * Getter for the Postal Code property. Returns the currently set Postal Code
	 * 
	 * @return String Postal Code.
	 */
	public function getPostalCode() {
		return (string)$this->array_properties["postalCode"];
	}// end getPostalCode method

	/**
	 * Setter for the Username property. Will only set valid usernames.
	 * See VALIDATOR Object for more details.
	 * 
	 * @param String New username to set.
	 * @return Boolean True if input was valid, False otherwise.
	 */
	public function setUsername( $mixed_usernameIn ) {
		$this->setUserInput( $mixed_usernameIn );
		if( $this->isUsername() ) {
			$this->array_properties["username"] = $mixed_usernameIn;
			return true;
		} else {
			return false;
		}// end if
	}// end setUsername method

	/**
	 * Setter for the Email property. Will only set valid email addresses.
	 * See VALIDATOR Object for more details.
	 * 
	 * @param String New Email Address to be set.
	 * @return Boolean True if input was valid, False otherwise.
	 */
	public function setEmail( $mixed_eMailIn ) {
		$this->setUserInput( $mixed_eMailIn );
		if( $this->isEmail() ) {
			$this->array_properties["email"] = $mixed_eMailIn;
			return true;
		} else {
			return false;
		}// end if
	}// end setEmail method
	
	/**
	 * Setter for the First Name property. Will only set valid Names.
	 * See VALIDATOR Object for more details.
	 * 
	 * @param String First Name to be set.
	 * @return Boolean True if input was valid, False otherwise.
	 */
	public function setFirstName( $mixed_firstNameIn ) {
		$this->setUserInput( $mixed_firstNameIn );
		if( $this->isName() ) {
			$this->array_properties["fname"] = $mixed_firstNameIn;
			return true;
		} else {
			return false;
		}// end if
	}// end setFirstName method
	
	/**
	 * Setter for the Last Name property. Will only set valid Names.
	 * See VALIDATOR Object for more details.
	 * 
	 * @param String Last Name to be set.
	 * @return Boolean True if input was valid, False otherwise.
	 */
	public function setLastName( $mixed_lastNameIn ) {
		$this->setUserInput( $mixed_lastNameIn );
		if( $this->isName() ) {
			$this->array_properties["lname"] = $mixed_lastNameIn;
			return true;
		} else {
			return false;
		}// end if
	}// end setLastName method
	
	/**
	 * Setter for the BirthDate property. Will only set valid Strings.
	 * See VALIDATOR Object for more details.
	 * 
	 * @param String Date to be set.
	 * @return Boolean True if input was valid, False otherwise.
	 */
	public function setBirthDate( $mixed_birthDateIn ) {
		$this->setUserInput( $mixed_birthDateIn );
		if( $this->isDateString() ) {
			$this->array_properties["bdate"] = $mixed_birthDateIn;
			return true;
		} else {
			return false;
		}// end if
	}// end setBirthDate method
	
	/**
	 * Setter for the Registration Date property. Will only set valid Strings.
	 * See VALIDATOR Object for more details.
	 * 
	 * @param String Registration Date to be set.
	 * @return Boolean True if input was valid, False otherwise.
	 */
	public function setRegistrationDate( $mixed_registrationDateIn ) {
		$this->setUserInput( $mixed_registrationDateIn );
		if( $this->isDateString() ) {
			$this->array_properties["rdate"] = $mixed_registrationDateIn;
			return true;
		} else {
			return false;
		}// end if
	}// end setRegistrationDate method
	
	/**
	 * Setter for the Sex property. Will only set valid Characters.
	 * See VALIDATOR Object for more details.
	 * 
	 * @param String Sex to be set.
	 * @return Boolean True if input was valid, False otherwise.
	 */
	public function setSex( $mixed_sexIn ) {
		$this->setUserInput( $mixed_sexIn );
		if( $this->isChar() ) {
			$this->array_properties["sex"] = $mixed_sexIn;
			return true;
		} else {
			return false;
		}// end if
	}// end setSex method
	
	/**
	 * Setter for the Postal Code property. Will only set valid CDN Postal Codes.
	 * See VALIDATOR Object for more details.
	 * 
	 * @param String Postal Code to be set.
	 * @return Boolean True if input was valid, False otherwise.
	 */
	public function setPostalCode( $mixed_postalCodeIn ) {
		$this->setUserInput( $mixed_postalCodeIn );
		if( $this->isPostalCode() ) {
			$this->array_properties["postalCode"] = $mixed_postalCodeIn;
			return true;
		} else {
			return false;
		}// end if
	}// end setPostalCode method
	
	/**
	 * Setter for the GID (Group ID) property. Will only set valid WholeNumber.
	 * See VALIDATOR Object for more details.
	 * 
	 * @param Integer GID to be set.
	 * @return Boolean True if input was valid, False otherwise.
	 */
	public function setGID( $mixed_GIDIn ) {
		$this->setUserInput( $mixed_GIDIn );
		if( $this->isWholeNumber() ) {
			$this->array_properties["gid"] = $mixed_GIDIn;
			return true;
		} else {
			return false;
		}// end if
	}// end setGID method
	
	/**
	 * Setter for the UID (User ID) property. Will only set valid WholeNumber.
	 * See VALIDATOR Object for more details.
	 * 
	 * @param Integer UID to be set.
	 * @return Boolean True if input was valid, False otherwise.
	 */
	public function setUID( $mixed_UIDIn ) {
		$this->setUserInput( $mixed_UIDIn );
		if( $this->isWholeNumber() ) {
			$this->array_properties["uid"] = $mixed_UIDIn;
			return true;
		} else {
			return false;
		}// end if
	}// end setUID method

	/**
	 * The Login method logs a user into the Forum system.
	 * 
	 * @param $mixed_usernameIn String The user's username
	 * @param $mixed_passwordIn String The user's password
	 * @return Integer Errorlevel 0 when the user successfully logged in
	 * @return Integer Errorlevel -1 on invalid username
	 * @return Integer Errorlevel -2 on invalid password
	 * @return Integer Errorlevel -3 on database connection exceptions
	 * @return Integer Errorlevel -4 when user/pass does not exist in DB
	 * @return Integer Errorlevel -5 on Query failures
	 */
	public function Login( $mixed_usernameIn, $mixed_passwordIn ) {
		// Validate the Username
		$this->setUserInput( $mixed_usernameIn );
		if( $this->isUsername() === false ) {
			return (int)-1;
		}// end if
		
		// Validate the Password
		$this->setUserInput( $mixed_passwordIn );
		if( $this->isPassword() === false ) {
			return (int)-2;
		}// end if
		
		// Encode the user's Password
		$string_password = hash( "sha512", $mixed_passwordIn );
		
		// Connect to the Database
		include( "lib/dbconnect.php" );
		
		// Make sure we actually connected
		if( !isset($object_dbConnection) || is_null($object_dbConnection) ) {
			return (int)-3;
		}// end if

		//
		// TODO: Replace the use of Query() with a Prepared Statement
		// 

		// Query the database for the user
		$object_dbResultSet = $object_dbConnection->Query( "SELECT * FROM mpw_forum_users WHERE UNAME=" . $object_dbConnection->quote($mixed_usernameIn) . " AND PASS='$string_password';" );

		// Close the Database connection
		$object_dbConnection = null;
		unset( $object_dbConnection );

		// Make sure the query ran successfully
		if( is_bool($object_dbResultSet) ) {
			return (int)-5;
		}// end if

		$array_dbResultSet = $object_dbResultSet->fetch();
		
		// Destroy the old ResultSet object
		$object_dbResultSet = null;
		unset( $object_dbResultSet );
		
		// Make sure the ResultSet contains something
		if( !isset($array_dbResultSet["UID"]) ) {
			return (int)-4;
		}// end if

		// Populate the User Object's Properties
		$this->setGID( $array_dbResultSet["GID"] );
		$this->setUID( $array_dbResultSet["UID"] );
		$this->setUsername( $array_dbResultSet["UNAME"] );
		$this->setFirstName( $array_dbResultSet["FNAME"] );
		$this->setLastName( $array_dbResultSet["LNAME"] );
		$this->setEmail( $array_dbResultSet["EMAIL"] );
		$this->setBirthDate( $array_dbResultSet["BDATE"] );
		$this->setRegistrationDate( $array_dbResultSet["RDATE"] );
		$this->setSex( $array_dbResultSet["SEX"] );
		$this->setPostalCode( $array_dbResultSet["PCODE"] );

		// Save the User's profile in their browser Session
		$this->SaveSession();
		
		// Return with errorcode 1 to show successfull login
		return (int)0;
	}// end Login method

	/**
	 * This method will create a Session and store the entire
	 * Properties array in it.
	 */
	public function SaveSession() {
		$_SESSION['properties'] = $this->array_properties;
	}// end SaveSession method

	/**
	 * This method will Register a new user in the Forum system.
	 * All inputs will be Validated
	 * 
	 * @param $mixed_userNameIn String The new User's Username.
	 * @param $mixed_groupIDIn Integer The new User's Group.
	 * @param $mixed_passwordIn String The new User's Password.
	 * @param $mixed_emailIn String The new User's Email Addres.
	 * @param $mixed_sexIn String The new User's Sex (As a single Character).
	 * @param $mixed_birthDateIn String The new User's Birth Date in the format: YYYY-MM-DD
	 * @param $mixed_firstNameIn String The new User's First Name
	 * @param $mixed_lastNameIn String The new User's Last Name
	 * @param $mixed_postalCodeIn String The new User's Postal Code
	 * @return Integer Errorcode 0 on success
	 * @return Integer Errorcode -1 on invalid username
	 * @return Integer Errorcode -2 on invalid Group ID
	 * @return Integer Errorcode -3 on invalid password
	 * @return Integer Errorcode -4 on invalid eMail
	 * @return Integer Errorcode -5 on invalid sex
	 * @return Integer Errorcode -6 on invalid BirthDate
	 * @return Integer Errorcode -7 on invalid firstName
	 * @return Integer Errorcode -8 on invalid lastName
	 * @return Integer Errorcode -9 on invalid postalCode
	 * @return Integer Errorcode -10 when User already exists
	 * @return Integer Errorcode -11 on Database exceptions
	 * @return Integer Errorcode -12 on Database Connection issues.
	 * @return Integer Errorcode -13 no ResultSet from duplicate check.
	 */
	public function Register( $mixed_usernameIn, $mixed_groupIDIn, $mixed_passwordIn, $mixed_emailIn, $mixed_sexIn, $mixed_birthDateIn, $mixed_firstNameIn, $mixed_lastNameIn, $mixed_postalCodeIn ) {
		// Validate the Username
		$this->setUserInput( $mixed_usernameIn );
		if( $this->isUsername() === false ) {
			return (int)-1;
		}// end if
		
		// Validate the Group ID
		$this->setUserInput( $mixed_groupIDIn );
		if( $this->isWholeNumber() === false ) {
			return (int)-2;
		}// end if
		
		// Validate the Password
		$this->setUserInput( $mixed_passwordIn );
		if( $this->isPassword() === false ) {
			return (int)-3;
		}// end if
		
		// Validate the Email Address
		$this->setUserInput( $mixed_emailIn );
		if( $this->isEmail() === false ) {
			return (int)-4;
		}// end if
		
		// Validate the Sex
		$this->setUserInput( $mixed_sexIn );
		if( $this->isChar() === false ) {
			return (int)-5;
		}// end if
		
		// Validate the Birth Date
		$this->setUserInput( $mixed_birthDateIn );
		if( $this->isDateString() === false ) {
			return (int)-6;
		}// end if
		
		// Validate the First Name
		$this->setUserInput( $mixed_firstNameIn );
		if( $this->isName() === false ) {
			return (int)-7;
		}// end if
		
		// Validate the Last Name
		$this->setUserInput( $mixed_lastNameIn );
		if( $this->isName() === false ) {
			return (int)-8;
		}// end if
		
		// Validate the Postal Code
		$this->setUserInput( $mixed_postalCodeIn );
		if( $this->isPostalCode() === false ) {
			return (int)-9;
		}// end if
		
		// Hash the Password
		$string_password = hash( "sha512", $mixed_passwordIn );
		
		// Connect to the Database
		include( "lib/dbconnect.php" );
		
		// Make sure we actually connected
		if( !isset($object_dbConnection) || is_null($object_dbConnection) ) {
			return (int)-12;
		}// end if
		
		// Get the current date and time
		$array_dateTime = getdate();
		$string_currentDateTime = $array_dateTime["year"] . "-" . $array_dateTime["mon"] . "-" . $array_dateTime["mday"] . " " . $array_dateTime["hours"] . ":" . $array_dateTime["minutes"] . ":" . $array_dateTime["seconds"];

	// I first have to make sure the user doesn't already exist in the Database
	
		// Prepare the SQL statement using a Named parameter
		$object_dbPreparedStatement = $object_dbConnection->prepare( "SELECT UID FROM mpw_forum_users WHERE UNAME=:mixed_usernameIn OR EMAIL==:mixed_emailIn;" );
		
		// Bind the parameter to the local variable
		$object_dbPreparedStatement->bindParam( ":mixed_usernameIn", $mixed_usernameIn );
		$object_dbPreparedStatement->bindParam( ":mixed_emailIn", $mixed_emailIn );
		
		// Query the Database using the Prepared Statement
		$object_dbPreparedStatement->execute();
		
		// Make sure we got a ResultSet
		if( is_bool($object_dbPreparedStatement) ) {
			return (int)-13;
		}// end if
		
		// Inspect the ResultSet
		$array_dbResultSet = $object_dbPreparedStatement->fetch();
		
		// Make sure it is an *empty* resultSet
		if( !empty($array_dbResultSet[0]) ) {
			return (int)-10;
		}// end if
		
	// Next I insert the new user into the Database
	
		// Prepare the SQL statement using Named params
		$object_dbPreparedStatement = $object_dbConnection->prepare( "INSERT INTO mpw_forum_users(UNAME,GID,PASS,FNAME,LNAME,SEX,EMAIL,PCODE,BDATE,RDATE) VALUES(:mixed_usernameIn,:mixed_groupIDIn,:string_password,:mixed_firstNameIn,:mixed_lastNameIn,:mixed_sexIn,:mixed_emailIn,:mixed_postalCodeIn,:mixed_birthDateIn,:string_currentDateTime);" );

		// Bind the parameters to the local variables
		$object_dbPreparedStatement->bindParam( ":mixed_usernameIn", $mixed_usernameIn );
		$object_dbPreparedStatement->bindParam( ":mixed_groupIDIn", $mixed_groupIDIn );
		$object_dbPreparedStatement->bindParam( ":string_password", $string_password );
		$object_dbPreparedStatement->bindParam( ":mixed_firstNameIn", $mixed_firstNameIn );
		$object_dbPreparedStatement->bindParam( ":mixed_lastNameIn", $mixed_lastNameIn );
		$object_dbPreparedStatement->bindParam( ":mixed_sexIn", $mixed_sexIn );
		$object_dbPreparedStatement->bindParam( ":mixed_emailIn", $mixed_emailIn );
		$object_dbPreparedStatement->bindParam( ":mixed_postalCodeIn", $mixed_postalCodeIn );
		$object_dbPreparedStatement->bindParam( ":mixed_birthDateIn", $mixed_birthDateIn );
		$object_dbPreparedStatement->bindParam( ":string_currentDateTime", $string_currentDateTime );

		// Query the db
		$integer_rowsAffected = $object_dbPreparedStatement->execute();

		// Disconnect from the Database
		$object_dbConnection = null;
		unset( $object_dbConnection );
		
		// Make sure the new user was properly inserted in the Database
		if( $integer_rowsAffected != 1 ) {
			return (int)-11;
		}// end if

		// Return errorcode 0 to show successfull Registration.
		return (int)0;
	}// end Register method
	
	/**
	 * This method will Update a user's Profile in the Forum system.
	 * All inputs will be Validated
	 * 
	 * @param $mixed_userNameIn String The User's new Username.
	 * @param $mixed_groupIDIn Integer The User's new Group.
	 * @param $mixed_emailIn String The User's new Email Addres.
	 * @param $mixed_sexIn String The User's new Sex (As a single Character).
	 * @param $mixed_birthDateIn String The User's new Birth Date in the format: YYYY-MM-DD
	 * @param $mixed_firstNameIn String The User's new First Name
	 * @param $mixed_lastNameIn String The User's new Last Name
	 * @param $mixed_postalCodeIn String The User's new Postal Code
	 * @return Integer Errorcode 0 on success
	 * @return Integer Errorcode -1 on invalid user ID
	 * @return Integer Errorcode -2 on invalid username
	 * @return Integer Errorcode -3 on invalid Group ID
	 * @return Integer Errorcode -4 on invalid eMail
	 * @return Integer Errorcode -5 on invalid sex
	 * @return Integer Errorcode -6 on invalid BirthDate
	 * @return Integer Errorcode -7 on invalid firstName
	 * @return Integer Errorcode -8 on invalid lastName
	 * @return Integer Errorcode -9 on invalid postalCode
	 * @return Integer Errorcode -10 when User does not exist
	 * @return Integer Errorcode -11 on Database exceptions
	 * @return Integer Errorcode -12 on Database Connection issues.
	 * @return Integer Errorcode -13 no ResultSet from duplicate check.
	 */
	public function UpdateProfile( $mixed_userIDIn, $mixed_usernameIn, $mixed_groupIDIn, $mixed_emailIn, $mixed_sexIn, $mixed_birthDateIn, $mixed_firstNameIn, $mixed_lastNameIn, $mixed_postalCodeIn ) {
		// Validate the User ID
		$this->setUserInput( $mixed_userIDIn );
		if( $this->isWholeNumber() === false ) {
			return (int)-1;
		}// end if
		
		// Validate the Username
		$this->setUserInput( $mixed_usernameIn );
		if( $this->isUsername() === false ) {
			return (int)-2;
		}// end if
		
		// Validate the Group ID
		$this->setUserInput( $mixed_groupIDIn );
		if( $this->isWholeNumber() === false ) {
			return (int)-3;
		}// end if
		
		// Validate the Email Address
		$this->setUserInput( $mixed_emailIn );
		if( $this->isEmail() === false ) {
			return (int)-4;
		}// end if
		
		// Validate the Sex
		$this->setUserInput( $mixed_sexIn );
		if( $this->isChar() === false ) {
			return (int)-5;
		}// end if
		
		// Validate the Birth Date
		$this->setUserInput( $mixed_birthDateIn );
		if( $this->isDateString() === false ) {
			return (int)-6;
		}// end if
		
		// Validate the First Name
		$this->setUserInput( $mixed_firstNameIn );
		if( $this->isName() === false ) {
			return (int)-7;
		}// end if
		
		// Validate the Last Name
		$this->setUserInput( $mixed_lastNameIn );
		if( $this->isName() === false ) {
			return (int)-8;
		}// end if
		
		// Validate the Postal Code
		$this->setUserInput( $mixed_postalCodeIn );
		if( $this->isPostalCode() === false ) {
			return (int)-9;
		}// end if
		
		// Connect to the Database
		include( "lib/dbconnect.php" );
		
		// Make sure we actually connected
		if( !isset($object_dbConnection) || is_null($object_dbConnection) ) {
			return (int)-12;
		}// end if
		
	// I first have to make sure the user exists in the Database
	
		// Prepare the SQL statement using a Named parameter
		$object_dbPreparedStatement = $object_dbConnection->prepare( "SELECT UID FROM mpw_forum_users WHERE UID=:uid;" );
		
		// Bind the parameter to the local variable
		$object_dbPreparedStatement->bindParam( ":uid", $mixed_userIDIn );
		
		// Query the Database using the Prepared Statement
		$object_dbPreparedStatement->execute();
		
		// Make sure we got a ResultSet
		if( is_bool($object_dbPreparedStatement) ) {
			return (int)-13;
		}// end if
		
		// Copy ResultSet into an Array
		$array_dbResultSet = $object_dbPreparedStatement->fetch();
		
		// Unset the ResultSet for use later on
		//$object_dbPreparedStatement = null;
		//unset( $object_dbPreparedStatement );
		
		// Make sure it is an empty resultSet
		if( empty($array_dbResultSet[0]) ) {
			return (int)-10;
		}// end if
		
		unset( $array_dbResultSet );
	// Next I update the user's Profile
		
		// Prepare the SQL statement using Named params
		$object_dbPreparedStatement = $object_dbConnection->prepare( "UPDATE mpw_forum_users SET UNAME=:uname,GID=:gid,FNAME=:fName,LNAME=:lName,SEX=:sex,EMAIL=:eMail,PCODE=:pCode,BDATE=:bDate WHERE UID=:uid;" );

		// Bind the parameters to the local variables
		$object_dbPreparedStatement->bindParam( ":uid", $mixed_userIDIn );
		$object_dbPreparedStatement->bindParam( ":uname", $mixed_usernameIn );
		$object_dbPreparedStatement->bindParam( ":gid", $mixed_groupIDIn );
		$object_dbPreparedStatement->bindParam( ":fName", $mixed_firstNameIn );
		$object_dbPreparedStatement->bindParam( ":lName", $mixed_lastNameIn );
		$object_dbPreparedStatement->bindParam( ":sex", $mixed_sexIn );
		$object_dbPreparedStatement->bindParam( ":eMail", $mixed_emailIn );
		$object_dbPreparedStatement->bindParam( ":pCode", $mixed_postalCodeIn );
		$object_dbPreparedStatement->bindParam( ":bDate", $mixed_birthDateIn );

		// Query the db
		$object_dbPreparedStatement->execute();
		
		$integer_rowsAffected = $object_dbPreparedStatement->rowCount();

		// Disconnect from the Database
		$object_dbConnection = null;
		unset( $object_dbConnection );
		
		// Make sure the user's Profile was properly updated
		if( $integer_rowsAffected != 1 ) {
			return (int)-11;
		}// end if

		// Update User Properties
		$this->setUID( $mixed_userIDIn );
		$this->setUsername( $mixed_usernameIn );
		$this->setGID( $mixed_groupIDIn );
		$this->setFirstName( $mixed_firstNameIn );
		$this->setLastName( $mixed_lastNameIn );
		$this->setSex( $mixed_sexIn );
		$this->setEmail( $mixed_emailIn );
		$this->setPostalCode( $mixed_postalCodeIn );
		$this->setBirthDate( $mixed_birthDateIn );
		
		// Save User Properties to the Session
		$this->SaveSession();

		// Return errorcode 0 to show successfull Profile Update.
		return (int)0;
	}// end UpdateProfile method

	/**
	 * This method will log-out the user by completely destroying and
	 * then recreating a new, empty Session.
	 */
	public function Logout() {
		// Overwrite the global session array
		$_SESSION = (array) Array();

		// Check to see if PHP is using cookie-based sessions (Probably)
		if( ini_get("session.use_cookies") ) {
			// Get the current set of cookie options
			$array_cookieOptions = (array) session_get_cookie_params();

			// Overwrite the session cookie with no data
			setcookie(
				session_name(),
				'',
				time() - 42000,
				$array_cookieOptions["path"],
				$array_cookieOptions["domain"],
				$array_cookieOptions["secure"],
				$array_cookieOptions["httponly"]
			);// end call to setcookie
		}

		// Unregister the session
		session_destroy();
	}// end Logout method
}// end User class
?>
