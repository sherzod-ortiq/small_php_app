function validatePurchase(form)
{
	fail = validateAmount(form.name1.value)

		if(fail == "")
			return true
		else { alert(fail); return false }
}

function validateBalanceFill(form)
{
	fail = validateAmount(form.cardNum.value)
		if(fail == "")
		{	fail = validateAmount(form.moneyAm.value)	}

		if(fail == "")
			return true
		else { alert(fail); return false }
}

function validateAmount(field)
{
	if(field == "") 
	{	return "No input\n";	}
  else if (/[^0-9]/.test(field))
	{	return "Only numbers are allowed\n";	}
	else
	{	return "";	}		
}
