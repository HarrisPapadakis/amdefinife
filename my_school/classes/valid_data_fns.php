<?php
	//test that each variable has a value
	foreach ($form_vars as $key => $value) {
		if ((!isset($key)) || ($value == '')) return false;
	}
	return true;

	//check an email address is possibly valid
	if (ereg('^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$',$address)) return true; else return false;\
?>