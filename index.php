<?php
	include("header.php");
	echo "<center><h3>Random Mobile Number Generator</h3></center>";
	echo "<center><h4>This webpage generates entries of random ten digit numbers along with associated random strings.</h4></center>";
	echo "<br>";
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="robots" content="noindex" />
		<title>Random Number Generator</title>
		<link rel="stylesheet" href="style.css" />
	</head>
	<header>
			<div class="cont">
			<?php
				echo '
				<nav class="navbar navbar-inverse navbar-fixed-top">
					<div class="container">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand" href="#">Random Number Generator</a>
						</div>
					<div id="navbar" class="navbar-collapse collapse">
							<ul class="nav navbar-nav navbar-right">
								<li class="active"><a href="index.php">
									<span class="glyphicon glyphicon-home"></span> 
									Home</a></li>';
			?>
			</div>
		</header>
		<body>
		<div class="container">
			<form class="form-horizontal" method="POST">
				<div class="form-group">
    				<label class="control-label col-sm-2" for="input_num_total">Entries:</label>
    				<div class="col-sm-10">
      					<input type="number" name="num_total" class="form-control" id="input_num_total" placeholder="Enter number of phone numbers to be generated" required>
    				</div>
  				</div>
				<div class="form-group">
    				<div class="col-sm-offset-2 col-sm-10">
      					<button type="submit" name="submit" class="btn btn-default">Submit</button>
    				</div>
				</div>
			</form>
		</div>
		
		<div class="container">
			<table class="table table-striped">
				<?php
					//Function for generating random string
					function gen_rand_str($len) {
						$char = 'abcdefghijklmnopqrstuvwxyz';
						$charlen = strlen($char);
						$rand_str = '';
						for($i = 0; $i < $len; $i++) 
							$rand_str .= $char[random_int(0, $charlen - 1)];
						return $rand_str;
					}

					if(isset($_POST['submit']) && isset($_POST['num_total'])) {
						$num_total = $_POST['num_total'];
						if($num_total<1) {
							echo "<center><h4>Please enter positive integers only.</h4></center>";
							goto case2;
						}
					?>
						<thead>
							<tr>
								<th>Sl. No.</th>
								<th>Name</th>
								<th>Phone Number</th>
							</tr>
						</thead>
						<tbody>
					<?php
						
						$digits = 10;
						set_time_limit(600);	// 24 h = 86400

						$start_time= microtime(true);	//This is the starting time of query
						
						$rand_arr = array();
						for($i = 1; $i <= $num_total; $i++) {
							case1:
							$rand_arr[$i] = mt_rand(pow(10, $digits-1), pow(10, $digits)-1);
							$f_digit = intdiv($rand_arr[$i], $digits-1);
							if($f_digit == 0)
								goto case1;
							$num_mod = preg_replace("/^(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3", $rand_arr[$i]);

							$name_rand = gen_rand_str(15);
						
							echo '<tr>';
							echo '<td>' .$i. '</td>';
							echo '<td>' .$name_rand. '</td>';
							echo '<td>' .$num_mod. '</td>';
							echo '</tr>';
						}
						$end_time = microtime(true);
						$duration = $end_time - $start_time;

						echo "<center><h4>Time required to process query: " .$duration. " sec </h4></center>";
						case2:
				 	} ?>	
				</tbody>
			</table>
		</div>
		
	<footer class="container">
	   <?php include 'footer.php'; ?>
	</footer>
	</body>
</html>
