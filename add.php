<?php
			// Add entered data into database
			if (isset($_POST['name']) && $_POST['name'] != ""){

				$dbhandle = new SQLite3('database/vacation.sqlite');
				//CREATE TABLE vacations(id INTEGER PRIMARY KEY NOT NULL default 1 , name TEXT, destination TEXT, startdate INTEGER, enddate INTEGER)
				if (!$dbhandle) die ($error);

				$name_es	= SQLite3::escapeString($_POST['name']);
				$destination_es	= SQLite3::escapeString($_POST['destination']);
				$startdate_es	= strtotime($_POST['startdate']);
				$enddate_es	= strtotime($_POST['enddate']);
				// Add 12 hours to dates, otherwise they are at midnight
				$startdate_es	+= (12*60*60);
				$enddate_es	+= (12*60*60);
				$stm = "INSERT INTO vacations VALUES(NULL,'$name_es', '$destination_es','$startdate_es','$enddate_es')";
				$dbhandle -> exec($stm);
				$dbhandle -> close();
				header( 'location:vacation.php' );
			}
?>

