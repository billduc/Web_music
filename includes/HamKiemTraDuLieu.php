<?php
function isValidEmail($email = '') 
{
    return preg_match("/^[\d\w\/+!=#|$?%{^&}*`'~-][\d\w\/\.+!=#|$?%{^&}*`'~-]*@[A-Z0-9][A-Z0-9.-]{1,61}[A-Z0-9]\.[A-Z]{2,6}$/ix",$email);
}

function isValidEmail_2($email = '')
{
return eregi ("^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$", stripslashes(trim($email)));
}


function isValidFnameLname($FLname = '') 
{		
	return eregi ("^[[:alpha:].' -]{4,}$",stripslashes(trim($FLname)));
}

function isValidUsername($username = '') 
{		
	return eregi ("^[[:alnum:]_]{4,20}$",stripslashes(trim($username)));
}


function isValidUrl($url = '') 
{		
	return eregi ("^((http|https|ftp)://)([[:alnum:]-])+(\.)([[:alnum:]-]){2,4}([[:alnum:]/+=%&_.~?-]*)$", stripslashes(trim($url)));
}

?>