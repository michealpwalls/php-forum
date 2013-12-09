<?php
/*
 *      tester_validator.php
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

?>
<!DOCTYPE html>

<html lang="en">

	<head>
		<title>Tester for Validator object</title>
		<meta charset="UTF-8">
		<meta name="generator" content="Geany 0.20">
	</head>

	<body>
		<em><u>No tests (Should all be no)</u></em><br>
<?php
	include( "validator.php" );
	$object_validator = new Validator(001);
?>
		Is 001 a Single Digit number?
<?php
	if( $object_validator->isSingleDigit() ) {
		echo( "<strong><em><font color=\"red\">Yes!</font></em></strong>\n<br>" );
	} else {
		echo( "<strong><font color=\"green\">Nope!</font></em></strong>\n<br>" );
	}
?>
		Is 'ABC1' a Number?
<?php
	$object_validator->setUserInput('ABC1');

	if( $object_validator->isNumber() ) {
		echo( "<strong><em><font color=\"red\">Yes!</font></em></strong>\n<br>" );
	} else {
		echo( "<strong><font color=\"green\">Nope!</font></em></strong>\n<br>" );
	}
?>
		Is 1.5 a Whole Number?
<?php
	$object_validator->setUserInput(1.5);

	if( $object_validator->isWholeNumber() ) {
		echo( "<strong><em><font color=\"red\">Yes!</font></em></strong>\n<br>" );
	} else {
		echo( "<strong><font color=\"green\">Nope!</font></em></strong>\n<br>" );
	}
?>
		Is 123 a Single Digit?
<?php
	$object_validator->setUserInput(123);

	if( $object_validator->isSingleDigit() ) {
		echo( "<strong><em><font color=\"red\">Yes!</font></em></strong>\n<br>" );
	} else {
		echo( "<strong><font color=\"green\">Nope!</font></em></strong>\n<br>" );
	}
?>
		Is 'ABC' a Character?
<?php
	$object_validator->setUserInput('ABC');

	if( $object_validator->isChar() ) {
		echo( "<strong><em><font color=\"red\">Yes!</font></em></strong>\n<br>" );
	} else {
		echo( "<strong><font color=\"green\">Nope!</font></em></strong>\n<br>" );
	}
?>
		Is 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' a Small String?
<?php
	$object_validator->setUserInput('ABCDEFGHIJKLMNOPQRSTUVWXYZ');

	if( $object_validator->isSmallString() ) {
		echo( "<strong><em><font color=\"red\">Yes!</font></em></strong>\n<br>" );
	} else {
		echo( "<strong><font color=\"green\">Nope!</font></em></strong>\n<br>" );
	}
?>
		Is 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' a Tiny String?
<?php
	$object_validator->setUserInput('ABCDEFGHIJKLMNOPQRSTUVWXYZ');

	if( $object_validator->isTinyString() ) {
		echo( "<strong><em><font color=\"red\">Yes!</font></em></strong>\n<br>" );
	} else {
		echo( "<strong><font color=\"green\">Nope!</font></em></strong>\n<br>" );
	}
?>
		Is 'bad6name' a Username?
<?php
	$object_validator->setUserInput('bad6name');

	if( $object_validator->isUsername() ) {
		echo( "<strong><em><font color=\"red\">Yes!</font></em></strong>\n<br>" );
	} else {
		echo( "<strong><font color=\"green\">Nope!</font></em></strong>\n<br>" );
	}
?>
		Is 'bad' a Username?
<?php
	$object_validator->setUserInput('bad');

	if( $object_validator->isUsername() ) {
		echo( "<strong><em><font color=\"red\">Yes!</font></em></strong>\n<br>" );
	} else {
		echo( "<strong><font color=\"green\">Nope!</font></em></strong>\n<br>" );
	}
?>
		Is 'shrt' a Password?
<?php
	$object_validator->setUserInput('shrt');

	if( $object_validator->isPassword() ) {
		echo( "<strong><em><font color=\"red\">Yes!</font></em></strong>\n<br>" );
	} else {
		echo( "<strong><font color=\"green\">Nope!</font></em></strong>\n<br>" );
	}
?>
		Is 'sh3t' a Password?
<?php
	$object_validator->setUserInput('sh3t');

	if( $object_validator->isPassword() ) {
		echo( "<strong><em><font color=\"red\">Yes!</font></em></strong>\n<br>" );
	} else {
		echo( "<strong><font color=\"green\">Nope!</font></em></strong>\n<br>" );
	}
?>
		Is '@badmail' an eMail address?
<?php
	$object_validator->setUserInput('@badmail');

	if( $object_validator->isEmail() ) {
		echo( "<strong><em><font color=\"red\">Yes!</font></em></strong>\n<br>" );
	} else {
		echo( "<strong><font color=\"green\">Nope!</font></em></strong>\n<br>" );
	}
?>
		Is 'badmail.com' an eMail address?
<?php
	$object_validator->setUserInput('badmail.com');

	if( $object_validator->isEmail() ) {
		echo( "<strong><em><font color=\"red\">Yes!</font></em></strong>\n<br>" );
	} else {
		echo( "<strong><font color=\"green\">Nope!</font></em></strong>\n<br>" );
	}
?>
		Is '@badmail.com' an eMail address?
<?php
	$object_validator->setUserInput('@badmail.com');

	if( $object_validator->isEmail() ) {
		echo( "<strong><em><font color=\"red\">Yes!</font></em></strong>\n<br>" );
	} else {
		echo( "<strong><font color=\"green\">Nope!</font></em></strong>\n<br>" );
	}
?>
		Is '1@badmail.com' an eMail address?
<?php
	$object_validator->setUserInput('1@badmail.com');

	if( $object_validator->isEmail() ) {
		echo( "<strong><em><font color=\"red\">Yes!</font></em></strong>\n<br>" );
	} else {
		echo( "<strong><font color=\"green\">Nope!</font></em></strong>\n<br>" );
	}
?>
		Is '123456' a U.S Zip Code?
<?php
	$object_validator->setUserInput('123456');

	if( $object_validator->isZipCode() ) {
		echo( "<strong><em><font color=\"red\">Yes!</font></em></strong>\n<br>" );
	} else {
		echo( "<strong><font color=\"green\">Nope!</font></em></strong>\n<br>" );
	}
?>
		Is 'D4L-2B3' a Canadian Code?
<?php
	$object_validator->setUserInput('D4L-2B3');

	if( $object_validator->isPostalCode() ) {
		echo( "<strong><em><font color=\"red\">Yes!</font></em></strong>\n<br>" );
	} else {
		echo( "<strong><font color=\"green\">Nope!</font></em></strong>\n<br>" );
	}
?>
		<br><br><em><u>Yes tests (Should all be Yes)</u></em><br>
		Is 'L4N 7N1' a Canadian Postal Code?
<?php
	$object_validator->setUserInput('L4N 7N1');

	if( $object_validator->isPostalCode() ) {
		echo( "<strong><em><font color=\"green\">Yes!</font></em></strong>\n<br>" );
	} else {
		echo( "<strong><font color=\"red\">Nope!</font></em></strong>\n<br>" );
	}
?>
		Is 'L4N-7N1' a Canadian Postal Code?
<?php
	$object_validator->setUserInput('L4N-7N1');

	if( $object_validator->isPostalCode() ) {
		echo( "<strong><em><font color=\"green\">Yes!</font></em></strong>\n<br>" );
	} else {
		echo( "<strong><font color=\"red\">Nope!</font></em></strong>\n<br>" );
	}
?>
		Is 'L4N7N1' a Canadian Postal Code?
<?php
	$object_validator->setUserInput('L4N7N1');

	if( $object_validator->isPostalCode() ) {
		echo( "<strong><em><font color=\"green\">Yes!</font></em></strong>\n<br>" );
	} else {
		echo( "<strong><font color=\"red\">Nope!</font></em></strong>\n<br>" );
	}
?>
		Is '123456789' a U.S Zip Code?
<?php
	$object_validator->setUserInput('123456789');

	if( $object_validator->isZipCode() ) {
		echo( "<strong><em><font color=\"green\">Yes!</font></em></strong>\n<br>" );
	} else {
		echo( "<strong><font color=\"red\">Nope!</font></em></strong>\n<br>" );
	}
?>
		Is '12345 6789' a U.S Zip Code?
<?php
	$object_validator->setUserInput('12345 6789');

	if( $object_validator->isZipCode() ) {
		echo( "<strong><em><font color=\"green\">Yes!</font></em></strong>\n<br>" );
	} else {
		echo( "<strong><font color=\"red\">Nope!</font></em></strong>\n<br>" );
	}
?>
		Is '12345-6789' a U.S Zip Code?
<?php
	$object_validator->setUserInput('12345-6789');

	if( $object_validator->isZipCode() ) {
		echo( "<strong><em><font color=\"green\">Yes!</font></em></strong>\n<br>" );
	} else {
		echo( "<strong><font color=\"red\">Nope!</font></em></strong>\n<br>" );
	}
?>
		Is 'goodname@gooddomain.com' an eMail Address?
<?php
	$object_validator->setUserInput('goodname@gooddomain.com');

	if( $object_validator->isEmail() ) {
		echo( "<strong><em><font color=\"green\">Yes!</font></em></strong>\n<br>" );
	} else {
		echo( "<strong><font color=\"red\">Nope!</font></em></strong>\n<br>" );
	}
?>
		Is 'goodname@gooddomain.co.uk' an eMail Address?
<?php
	$object_validator->setUserInput('goodname@gooddomain.co.uk');

	if( $object_validator->isEmail() ) {
		echo( "<strong><em><font color=\"green\">Yes!</font></em></strong>\n<br>" );
	} else {
		echo( "<strong><font color=\"red\">Nope!</font></em></strong>\n<br>" );
	}
?>
		Is '200250645@student.georgianc.on.ca' an eMail Address?
<?php
	$object_validator->setUserInput('200250645@student.georgianc.on.ca');

	if( $object_validator->isEmail() ) {
		echo( "<strong><em><font color=\"green\">Yes!</font></em></strong>\n<br>" );
	} else {
		echo( "<strong><font color=\"red\">Nope!</font></em></strong>\n<br>" );
	}
?>
		Is 'butts@butts.com' an eMail Address?
<?php
	$object_validator->setUserInput('butts@butts.com');

	if( $object_validator->isEmail() ) {
		echo( "<strong><em><font color=\"green\">Yes!</font></em></strong>\n<br>" );
	} else {
		echo( "<strong><font color=\"red\">Nope!</font></em></strong>\n<br>" );
	}
?>
		Is 'Goodpassword' a Password?
<?php
	$object_validator->setUserInput('Goodpassword');

	if( $object_validator->isPassword() ) {
		echo( "<strong><em><font color=\"green\">Yes!</font></em></strong>\n<br>" );
	} else {
		echo( "<strong><font color=\"red\">Nope!</font></em></strong>\n<br>" );
	}
?>
		Is '123ÃÃ34St45ron(*&g-_.Pass\'' a Password?
<?php
	$object_validator->setUserInput('1233ÃÃ4St45ron(*&g-_.Pass\'');

	if( $object_validator->isPassword() ) {
		echo( "<strong><em><font color=\"green\">Yes!</font></em></strong>\n<br>" );
	} else {
		echo( "<strong><font color=\"red\">Nope!</font></em></strong>\n<br>" );
	}
?>
		Is 1 a Number?
<?php
	$object_validator->setUserInput(1);

	if( $object_validator->isNumber() ) {
		echo( "<strong><em><font color=\"green\">Yes!</font></em></strong>\n<br>" );
	} else {
		echo( "<strong><font color=\"red\">Nope!</font></em></strong>\n<br>" );
	}
?>
		Is 1 a Whole Number?
<?php
	$object_validator->setUserInput(1);

	if( $object_validator->isWholeNumber() ) {
		echo( "<strong><em><font color=\"green\">Yes!</font></em></strong>\n<br>" );
	} else {
		echo( "<strong><font color=\"red\">Nope!</font></em></strong>\n<br>" );
	}
?>
		Is 1 a Single Digit Number?
<?php
	$object_validator->setUserInput(1);

	if( $object_validator->isSingleDigit() ) {
		echo( "<strong><em><font color=\"green\">Yes!</font></em></strong>\n<br>" );
	} else {
		echo( "<strong><font color=\"red\">Nope!</font></em></strong>\n<br>" );
	}
?>
		Is 'ABC' a String?
<?php
	$object_validator->setUserInput('ABC');

	if( $object_validator->isString() ) {
		echo( "<strong><em><font color=\"green\">Yes!</font></em></strong>\n<br>" );
	} else {
		echo( "<strong><font color=\"red\">Nope!</font></em></strong>\n<br>" );
	}
?>
		Is 'ABC123' a String?
<?php
	$object_validator->setUserInput('ABC123');

	if( $object_validator->isString() ) {
		echo( "<strong><em><font color=\"green\">Yes!</font></em></strong>\n<br>" );
	} else {
		echo( "<strong><font color=\"red\">Nope!</font></em></strong>\n<br>" );
	}
?>
		Is 'A' a Character?
<?php
	$object_validator->setUserInput('A');

	if( $object_validator->isChar() ) {
		echo( "<strong><em><font color=\"green\">Yes!</font></em></strong>\n<br>" );
	} else {
		echo( "<strong><font color=\"red\">Nope!</font></em></strong>\n<br>" );
	}
?>
		Is 'ABCDEFGHIJKLMNOPQRST' a Small String?
<?php
	$object_validator->setUserInput('ABCDEFGHIJKLMNOPQRST');

	if( $object_validator->isSmallString() ) {
		echo( "<strong><em><font color=\"green\">Yes!</font></em></strong>\n<br>" );
	} else {
		echo( "<strong><font color=\"red\">Nope!</font></em></strong>\n<br>" );
	}
?>
		Is 'ABC' a Tiny String?
<?php
	$object_validator->setUserInput('ABCDE');

	if( $object_validator->isTinyString() ) {
		echo( "<strong><em><font color=\"green\">Yes!</font></em></strong>\n<br>" );
	} else {
		echo( "<strong><font color=\"red\">Nope!</font></em></strong>\n<br>" );
	}
?>
		Is 'Goodname' a Username?
<?php
	$object_validator->setUserInput('Goodname');

	if( $object_validator->isUsername() ) {
		echo( "<strong><em><font color=\"green\">Yes!</font></em></strong>\n<br>" );
	} else {
		echo( "<strong><font color=\"red\">Nope!</font></em></strong>\n<br>" );
	}
?>
		Is 'Goodname-_.' a Username?
<?php
	$object_validator->setUserInput('Goodname-_.');

	if( $object_validator->isUsername() ) {
		echo( "<strong><em><font color=\"green\">Yes!</font></em></strong>\n<br>" );
	} else {
		echo( "<strong><font color=\"red\">Nope!</font></em></strong>\n<br>" );
	}
?>
	</body>

</html>
