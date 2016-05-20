function getAge(birth) {

    var today = new Date();
    var nowyear = today.getFullYear();
    var nowmonth = today.getMonth();
    var nowday = today.getDate();

    var birthyear = birth.getFullYear();
    var birthmonth = birth.getMonth();
    var birthday = birth.getDate();

    var age = nowyear - birthyear;
    var age_month = nowmonth - birthmonth;
    var age_day = nowday - birthday;
   
    if(age_month < 0 || (age_month == 0 && age_day <0)) {
       age = parseInt(age) -1;
    }
    if(age/100 <= 1)
    	document.getElementById('newage').value = age;
    else
    	alert("Age crossing 100 years!!!");
}


$('#newdob').change(function() {
	var enteredDate = document.getElementById('newdob').valueAsDate;
	var month = enteredDate.getMonth() + 1;// becomes integer
	var result = "Day: " + enteredDate.getDate() + "Month: " + month + "Year: " + enteredDate.getFullYear();//becomes string
	getAge(enteredDate);
});

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

function verifyData(){//verify if the textbox contains value or not
	var name = document.forms["formNewPat"]["newname"].value, addr = document.forms["formNewPat"]["newaddr"].value, dob = document.forms["formNewPat"]["newdob"].value, age = document.forms["formNewPat"]["newage"].value;
	var contact = document.forms["formNewPat"]["newcontact"].value, emerCon1 = document.forms["formNewPat"]["new_emercon1"].value, emerCon2 = document.forms["formNewPat"]["new_emercon2"].value;

	if(name==null || name=="" || addr==null || addr=="" || dob==null || dob=="" || age==null || age==""){
		alert("Please complete the form");
		return false;
	}else if(contact.length < 10 || emerCon1.length < 10 || emerCon2.length < 10){
        alert("Contact no size is less than 10 digits");
        return false;
    }
}

function myFunc(){
    var s = document.getElementById("selectFile").value;
    var x = s.replace('C:\\fakepath\\','');
    window.open(x, '_blank', 'fullscreen=yes');
    return false;
}