<!doctype html>
<html lang="en-au">
    <head>
        <title>Vacation schedule</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=Edge;chrome=1" >
		<link rel="stylesheet" href="http://code.jquery.com/ui/jquery-ui-git.css" />
		<link rel="stylesheet" href="jQuery.Gantt/css/style.css" />
		<link rel="stylesheet" href="jQuery.Gantt/css/bootstrap.css" />
		<link rel="stylesheet" href="jQuery.Gantt/css/prettify.css" />
		<style type="text/css">
			body {
				font-family: Helvetica, Arial, sans-serif;
				font-size: 13px;
				padding: 0 0 50px 0;
			}
			.contain {
				width: 800px;
				margin: 0 auto;
			}
			h1 {
				margin: 40px 0 20px 0;
			}
			h2 {
				font-size: 1.5em;
				padding-bottom: 3px;
				border-bottom: 1px solid #DDD;
				margin-top: 50px;
				margin-bottom: 25px;
			}
			table th:first-child {
				width: 150px;
			}
		</style>
    </head>
    <body>

		<div class="contain">
			<!-- Gantt graph -->
			<div class="gantt"></div>
			<!-- Form to populate graph -->
			<form action="add.php" method="post">
			<table>
			<tr>
			<td>
				Name:
			</td>
			<td>
				<input type="text" name="name" />
			</td>
			</tr>
			<tr>
			<td>
				Destination (optional):
			</td>
			<td>
				<input name="destination" type="text"/>
			</td>
			</tr>
			<tr>
			<td>
				Start date:
			</td>
			<td>
				<div id="calendar"/>
					<input id="startdate" name="startdate" type="text"/>
				</div>
			</td>
			</tr>
			<tr>
			<td>
				End date:
			</td>
			<td>
				<div id="calendar2"/>
					<input id="enddate" name="enddate" type="text"/>
				</div>
			</td>
			</tr>

			</table>
				<input type="submit" value="Submit" />
			</form>
		Edit <a href="phpliteadmin.php?action=row_view&table=vacations">database</href>.
		</div>

    </body>
	<script src="http://code.jquery.com/jquery.min.js"></script>
	<script src="http://code.jquery.com/ui/jquery-ui-git.js"></script>
	<script src="http://twitter.github.com/bootstrap/assets/js/bootstrap-tooltip.js"></script>
	<script src="http://twitter.github.com/bootstrap/assets/js/bootstrap-popover.js"></script>
	<script src="jQuery.Gantt/js/jquery.fn.gantt.js"></script>
	<script src="jQuery.Gantt/js/prettify.js"></script>
    <script>
		$(function() {

			"use strict";

			$(".gantt").gantt({
				source: [
				<?php
				// Grab data from sqlite database and create entries for gantt table
				$dbhandle = new SQLite3('database/vacation.sqlite');
				//CREATE TABLE vacations(id INTEGER PRIMARY KEY NOT NULL default 1 , name TEXT, destination TEXT, startdate INTEGER, enddate INTEGER)
				if (!$dbhandle) die ($error);
				$counter=0;
				//$dbhandle -> exec($stm);
				$result = $dbhandle->query('SELECT * FROM vacations');
				while($res = $result->fetchArray(SQLITE3_ASSOC)){
					if ($counter !=0){
						echo(",");
					}
					echo("{");
					echo(' name: "'.$res['name'].'",');
					echo(' desc: "'.$res['destination'].'",');
					echo(" values: [{");
					echo(' from: "/Date('.$res['startdate'].'000)/",');
					echo(' to: "/Date('.$res['enddate'].'000)/",');
					echo(' label: "Vacation",customClass: "ganttRed",');
					echo("}]}");
					$counter++;
				}

				$dbhandle -> close();
				if ($counter === 0){
					// Show entry for today so we have a functional Gannt table
					
					echo("{");
					echo(' name: "Today",');
					echo(' desc: "",');
					echo(" values: [{");
					echo(' from: "/Date('.time().'000)/",');
					echo(' to: "/Date('.time().'000)/",');
					echo(' label: "Today",customClass: "ganttBlue",');
					echo("}]}");
				}
				?>
				],
				navigate: "scroll",
				scale: "weeks",
				maxScale: "months",
				minScale: "days",
				itemsPerPage: 10
			});
			$("div#calendar").datepicker({ altField: 'input#startdate', altFormat: 'yy-mm-dd' });
			$("div#calendar2").datepicker({ altField: 'input#enddate', altFormat: 'yy-mm-dd' });
			prettyPrint();

		});

		</script>
		</script>
</html>
