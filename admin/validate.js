
function validateNames () {
	var isValid = true;
	
	// Validate Name
	var firstname = document.forms["form"]["firstname"].value;
	var lastname = document.forms["form"]["lastname"].value;
	var alpharegex = /^[a-zA-Z]+$/;

	if (firstname == "" || lastname == "") {
		isValid = false;
		document.getElementById("warnings").innerHTML += "<li>You need a name</li>";
	} else if (!firstname.match(alpharegex) || !lastname.match(alpharegex)) {
		isValid = false;
	}
	return isValid;
}

function validatePhone () {
	var isValid = true;
	var phone = document.forms["form"]["phone"].value;
	var numberRegex = /^[0-9]+$/;

	if (phone == "" || !phone.match(numberRegex)) {
		document.getElementById("warnings").innerHTML += "<li>You need a phone number.</li>";
		isValid = false;
	}

	return isValid;
}

function validateAddress() {
	var isValid = true;
	var address = document.forms["form"]["address"].value;
	if (address == "") {
		isValid = false;
		document.getElementById("warnings").innerHTML += "<li>You need an address.</li>";
	}

	return isValid;
}

function validateCity () {
	var isValid = true;
	var city = document.forms["form"]["city"].value;
	if (city == "") {
		isValid = false;
		document.getElementById("warnings").innerHTML += "<li>Type in your city.</li>";
	}
	return isValid;
}

function validateState () {
	var isValid = true;
	var state = document["forms"]["state"].value;
	if (state == "--") {
		isValid = false;
		document.getElementById("warnings").innerHTML += "<li>Select your state.</li>";
	}

	return isValid;
}

function validateBirthday () {
	var isValid = true;
	var month = document.forms["form"]["month"].value;
	var day = document.forms["form"]["day"].value;
	var year = document.forms["form"]["birthyear"].value;
	if (month == "--" || day == "--" || year == "--") {
		isValid = false;
		document.getElementById("warnings").innerHTML += "<li>Fill out all fields for your birthday.</li>";
	}

	return isValid;
}

function validateUserPassword () {
	var isValid = true;
        var username = document.forms["form"]["username"].value;
        var password = document.forms["form"]["password"].value;
        if (username == "" || password == "") {
            isValid = false;
            document.getElementById("warnings").innerHTML += "<li>Fill out your username and/or password.</li>";
        }
        
        return isValid;
}

function validateGender () {
	var isValid = true;
        var gender = document.forms["form"]["gender"].value;
        if (gender == "") {
            isValid = false;
            document.getElementById("warnings").innerHTML += "<li>Select a gender.</li>";
        }
        return isValid;
}

function validateRelationship () {
	var isValid = true;
        var relationship = document.forms["form"]["relationship"].value
        if (relationship == "") {
            isValid = false;
            document.getElementById("warnings").innerHTML += "<li>Enter your relationship.</li>";
        }
        return isValid;
}

function validateInsert () {
	document.getElementById("warnings").innerHTML = "";
	var isInsertValid = true;

	if (!validateNames()) {
		isInsertValid = false;
	}
	if (!validatePhone()) {
		isInsertValid = false;
	}
	if (!validateAddress()) {
		isInsertValid = false;
	}
	if (!validateCity()) {
		isInsertValid = false;
	}
	if (!validateBirthday()) {
		isInsertValid = false;
	}
	if (!validateUserPassword()) {
		isInsertValid = false;
	}
	if (!validateGender()) {
		isInsertValid = false;
	}
	if (!validateRelationship()) {
		isInsertValid = false;
	}

	return isInsertValid;
}

function validateUpdate () {
	document.getElementById("warnings").innerHTML = "";
	var isUpdateValid = true;

	if (!validateNames()) {
		isUpdateValid = false;
	}
	if (!validatePhone()) {
		isUpdateValid = false;
	}
	if (!validateAddress()) {
		isUpdateValid = false;
	}
	if (!validateCity()) {
		isUpdateValid = false;
	}
	if (!validateBirthday()) {
		isUpdateValid = false;
	}
	if (!validateUserPassword()) {
		isUpdateValid = false;
	}
	if (!validateGender()) {
		isUpdateValid = false;
	}
	if (!validateRelationship()) {
		isUpdateValid = false;
	}

	return isUpdateValid;
}

function validateSearch () {
document.getElementById("warnings").innerHTML = "";
	var isSearchValid = true;
	
	if (!validateNames()) {
		isSearchValid = false;
	}
	if (!validatePhone()) {
		isSearchValid = false;
	}

	return isSearchValid;
}