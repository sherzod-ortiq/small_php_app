function clearForm(form)
{
	form.email.value = "";
	form.password.value = "";
	document.getElementById("errorEmail").innerHTML = "";	
	document.getElementById("errorPassword").innerHTML = "";	
}

function validate()
{
	fail1 = fail2 = "";
	count = 0;

		fail1 = validateEmail();
		fail2 = validatePassword();

			if(fail1 == "valid")
			{	
				count ++;
			}
			else if(fail1 == "notSet")
			{
	 	   	document.getElementById("errorEmail").innerHTML = "No input";	
			}

			if(fail2 == "valid")
			{	
				count ++;
			}
			else if(fail2 == "notSet")
			{
	 	   	document.getElementById("errorPassword").innerHTML = "No input";	
			}
			
				if(count == 2)
				{	return true; }	
				else 
				{ return false; }
}


function validateEmail()
{
	var field = fail = check = "";

	 field = document.getElementById("email1").value;

		if(field == "")
		{	check = "notSet";	}
		else if((field.length < 3) || (field.length > 20))
		{	fail = "Invalid email";	}
		else if(!((field.indexOf(".") > 0) && (field.indexOf("@") > 0)) || /[^a-zA-Z0-9.@_-]/.test(field))
		{	fail = "Invalid email";	}
		else
		{
			fail = "";
			check = "valid";
		}		

	 	   	document.getElementById("errorEmail").innerHTML = fail;

					return check;
}


function validatePassword()
{
	var field = fail = check = "";

	 field = document.getElementById("password1").value;

		if(field == "")
		{	check = "notSet";	}
		else if((field.length < 2) || (field.length > 4))
		{	fail = "Invalid password";	}
		else if (!/[a-z]/.test(field) || !/[A-Z]/.test(field) || !/[0-9]/.test(field))
		{	fail = "Invalid password";	}
	  else if (/[^a-zA-Z0-9]/.test(field))
		{	fail = "Invalid password";	}
		else
		{	
			fail = "";
			check = "valid";
		}	
	
	 	   	document.getElementById("errorPassword").innerHTML = fail;	

					return check;
}
