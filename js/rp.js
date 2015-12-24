$('#checkRp').click(function () {
	//check if checkbox is checked
	if ($(this).is(':checked')) {
        $('#submitRp').removeAttr('disabled'); //enable input
    } else {
        $('#submitRp').attr('disabled', true); //disable input
    }
});

function verifyRegData(){
	var name = document.forms["formRegPat"]["newname"].value, age = document.forms["formRegPat"]["newage"].value;
	var contact = document.forms["formRegPat"]["newcontact"].value, emerCon1 = document.forms["formRegPat"]["new_emercon1"].value, emerCon2 = document.forms["formRegPat"]["new_emercon2"].value;
	var phyname = document.forms["formRegPat"]["phyname"].value, phyContact = document.forms["formRegPat"]["phycontact"].value;

	if(name==null || name=="" || age==null || age=="" || phyname==null || phyname==""){
		alert("Please complete the form");
		return false;
	}
}