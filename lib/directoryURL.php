<?php
/*
 * directoryURL.php	-	mpw-forum v0.1
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
	 * This method will return the URL of the current directory send_email.php is run from
	 * 
	 * @return a string representing the URL of the current working directory, sort of.
	 */
	function directoryURL() {
		$directoryURL = 'http';

		//If the protocol is HTTPS, append an s to the http
		if ($_SERVER["HTTPS"] == "on") {
			$pageURL .= "s";
		}

		$directoryURL .= "://";

		//If the port connected to is not the standard port 80, append the required colon and port number to the domain name
		if( $_SERVER["SERVER_PORT"] != "80" ) {
			$directoryURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . dirname( $_SERVER['SCRIPT_NAME'] );
		} else {
			$directoryURL .= $_SERVER["SERVER_NAME"] . dirname( $_SERVER['SCRIPT_NAME'] );
		}

		return $directoryURL;
	}
?>
