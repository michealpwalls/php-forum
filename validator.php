<?php
/*
 *      validator.php
 *      
 *      Copyright 2013 Micheal Walls <michealpwalls@gmail.com>
 *      
 *      This program is free software; you can redistribute it and/or modify
 *      it under the terms of the GNU General Public License as published by
 *      the Free Software Foundation; either version 2 of the License, or
 *      (at your option) any later version.
 *      
 *      This program is distributed in the hope that it will be useful,
 *      but WITHOUT ANY WARRANTY; without even the implied warranty of
 *      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *      GNU General Public License for more details.
 *      
 *      You should have received a copy of the GNU General Public License
 *      along with this program; if not, write to the Free Software
 *      Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 *      MA 02110-1301, USA.
 *      
 *      
 */

/**
 * @author Micheal Walls
 */
class Validator {
	
	// instance variable
	private $mixed_userInput;
	
	/**
	 * This is the default Constructor for Validator objects.
	 * 
	 * @param Mixed User input to be validated
	 */
	function _construct( $mixed_userInput ) {
		$this->setUserInput( $mixed_userInput );
	}// end Validator Constructor
	
	/**
	 * Setter for mixed_userInput property.
	 * Use of Trim function strips Whitespaces, Tabs and Newline characters
	 * 
	 * @param Mixed user input to be set
	 */
	public function setUserInput( $mixed_userInput ) {
		$this->mixed_userInput = trim( $mixed_userInput );
	}// end setUserInput method
	
	/**
	 * Getter for mixed_userInput property
	 * 
	 * @return Mixed user input
	 */
	public function getUserInput() {
		return $this->mixed_userInput;
	}// end setUserInput method
	
	/**
	 * This method will test the user input to validate it as a String.
	 * 
	 * @return boolean True if the userInput is a String, false if it is not. Returns false if string is empty.
	 */
	public function isString() {
		$string_validationPattern = "/^[a-z0-9,\._\-'\";:\/\\\[\]\{\}\^\$\(\)\?\*\+&%#@!`\~]+$/i";
		if( preg_match($string_validationPattern, $this->getUserInput()) ) {
			return (bool)true;
		} else {
			return (bool)false;
		}// end if
	}// end isString method
	
	/**
	 * This method will test the user input to validate it as a Date String.
	 * Date Strings are in the Format: YYYY-MM-DD
	 * 
	 * @return boolean True if the userInput is a valid Date String, False if otherwise.
	 */
	public function isDateString() {
		$string_validationPattern = "/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/";
		if( preg_match($string_validationPattern, $this->getUserInput()) ) {
			return (bool)true;
		} else {
			return (bool)false;
		}// end if
	}// end isDateString method
	
	/**
	 * This method will test the user input to validate it as a Small String
	 * Small Strings are strings with 20 characters or less.
	 * 
	 * @return boolean True if the userInput is a Small String, false if it is not. Returns false if string is empty.
	 */
	public function isSmallString() {
		if( $this->isString() && strlen($this->getUserInput()) <= 20 ) {
			return (bool)true;
		} else {
			return (bool)false;
		}// end if
	}// end isSmallString method
	
	/**
	 * This method will test the user input to validate it as a Tiny String
	 * Tiny Strings are strings with 5 characters or less.
	 * 
	 * @return boolean True if the userInput is a Tiny String, false if it is not.
	 * @return boolean False if input is empty.
	 * @return boolean False if input is single Whitespace, Tab or Newline
	 */
	public function isTinyString() {
		if( $this->isString() && strlen($this->getUserInput()) <= 5 ) {
			return (bool)true;
		} else {
			return (bool)false;
		}// end if
	}// end isTinyString method
	
	/**
	 * This method will test the user input to validate it as a singe Character.
	 * 
	 * @return boolean True if the userInput is a single Character, false if it is not.
	 * @return boolean False if input is empty.
	 * @return boolean False if input is single Whitespace, Tab or Newline
	 */
	public function isChar() {
		if( $this->isString() && strlen($this->getUserInput()) == 1 ) {
			return (bool)true;
		} else {
			return (bool)false;
		}// end if
	}// end isChar method
	
	/**
	 * This method will test the user input to validate it as a Number.
	 * Numbers (In this context) cannot be negative.
	 * 
	 * @return boolean True if the userInput is a Number, false if it is not.
	 * @return boolean False if input is empty.
	 * @return boolean False if input is single Whitespace, Tab or Newline
	 */
	public function isNumber() {
		$string_validationPattern = "/^[0-9\.]+$/";
		if( preg_match($string_validationPattern, $this->getUserInput()) ) {
			return (bool)true;
		} else {
			return (bool)false;
		}// end if
	}// end isNumber method
	
	/**
	 * This method will test the user input to validate it as a Whole Number.
	 * Whole Numbers cannot be negative.
	 * 
	 * @return boolean True if the userInput is a Whole Number, false if it is not.
	 * @return boolean False if input is empty.
	 * @return boolean False if input is single Whitespace, Tab or Newline
	 */
	public function isWholeNumber() {
		$string_validationPattern = "/^[0-9]+$/";
		if( preg_match($string_validationPattern, $this->getUserInput()) ) {
			return (bool)true;
		} else {
			return (bool)false;
		}// end if
	}// end isWholeNumber method
	
	/**
	 * This method will test the user input to validate it as a Small Number.
	 * Small Numbers are numbers with 3 digits or less and not negative.
	 * 
	 * @return boolean True if the userInput is a Small Number, false if it is not.
	 * @return boolean False if input is empty.
	 * @return boolean False if input is single Whitespace, Tab or Newline
	 */
	public function isSmallNumber() {
		if( $this->isWholeNumber() && ($this->getUserInput() <= 999) ) {
			return (bool)true;
		} else {
			return (bool)false;
		}// end if
	}// end isSmallNumber method
	
	/**
	 * This method will test the user input to validate it as a Single Digit.
	 * Single Digits are Whole Numbers and cannot be negative.
	 * 
	 * @return boolean True if the userInput is a Single Digit, false if it is not.
	 * @return boolean False if input is empty.
	 * @return boolean False if input is single Whitespace, Tab or Newline
	 */
	public function isSingleDigit() {
		if( $this->isWholeNumber() && ($this->getUserInput() <= 9) ) {
			return (bool)true;
		} else {
			return (bool)false;
		}// end if
	}// end isSingleDigit method
	
	/**
	 * This method will test the user input to validate it as a Username.
	 * Valid Usernames are Alphabetical strings including underscores, perdiods and hyphens.
	 * Valid Usernames must be in the character range: 4 - 75
	 * 
	 * @return boolean True if the userInput is a valid Username, False if otherwise.
	 */
	public function isUsername() {
		$string_validationPattern = "/^[a-z_\-\.]{4,75}$/i";
		if( preg_match($string_validationPattern, $this->getUserInput()) ) {
			return (bool)true;
		} else {
			return (bool)false;
		}// end if
	}// end isUsername method
	
	/**
	 * This method will test the user input to validate it as a Password.
	 * Valid Passwords are "anything-goes", but must be in the character range: 3 - 250
	 * 
	 * Technically, "anything-goes" is any character from the Greek and Latin Unicode sets.
	 * 
	 * @return boolean True if the userInput is a valid Password, False if otherwise.
	 */
	public function isPassword() {
		$string_validationPattern = "/^[\P{Greek}\P{Latin}]{3,250}$/i";
		if( preg_match($string_validationPattern, $this->getUserInput()) ) {
			return (bool)true;
		} else {
			return (bool)false;
		}// end if
	}// end isPassword method
	
	/**
	 * This method will test the user input to validate it as an eMail Address.
	 * Valid email addresses are [alphanumeric with periods, underscores and hyphens]@[alphanumeric with periods].[alphanumeric]
	 * 
	 * @return boolean True if the userInput is a valid eMail, False if otherwise.
	 */
	public function isEmail() {
		$string_validationPattern = "/^([a-zA-Z0-9\.\-_]{2,50})@([a-zA-Z0-9\.]{3,50})(\.)([a-zA-Z0-9.]{2,7})$/i";
		if( preg_match($string_validationPattern, $this->getUserInput()) ) {
			return (bool)true;
		} else {
			return (bool)false;
		}// end if
	}// end isEmail method
	
	/**
	 * This method will test the user input to validate it as a valid Action.
	 * Valid Actions are Alphabetic strings in the character range: 3 - 50
	 * 
	 * @return boolean True if the userInput is a valid Action, False if otherwise.
	 */
	public function isAction() {
		$string_validationPattern = "/^[a-z]{3,50}$/i";
		if( preg_match($string_validationPattern, $this->getUserInput()) ) {
			return (bool)true;
		} else {
			return (bool)false;
		}// end if
	}// end isAction method

	/**
	 * This method will test the user input to validate it as a 9 digit U.S Zip Code.
	 * Valid zipcodes are in the formats: #####-####, ##### ####, #########
	 * 
	 * @return boolean True if the userInput is a valid U.S Zip Code, False if otherwise.
	 */
	public function isZipCode() {
		$string_validationPattern = "/^(([0-9]{5})((\-)|( ))([0-9]{4}))|(([0-9]{5})([0-9]{4}))$/";
		if( preg_match($string_validationPattern, $this->getUserInput()) ) {
			return (bool)true;
		} else {
			return (bool)false;
		}// end if
	}// end isZipCode method
	
	/**
	 * This method will test the user input to validate it as a Canadian Postal Code.
	 * Canadian Postal Codes are in the formats: A1B-C2E, A1B C2E, A1BC2E
	 * 
	 * @return boolean True if the userInput is a valid CDN Postal Code, False if otherwise.
	 */
	public function isPostalCode() {
		$string_validationPattern = "/^([ABCEGHJKLMNPRSTVXYabceghjklmnprstvxy]{1}[0-9]{1}[A-Za-z]{1}((\-)|( ))[0-9]{1}[A-Za-z]{1}[0-9]{1})|([ABCEGHJKLMNPRSTVXYabceghjklmnprstvxy]{1}[0-9]{1}[A-Za-z]{1}[0-9]{1}[A-Za-z]{1}[0-9]{1})$/i";
		if( preg_match($string_validationPattern, $this->getUserInput()) ) {
			return (bool)true;
		} else {
			return (bool)false;
		}// end if
	}// end isPostalCode method
	
	/**
	 * This method will test the user input to validate it as a Name.
	 * 
	 * @return boolean True if the userInput is a valid Name, False if otherwise.
	 */
	public function isName() {
		$string_validationPattern = "/^[\P{Greek}\P{Latin}]{2,75}$/i";
		if( preg_match($string_validationPattern, $this->getUserInput()) ) {
			return (bool)true;
		} else {
			return (bool)false;
		}// end if
	}// end isName method
	
}// end Validator Class
?>
