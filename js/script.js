



/*==========  Tooltip  ==========*/



$(document).ready(function(){

    $('[data-toggle="tooltip"]').tooltip();   

});





/*==========  Color-Picker  ==========*/



$(document).ready(function() {    

    

   $('#color1').colorPicker();



   $('#color2').colorPicker();



   $('#color3').colorPicker({pickerDefault: "ffffff", colors: ["ffffff", "000000", "111FFF", "C0C0C0", "FFF000"], transparency: true}); 



    $('#color4').colorPicker();



    $('#color5').colorPicker({showHexField: false});

   

   //fires an event when the color is changed

   //$('#color1').change(function(){

    //alert("color changed");

   //});



   $("#button1").click(function(){

    $("#color1").val("#ffffff");   

    $("#color1").change();

   });



   $("#button2").click(function(){

    $("#color2").val("#000000");   

    $("#color2").change();

   });



  });













// Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
if($("#template").length != 0) {
var previewNode = document.querySelector("#template");
console.log(previewNode);
previewNode.id = "";

var previewTemplate = previewNode.parentNode.innerHTML;

previewNode.parentNode.removeChild(previewNode);


var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone

  url: "/upload.php", // Set the url
//  url:'upload.php',
   
  thumbnailWidth: 80,

  thumbnailHeight: 80,
  maxFiles: 1,
  uploadMultiple :false,
  parallelUploads: 1,
 
  previewTemplate: previewTemplate,
  acceptedFiles: ".jpeg,.jpg,.png,.gif",

  autoQueue: false, // Make sure the files aren't queued until manually added

  previewsContainer: "#previews", // Define the container to display the previews

  clickable: ".fileinput-button" ,// Define the element that should be used as click trigger to select files.

});



myDropzone.on("addedfile", function(file) {

  // Hookup the start button

  file.previewElement.querySelector(".start").onclick = function() { 
	  myDropzone.enqueueFile(file);
	  myDropzone.on("complete", function (file) {
	
			if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
				//alert('Your action, Refresh your page here. ');
				window.location.href = 'template-final.php';
			}
	
		}); 
	};

});



// Update the total progress bar

myDropzone.on("totaluploadprogress", function(progress) {

  document.querySelector("#total-progress .progress-bar").style.width = progress + "%";

});


myDropzone.on("sending", function(file) {

  // Show the total progress bar when upload starts

  document.querySelector("#total-progress").style.opacity = "1";

  // And disable the start button

  file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");

});



// Hide the total progress bar when nothing's uploading anymore

myDropzone.on("queuecomplete", function(progress) {

  document.querySelector("#total-progress").style.opacity = "0";
   
});





// Setup the buttons for all transfers

// The "add files" button doesn't need to be setup because the config

// `clickable` has already been specified.

document.querySelector("#actions .start").onclick = function() {

  
  myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
  
 

};

document.querySelector("#actions .cancel").onclick = function() {

  myDropzone.removeAllFiles(true);

};



 var Dropzone = require("enyo-dropzone");

    Dropzone.autoDiscover = false;
}