<?php ini_set("display_errors", true); require_once ("header.php"); ?>

<div class="container" role="main">

	<div class="jumbotron">
		<h1>How to use...</h1>
		<p>Follow the three steps below to obtain a random problem, solve it and submit the solution.</p>
	</div>

	<?php require_once("classes/request.php"); ?>
	<?php require_once("classes/solver.php"); ?>

	<?php 

		$response = ( new Request() ) 
			-> get( "http://jsonplaceholder.typicode.com/posts/1" )
			-> validate();

		echo "<pre>";
		print_r($response);
		echo "</pre>";
	?>

</div>

<?php require_once ("footer.php"); ?>