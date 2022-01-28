<?php

	declare(strict_types=1);

	require_once realpath(__DIR__ . '/vendor/autoload.php');

	$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
	$dotenv->load();

	$code = $stdin = $language = $memory = $cpuTime = $output = "";

	if(isset($_POST['getoutput'])){
		$code = $_POST['code'];
		$stdin = $_POST['stdin'];
		$language = $_POST['lang'];

		// API URL
		$url = 'https://api.jdoodle.com/v1/execute';

		// Create a new cURL resource
		$ch = curl_init($url);
		
		// Setup request to send json via POST
		$data = array(

			// Enter your client_id and client_secret from jdoodle
			"clientId" => $_ENV['CLIENT_ID'],
			"clientSecret" => $_ENV['CLIENT_SECRET'],

			// the code to execute - given by the user
			'script' => $code,

			// the input to feed to the code - given by the user
			'stdin' => $stdin,

			// language to execute the code in - chosen by the user
			'language' => $language,
			'versionIndex' => 0
		);

		
		$payload = json_encode($data);

		// Attach encoded JSON string to the POST fields
		curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

		// Set the content type to application/json
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

		// Return response instead of outputting
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		// Execute the POST request
		$result = curl_exec($ch);

		// Close cURL resource
		curl_close($ch);


		$response = json_decode($result, true);

		// Get the output from the response - after code execution
		$output = $response['output'];
		
		// Get the memory usage by the code - after code execution
		$memory = $response['memory'];
		
		// Get the cpu time from the response - after code execution
		$cpuTime = $response['cpuTime'];
	}
?>

<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
	<link rel="stylesheet" href="./style.css" />
</head>
<body>
	<div class="container"> 
		<div class=" text-center mt-3 ">
        	<h1>&lt;My Code Compiler /&gt;</h1>
    	</div>
		<div class="row ">
			<div class="col-lg-12 mx-auto">
				<div class="card mt-2 mx-auto p-4 bg-light">
					<div class="card-body bg-light">
						<div class="container">
							<form action="./mycompiler.php" method="POST" id="contact-form" role="form">
								<div class="controls">
								
									<div class="row">
										<div class="col-md-4">
											<div class="form-group"> 
												<label for="form_need">Choose language</label> 
												<select id="lang" name="lang" class="form-control" required="required">
													<option value="java"
													<?php if(isset($_POST['lang']) && $_POST['lang'] == 'java') 
														echo ' selected="selected"';
													?>
													>Java</option>
													<option value="python3"
													<?php if(isset($_POST['lang']) && $_POST['lang'] == 'python3') 
														echo ' selected="selected"';
													?>
													>Python3</option>
													<option value="c"
													<?php if(isset($_POST['lang']) && $_POST['lang'] == 'c') 
														echo ' selected="selected"';
													?>
													>C</option>
												</select> 
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
											<div class="form-group"> 
												<label for="form_message">Your Code </label> 
												<textarea id="form_message" name="code" class="form-control" placeholder="Write your code here." rows="10" col="100" autocomplete="on" required="required"><?php if(isset($_POST['code'])){echo $code;} ?></textarea> 
											</div>
											<br>
											<label for="form_inputs">Inputs: (if any)</label> 
											<br/>
											<textarea id="form_inputs" name="stdin" rows="5" cols="60"></textarea>
											<br><br>
										</div>
										<div class="col-md-12"> 
											<input name="getoutput" type="submit" class="btn btn-success btn-send pt-2 btn-block " value="Run"> 
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div> <!-- /.8 -->
			</div> <!-- /.row-->
		</div>
	</div>

	<!-- ----------------------------output div---------------------- -->
	<div class="container"  id="outputdiv">
		<div class="text-left mt-5 ">
        	<h4>Your output:</h4>
    	</div>
		
		<div class="row">
			<div class="col-lg-12 mx-auto">
				<div class="card mt-2 mx-auto p-4 bg-light">
					<div class="card-body bg-light">
						<textarea class="form-control" name="stdin" rows="4" cols="70" readonly><?php echo $output; ?></textarea>
						<br/>
						<br/>
						<h6>Memory: <?php echo $memory; ?></h6>
						<h6>CPU time: <?php echo $cpuTime; ?>s</h6>
					</div>
				</div>
			</div>
		</div>

	</div>

	<br><br><br><br>
	<!-- ------------------------------------------------------------------- -->
</body>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}

document.getElementById('form_message').addEventListener('keydown', function(e) {
  if (e.key == 'Tab') {
    e.preventDefault();
    var start = this.selectionStart;
    var end = this.selectionEnd;

    // set textarea value to: text before caret + tab + text after caret
    this.value = this.value.substring(0, start) +
      "\t" + this.value.substring(end);

    // put caret at right position again
    this.selectionStart =
      this.selectionEnd = start + 1;
  }
});

(function(){
    function insertInto(str, input){
        var val = input.value, s = input.selectionStart, e = input.selectionEnd;
        input.value = val.slice(0,e)+str+val.slice(e);
        if (e==s) input.selectionStart += str.length - 1;
        input.selectionEnd = e + str.length -1;
    }
    var closures = {40:')',91:']', 123:'}', 39:"'", 34:'"'};
    $(".form-control").keypress(function(e) {
        if (c = closures[e.which]) insertInto(c, this);
    });
})();


<?php
	if(isset($_POST['getoutput'])){
?>
	$(function() {
		$('html, body').animate({
			scrollTop: $("#outputdiv").offset().top
		}, 1000);
		});
<?php
	}
?>
</script>
</html>