// Editor Settings (Provided by C9)
var editor = ace.edit("editor");
editor.setTheme("ace/theme/monokai");
editor.setShowPrintMargin(false);
editor.setFontSize(22);
editor.session.setMode("ace/mode/c_cpp");
editor.setValue(
  "#include <stdio.h>\n\n\nint main() {\n    // Complete the code.\n    return 0;\n}\n"
);
editor.clearSelection();

// Function to change the mode of the editor as a different language is selected dynamically
function changeMode() {
  var x = document.getElementById("mode");
  var modeValue = x.options[x.selectedIndex].value;
  if (modeValue == "c") {
    editor.session.setMode("ace/mode/c_cpp");
    editor.setValue(
      "#include <stdio.h>\n\n\nint main() {\n    // Complete the code.\n    return 0;\n}\n"
    );
    editor.clearSelection();
    document.getElementById("langExt").innerHTML = "c";
  }
  if (modeValue == "c++") {
    editor.session.setMode("ace/mode/c_cpp");
    editor.setValue(
      "#include <iostream>\nusing namespace std;\n\nint main() {\n    // Complete the code.\n    return 0;\n}\n"
    );
    editor.clearSelection();
    document.getElementById("langExt").innerHTML = "cpp";
  }
  if (modeValue == "python3") {
    editor.session.setMode("ace/mode/python");
    editor.setValue(
      "# Enter your code here. Read input from STDIN. Print output to STDOUT"
    );
    editor.clearSelection();
    document.getElementById("langExt").innerHTML = "py";
  }
  if (modeValue == "java") {
    editor.session.setMode("ace/mode/java");
    editor.setValue(
      "import java.io.*;\nimport java.util.*;\n\nclass Main {\n\n    public static void main(String[] args) {\n        // Your code goes here\n   }\n}\n"
    );
    editor.clearSelection();
    document.getElementById("langExt").innerHTML = "java";
  }
}

function change2mode() {
  var ut = document.getElementById("mode2");
  var mode2Value = ut.options[ut.selectedIndex].value;

  if (mode2Value == "monokai") {
    editor.setTheme("ace/theme/monokai");
  }
  if (mode2Value == "chrome") {
    editor.setTheme("ace/theme/chrome");
  }
  if (mode2Value == "solarized_light") {
    editor.setTheme("ace/theme/solarized_light");
  }
  if (mode2Value == "solarized_dark") {
    editor.setTheme("ace/theme/solarized_dark");
  }
  if (mode2Value == "vibrant_ink") {
    editor.setTheme("ace/theme/vibrant_ink");
  }
}

function change3mode() {
  var ft = document.getElementById("mode3");
  var mode2Value = ft.options[ft.selectedIndex].value;

  if (mode2Value == 16) {
    editor.setFontSize(16);
  }
  if (mode2Value == 18) {
    editor.setFontSize(18);
  }
  if (mode2Value == 22) {
    editor.setFontSize(22);
  }
  if (mode2Value == 24) {
    editor.setFontSize(24);
  }
  if (mode2Value == 26) {
    editor.setFontSize(26);
  }
}

function saveTextAsFile() {
  var codeText = editor.getValue();
  //   console.log(codeText);
  var textFileAsBlob = new Blob([codeText], { type: "text/plain" });
  //   var fileNameToSaveAs = "ecc.java";

  // save file as per language
  var sf = document.getElementById("mode");
  var modeValue = sf.options[sf.selectedIndex].value;
  if (modeValue == "c") {
    var fileNameToSaveAs = "code.c";
  }
  if (modeValue == "c++") {
    var fileNameToSaveAs = "code.cpp";
  }
  if (modeValue == "python3") {
    var fileNameToSaveAs = "code.py";
  }
  if (modeValue == "java") {
    var fileNameToSaveAs = "code.java";
  }

  var downloadLink = document.createElement("a");
  downloadLink.download = fileNameToSaveAs;
  downloadLink.innerHTML = "Download File";
  if (window.webkitURL != null) {
    // Chrome allows the link to be clicked
    // without actually adding it to the DOM.
    downloadLink.href = window.webkitURL.createObjectURL(textFileAsBlob);
  } else {
    // Firefox requires the link to be added to the DOM
    // before it can be clicked.
    downloadLink.href = window.URL.createObjectURL(textFileAsBlob);
    downloadLink.onclick = destroyClickedElement;
    downloadLink.style.display = "none";
    document.body.appendChild(downloadLink);
  }

  downloadLink.click();
}

var button = document.getElementById("save");
button.addEventListener("click", saveTextAsFile);

$(document).ready(function () {
  $(".selectpicker").selectpicker();
  $('[data-toggle="tooltip"]').tooltip();
});
