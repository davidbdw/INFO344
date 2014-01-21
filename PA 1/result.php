<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">
<HTML>
   <HEAD>
      <TITLE>NBA Player Search</TITLE>
   	  <link rel="stylesheet" type="text/css" href="index.css">
   </HEAD>
   <BODY>
      <img src="nbamap.jpg" alt="NBA logo">
      <br />
      <?php
		$getName = $_GET['user'];
		
		if ($getName == NULL) { ?>
			<p id="notSetMessage">Please enter in a player name!</p>
			<form name="input" action="result.php" method="get">
	  			Search NBA Player: <input type="text" name="user">
	  			<input name="playerName" type="submit" value="Search">
	  		</form>
		<?php
			die();
		}
		
		$nameArray = explode(" ", $getName);
		$playerFName = $nameArray[0];
		$playerLName = $nameArray[1];
		?>
		
		<p id="pageTitle"><u>Player Results</u></p>
		<p id="searchMessage">You searched for: <?php print $playerFName.' '.$playerLName; ?></p>
		
		<?php 
		$username = 'info344user';
		$password = 'yijianlian11';
		
		try  {
			$connect = new PDO('mysql:host=mydbinstance.civknv3nunvi.us-west-2.rds.amazonaws.com; dbname=mydb',
			 $username, $password);
			$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
			$query = "SELECT * FROM NBAPlayers WHERE playerName LIKE '%{$playerFName}%' AND playerName LIKE '%{$playerLName}%'";
				
			$data = $connect->prepare($query);
			$data->execute();
			$datarows = $data->fetchAll();
			?>
			
			<table id="resultTable" align="center" border="4">
				<tr><th>Player Name</th><th>GP (Games Played)</th><th>FGP (Field Goal Percentage)
				</th><th>TPP (Three-Point Percentage)</th><th>FTP (Free Throw Percentage)</th>
				<th>PPG (Points Per Game)</th></tr>
				<?php 	
					foreach($datarows as $row) { 
						print "<tr><td>".$row['playerName']."</td><td>".$row['gp']."</td><td>".$row['fgp']."</td><td>".
						$row['tpp']."</td><td>".$row['ftp']."</td><td>".$row['ppg']."</td></tr>";
					}
				?>
				
			</table>
			<br />
			<form name="input" action="result.php" method="get">
	  			Search NBA Player: <input type="text" name="user">
	  			<input name="playerName" type="submit" value="Search">
	  		</form>
			
		<?php 
		} catch (PDOException $e) {
			echo 'ERROR: ' . $e->getMessage();
		}
		?>
   </BODY>
</HTML>


