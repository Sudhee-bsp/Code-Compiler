<?php

	declare(strict_types=1);

	require_once realpath(__DIR__ . '/vendor/autoload.php');

	$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
	$dotenv->load();

	$code = $stdin = $language = $memory = $cpuTime = $output = "";
	$theme = "";

	if(isset($_POST['getoutput'])){
		$code = $_POST['code'];
		$stdin = $_POST['stdin'];
		$language = $_POST['lang'];

		$theme = $_POST['theme'];
		$font = $_POST['font'];

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
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="favicon.ico" />
	<title>BSP | CODE</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
	<link rel="stylesheet" href="./style.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>
<body>
	<div class="container col-md-10"> 
		<div class="text-center mt-4 mb-5">
        	<h1 class="font-weight-bold">&lt;My Code Compiler /&gt;</h1>
    	</div>
		<div class="row">
			<div class="col-lg-12 mx-auto mycnt">
				<div class="card mt-3 mb-3 p-2 bg-light">
					<div class="card-body bg-light">
						<!-- <div class="container"> -->
							<form action="./" method="POST" id="contact-form" role="form">
								<div class="controls">
								
									<div class="row">
										<!-- <div class="col-md-4"> -->
											<div class="col-sm-4"> 
												
												<label for="form_need">Choose language</label> 
												
												<select id="lang" name="lang" class="form-control" data-live-search="true" required="required" onchange="changeMode()">
													<option value="c" id="c"
													<?php if(isset($_POST['lang']) && $_POST['lang'] == 'c') 
														echo ' selected="selected"';
													?>
													>C
													</option>

													<option value="java" id="java"
													<?php if(isset($_POST['lang']) && $_POST['lang'] == 'java') 
														echo ' selected="selected"';
													?>
													>Java
													</option>

													<option value="python3" id="python3"
													<?php if(isset($_POST['lang']) && $_POST['lang'] == 'python3') 
														echo ' selected="selected"';
													?>
													>Python3
													</option>

													<option value="cpp" id="cpp"
													<?php if(isset($_POST['lang']) && $_POST['lang'] == 'cpp') 
														echo ' selected="selected"';
													?>
													>C++
													</option>
												</select> 
												
											</div>

											<div class="col-sm-4"> 
												<!-- Theme Selection -->
												<label class="labelopt">Select Theme: </label>
												<select class="selectpicker form-control" data-live-search="true" name="theme" id="mode2" onchange="change2mode()">
													<option value="monokai" id="monokai"
													<?php if(isset($_POST['theme']) && $_POST['theme'] == 'monokai') 
														echo ' selected="selected"';
													?>
													>Monokai</option>
													<option value="chrome" id="chrome"
													<?php if(isset($_POST['theme']) && $_POST['theme'] == 'chrome') 
														echo ' selected="selected"';
													?>
													>Chrome</option>
													<option value="solarized_light" id="solarized_light"
													<?php if(isset($_POST['theme']) && $_POST['theme'] == 'solarized_light') 
														echo ' selected="selected"';
													?>
													>Solarized Light</option>
													<option value="solarized_dark" id="solarized_dark" 
													<?php if(isset($_POST['theme']) && $_POST['theme'] == 'solarized_dark') 
														echo ' selected="selected"';
													?>
													>Solarized Dark</option>
													<option value="vibrant_ink" id="vibrant_ink"
													<?php if(isset($_POST['theme']) && $_POST['theme'] == 'vibrant_ink') 
														echo ' selected="selected"';
													?>
													>Vibrant Ink</option>
												</select>
											</div>

											<div class="col-sm-4">
												<!-- Font Selection -->
												<label class="labelopt">Change font: </label>
												<select class="selectpicker form-control" data-live-search="true" name="font" id="mode3" onchange="change3mode()">
													<option value="16" id="16">16px</option>
													<option value="18" id="18">18px</option>
													<option value="22" id="22" selected>22px</option>
													<option value="24" id="24">24px</option>
													<option value="26" id="26">26px</option>
												</select>
											</div>

										<!-- </div> -->
									</div>

									<div class="row">
										<div class="col-md-12">
											<div class="form-group mt-2"> 
												<label for="form_message">Your Code </label> 
												<textarea id="form_message" name="code" class="form-control" rows="10" col="100" autocomplete="on" hidden="hidden"><?php if(isset($_POST['code'])){echo $code;} ?></textarea> 
												<?php 
													include('./editor.php'); 
													// user session code after executing.
													include('./sessioncode.php');
												?>
											</div>
											<br>
											<label for="form_inputs">Inputs: (if any)</label> 
											<br/>
											<textarea class="form-control" id="form_inputs" name="stdin" rows="5" cols="60"></textarea>
											<br><br>
										</div>
										
										<div class="col-sm-6 mx-auto runbtn">
											<i class="fas fa-sync-alt icon"></i>
											<input id="runcode" name="getoutput" type="submit" class="btn btn-success btn-send pt-2 btn-block font-weight-bold" value="RUN">
										</div>
									</div>

								</div>
							</form>
						<!-- </div> -->
					</div>
				</div> <!-- /.8 -->
			</div> <!-- /.row-->
		</div>
	</div>

	<!-- ----------------------------output div---------------------- -->
	<div class="container"  id="outputdiv">
		<div class="text-left mt-5 ">
        	<h4>Console <i class="fas fa-terminal"></i> output:</h4>
    	</div>
		
		<div class="row">
			<div class="col-lg-12 mx-auto">
				<div class="card mt-2 mx-auto p-4 bg-light">
					<div class="card-body bg-light">
						<textarea class="form-control" name="stdin" rows="4" cols="70" readonly><?php echo $output; ?></textarea>
						<br/>
						<br/>
						<h6><i class="fas fa-sd-card"></i> Memory: <?php echo $memory; ?>kb</h6>
						<h6><i class="far fa-clock"></i> CPU time: <?php echo $cpuTime; ?>s</h6>
					</div>
				</div>
			</div>
		</div>

	</div>

	<br><br><br><br>
	<!-- ------------------------------------------------------------------- -->

	<footer class="page-footer font-small blue myftr">
		<div class="footer-copyright text-center py-3">&lt;Developed by Sudhi/&gt;<br/>
			Checkout <a href="https://github.com/Sudhee-bsp/Code-Compiler" target="_blank"><i class="fab fa-github"></i></a>
		</div>
	</footer>

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
	
var editor = ace.edit('editor');
var textarea = $('#form_message');

editor.getSession().on('change', function () {
	textarea.val(editor.getSession().getValue());
});
textarea.val(editor.getSession().getValue());


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