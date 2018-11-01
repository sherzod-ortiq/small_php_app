function validate(form)
{
	fail = validateName(form.name1.value)
	fail += validateSurname(form.surname.value)
	fail += validateEmail(form.email.value)
	fail += validateTel(form.tel.value)	
	fail += validatePassword(form.password.value)
	fail += validateGender(form.gender.value)

		if(fail == "")
			return true
		else { alert(fail); return false }
}


function validateName(field)
{
	if(field == "")
	{	return "No Name was entered\n";	}
	else if((field.length < 3) || (field.length > 20))
	{	return "Name length should be between 3 and 20\n";	}
	else if (/[^a-zA-Z']/.test(field))
	{	return "Only letters and ' sign are allowed for Name\n";	}
	else
	{	return "";}		
}


function validateSurname(field)
{
	if(field == "")
	{	return "No Surname was entered\n";	}
	else if((field.length < 3) || (field.length > 20))
	{	return "Surname length should be between 3 and 20\n";	}
	else if (/[^a-zA-Z']/.test(field))
	{	return "Only letters and ' sign are allowed for Surname\n";	}
	else
	{	return "";}		
}

function validateEmail(field)
{
	if(field == "") 
	{	return "No Email was entered\n";	}
	else if((field.length < 3) || (field.length > 20))
	{	return "Email length should be between 3 and 20\n";	}
	else if(!((field.indexOf(".") > 0) && (field.indexOf("@") > 0)) || /[^a-zA-Z0-9.@_-]/.test(field))
	{	return "The Email address is invalid\n";	}
	else
	{	return "";}		
}

function validateTel(field)
{
	if(field == "") 
	{	return "No Tel was entered\n";	}
	else if((field.length < 3) || (field.length > 15))
	{	return "Tel length should be between 3 and 20\n";	}
	else if (/[^0-9+]/.test(field))
	{	return "The Tel is invalid\n";	}
	else if (field.indexOf("+") > 0) 
	{	return "The Tel is invalid\n";	}
	else
	{	return "";}		
}

function validatePassword(field)
{
	if(field == "") 
	{	return "No Password was entered\n";	}
	else if((field.length < 2) || (field.length > 4))
	{	return "Password length should be between 3 and 4\n";	}
  else if (!/[a-z]/.test(field) || !/[A-Z]/.test(field) || !/[0-9]/.test(field))
	{	return "Password requires 1 each of a-z, A-Z and 0-9\n";	}
  else if (/[^a-zA-Z0-9]/.test(field))
	{	return "Password must contain only a-z, A-Z and 0-9\n";	}
	else
	{	return "";	}		
}

function validateGender(field)
{
	if(field == "") 
	{	return "Gender wasn't chosen\n"	}
	else
	{return "";}
}

