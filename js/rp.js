$('#checkRp').click(function () {
	//check if checkbox is checked
	if ($(this).is(':checked')) {
        $('#submitRp').removeAttr('disabled'); //enable input
    } else {
        $('#submitRp').attr('disabled', true); //disable input
    }
});

function verifyRegData(){//checks if certains parameters are satisfied i.e. the name,age,doc's Name are entered
	var name = document.forms["formRegPat"]["newname"].value, age = document.forms["formRegPat"]["newage"].value;
	var contact = document.forms["formRegPat"]["newcontact"].value, emerCon1 = document.forms["formRegPat"]["new_emercon1"].value, emerCon2 = document.forms["formRegPat"]["new_emercon2"].value;
	var phyname = document.forms["formRegPat"]["phyname"].value, phyContact = document.forms["formRegPat"]["phycontact"].value;

	if(name==null || name=="" || age==null || age=="" || phyname==null || phyname==""){
		alert("Please complete the form");
		return false;
	}
}

function verifyRegUpData(){//checks if certains parameters are satisfied i.e. the suffer, & doctor is filled
	var suffer = document.forms["formRegUpPat"]["suffer"].value, doctor = document.forms["formRegUpPat"]["phyname"].value;

	if(suffer == "" || suffer== null || doctor == "" || doctor== null){
		alert("Please complete the form");
		return false;
	}
}