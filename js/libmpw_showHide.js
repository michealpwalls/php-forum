function mpw_showHide(id)
{
	var mpw_element = document.getElementById(id);

	if(mpw_element.style.display == "block") {
		mpw_element.style.display = "none";
	} else {
		mpw_element.style.display = "block";
	}

}
