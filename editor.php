<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="editorstyle.css">
</head>
<body>
    <!-- Editor -->
<div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 codeSide">
        <div class="row">
          <div class="col-md-12 col-sm-12">
            <!-- <div class="form-group"> -->
              
              <!-- Language Selection -->
              <!-- <label class="labelopt">Select your Language: </label>
              <select class="selectpicker" data-live-search="true" class="form-control" name="Language" id="mode" onchange="changeMode()">
                <option value="c" id="c" selected>C</option>
                <option value="cpp" id="cpp">C++</option>
                <option value="python3" id="python3">Python3</option>
                <option value="java" id="java">Java</option>
              </select> -->

              <!-- Theme Selection -->
              <label class="labelopt">Select Theme: </label>
              <select class="selectpicker" data-live-search="true" class="form-control" name="theme" id="mode2" onchange="change2mode()">
                <option value="monokai" id="monokai" selected>Monokai</option>
                <option value="chrome" id="chrome">Chrome</option>
                <option value="solarized_light" id="solarized_light">Solarized Light</option>
                <option value="solarized_dark" id="solarized_dark">Solarized Dark</option>
                <option value="vibrant_ink" id="vibrant_ink">Vibrant Ink</option>
              </select>

              <!-- Font Selection -->
              <label class="labelopt">Change font: </label>
              <select class="selectpicker" data-live-search="true" class="form-control" name="font" id="mode3" onchange="change3mode()">
                <option value="16" id="16">16px</option>
                <option value="18" id="18">18px</option>
                <option value="22" id="22" selected>22px</option>
                <option value="24" id="24">24px</option>
                <option value="26" id="26">26px</option>
              </select>

              <!-- Editor -->
              <div class="mained">
                <pre name="code" id="editor" style="border: none;"></pre>
              </div>
              <button type="button" id="save" class="btn btn-sky text-uppercase btn-sm" value="save">SAVE File</button>
            <!-- </div> -->
          </div>
        </div>
      </div>
      <!-- /.col-md-12 col-sm-12 codeSide -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="./editor-configs/ace.js"></script>
  <script src="./editor.js"></script>
  
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/js/bootstrap-select.js"></script> -->
  <!-- <script src="https://ajaxorg.github.io/ace-builds/src-min-noconflict/ace.js"></script> -->
 
</body>
</html>