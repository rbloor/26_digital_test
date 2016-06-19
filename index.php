<?php ini_set("display_errors", true); require_once ("header.php"); ?>

<div class="container" role="main">

	<div class="jumbotron">
		<h1>26 Digital Technical Test</h1>
		<p>Ryan Bloor</p>
	</div>

	<?php require_once("classes/request.php"); ?>
	<?php require_once("classes/solver.php"); ?>
	<?php require_once("classes/parser.php"); ?>

	<?php 
		
		$domain = 'http://tech-test.twentysixstaging.com/';

		$request = ( new Request( $domain ) ) -> get();
		
		if ( $request -> validate() ) {

			$parser = ( new Parser( $request ) ) -> parse();
			
			$solver = ( new Solver( $parser ) ) -> solve();
			
			$response = ( new Request( $domain . $parser->parsed_data->endpoint . $solver->answer ) ) -> get();

			$response_parser = ( new Parser( $response ) ) -> parse();
		}


		//echo "<pre>";
		//print_r($request);
		//print_r($parser->parsed_data->challenge->arguments);
		//print_r($solver);
		//print_r($response);
		//print_r($response_parser->raw_data);
		//echo "</pre>";

	?>

	<div class="row">
		<div class="col-md-12">
			
			<h2>Problem:</h2>
			
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Content Type</th>
						<th>Problem Type</th>
						<th>Arguments</th>
						<th>Endpoint</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><?php echo $parser->content_type; ?></td>
						<td><?php echo $parser->parsed_data->challenge->type; ?></td>
						<td>
							<?php if (!is_array($parser->parsed_data->challenge->arguments)): ?>
								<?php echo $parser->parsed_data->challenge->arguments; ?>
							<?php else: ?>
								<?php echo implode(", ", $parser->parsed_data->challenge->arguments); ?>
							<?php endif; ?>
						</td>
						<td><?php echo $parser->parsed_data->endpoint; ?></td>
					</tr>
				</tbody>
			</table>

			<h2>Solution:</h2>

			<table class="table table-striped">
				<thead>
					<tr>
						<th>Answer</th>
						<th>Endpoint</th>
						<th>Marked</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><?php echo $solver->answer; ?></td>
						<td><?php echo $parser->parsed_data->endpoint . $solver->answer; ?>
						<td><?php 
							//echo $response_parser->parsed_data->message; 
							echo (stripos($response_parser->raw_data, "Correct!") !== false) ? 'Correct' : 'Wrong';
							?>	
						</td>
					</tr>
				</tbody>
			</table>

			<hr>
			
			<a href="<?php ?>" class="btn btn-primary btn-md pull-right">Start again</a>
			
		</div>
	</div>



</div>

<?php require_once ("footer.php"); ?>