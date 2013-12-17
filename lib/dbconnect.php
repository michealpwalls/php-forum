<?php
/*
 * dbconnect.php -		mpw-forum v0.1
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
	 
	// Array of options to be passed through the PDO constructor.
	$array_dbOptions = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'");

	try {
		// Connect to the Database
		$object_dbConnection = new PDO( "mysql:localhost;dbname=db200250645", "db200250645", "24244" );

		// Manually set the character encoding just in case.
		$object_dbConnection->exec( "SET NAMES utf8" );
		
		// Manually set the DB just in case.
		$object_dbConnection->exec( "USE db200250645" );
		
	// Catch exceptions thrown by PDO to prevent leaking information
	} catch( PDOException $object_dbException ) {
		$object_dbConnection = null;
	}
?>
