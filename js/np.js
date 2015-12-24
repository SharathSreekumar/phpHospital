$('#checkNp').click(function () {
	//check if checkbox is checked
	if ($(this).is(':checked')) {
        $('#submitNp').removeAttr('disabled'); //enable input
    } else {
        $('#submitNp').attr('disabled', true); //disable input
    }
});

//To display image from file to html
function readUrl(input){
	if(input.files && input.files[0]){
		var reader = new FileReader();
		reader.onload = function (e) {
            $('#imgUpload').attr('src', e.target.result).width(300).height(200);
        };
        reader.readAsDataURL(input.files[0]);
	}
}

function verifyData(){
	var name = document.forms["formNewPat"]["newname"].value, addr = document.forms["formNewPat"]["newaddr"].value, dob = document.forms["formNewPat"]["newdob"].value, age = document.forms["formNewPat"]["newage"].value;
	var contact = document.forms["formNewPat"]["newcontact"].value, emerCon1 = document.forms["formNewPat"]["new_emercon1"].value, emerCon2 = document.forms["formNewPat"]["new_emercon2"].value;

	if(name==null || name=="" || addr==null || addr=="" || dob==null || dob=="" || age==null || age==""){
		alert("Please complete the form");
		return false;
	}
}