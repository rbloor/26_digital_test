<?php require_once("config.php"); ?>
<?php require_once ("header.php"); ?>

<div class="container" role="main">

	<h1>26 Digital Technical Test</h1>

	<hr>

	<?php 
		$request = ( new Request( STAGING_URL ) ) -> get();
		if ( $request -> validate() ) {
			$parser = ( new Parser( $request ) ) -> parse();
			$solver = ( new Solver( $parser ) ) -> solve();
			$response = ( new Request( STAGING_URL . $parser->parsed_data->endpoint . $solver->answer ) ) -> get();
			$response_parser = ( new Parser( $response ) ) -> parse();
		}
	?>
			
	<h3 class="text-primary">Problem</h3>
	
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
				<td><?php echo implode(", ", $parser->parsed_data->challenge->arguments); ?></td>
				<td><?php echo $parser->parsed_data->endpoint; ?></td>
			</tr>
		</tbody>
	</table>

	<h3 class="text-primary">Solution</h3>

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
				<td><?php echo (stripos($response_parser->raw_data, "Correct!") !== false) ? 'Correct' : 'Wrong'; ?></td>
			</tr>
		</tbody>
	</table>

	<a href="<?php echo $_SERVER['REQUEST_URI']; ?>" class="btn btn-success btn-md pull-right">Start again</a>

</div>

<?php require_once ("footer.php"); ?>