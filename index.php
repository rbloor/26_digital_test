<?php ini_set("display_errors", true); require_once ("header.php"); ?>

<div class="container" role="main">

	<div class="jumbotron">
		<h1>How to use...</h1>
		<p>Follow the three steps below to obtain a random problem, solve it and submit the solution.</p>
	</div>

	<?php require_once("classes/request.php"); ?>
	<?php require_once("classes/solver.php"); ?>
	<?php require_once("classes/parser.php"); ?>

	<?php 

		$endpoint_xml = "http://www.thomas-bayer.com/sqlrest/CUSTOMER/";
		$endpoint_json = "http://jsonplaceholder.typicode.com/posts/1";

		$request = new Request(); 
		$request -> get( $endpoint_xml );
		
		//$resquest -> validate();

		echo "<pre>";
		//print_r($request->data);
		echo "</pre>";

		$parser = new Parser();
		echo $parser->parse($request->data, $request->info['content_type']);

		echo "<pre>";
		print_r($parser->data);
		echo "</pre>";
	?>

</div>

<?php require_once ("footer.php"); ?>