<?php
/***********************************************************************************************************************/
/***********************************************************************************************************************/
//the following is for ID generation, to make sure that the id generated is original
/***********************************************************************************************************************/

//check productID
//returns boolean value
function check_prodID($productID)
{
	$q = mysql_query("SELECT id FROM Product WHERE id = '$productID'");
	$row = mysql_fetch_array($q);
	$id = $row['id'];
	if(($productID == $id)&&($row['id']!=NULL))
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	}
	
}
//check studentID
//returns boolean value
function check_studID($studID)
{
	$q = mysql_query("SELECT id FROM Students WHERE id = '$studID'");
	$row = mysql_fetch_array($q);
	$id = $row['id'];
	if(($studID == $id)&&($row['id']!=NULL))
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	}
	
}

//check collegeID
//return boolean value
//if the sent value is new set true
//if the sent value isnt new, set false
function new_check_collegeID($newID)
{
	$q = mysql_query("SELECT id FROM Colleges WHERE id = '$newID'");
	$row = mysql_fetch_array($q);
	$id = $row['id'];
	if(($newID == $id)&&($row['id']!=NULL))
	{
		return FALSE;
	}
	else
	{
		return TRUE;
	}
}
#check for student id
function new_check_studentID($newID)
{
	$q = mysql_query("SELECT id FROM Students WHERE id = '$newID'");
	$row = mysql_fetch_array($q);
	$id = $row['id'];
	if(($newID == $id)&&($row['id']!=NULL))
	{
		return FALSE;
	}
	else
	{
		return TRUE;
	}
}
#check for new member id
function new_check_MemberID($newID)
{
	$q = mysql_query("SELECT id FROM Members WHERE id = '$newID'");
	$row = mysql_fetch_array($q);
	$id = $row['id'];
	if(($newID == $id)&&($row['id']!=NULL))
	{
		return FALSE;
	}
	else
	{
		return TRUE;
	}
}
#check for new link id
function new_check_lnkID($newID)
{
	$q = mysql_query("SELECT id FROM Members_Student WHERE id = '$newID'");

	if($q === false)
	{
		return true;
	}
	else
	{
		return false;
	}
	
}

#check if the user already has added the student to their account
function check_studAddOnce($user,$student_code)
{
	$q = mysql_query("SELECT id FROM Members_Student WHERE mem_id = '$user' AND stud_id = '$student_code");

	if($q === false)
	{
		return true;
	}
	else
	{
		return false;
	}
	
}



#check for new order ID in orders table
function new_check_orderID($orderID)
{
	$q = mysql_query("SELECT id FROM Members_Student WHERE id = '$orderID'");
	if($q === false)
	{
		return true;
	}
	else
	{
		return false;
	}
	
}
/***********************************************************************************************************************/


/***********************************************************************************************************************/
/***********************************************************************************************************************/
//The following funcitons are used to checking the input from the user for validating new members
//making sure that what they are entering are acceptable to the database and the business.
/***********************************************************************************************************************/

//checks valid first name of the user and student
//returns false if name contains numbers, is null, or is too long
//returns true if name meets requirements:
//Number not contained in name.
//Name is not null
//Name is within size required
//Name only contains Alphabet characters
function check_validName_first($first_name)
{

	if(strlen($first_name)==0)
	{
		echo"No name given.\n";
		return false;
	}
	elseif(strlen($first_name)>25)
	{
		echo"Name is longer then 25 characters.\n";
		return false;
	}
	elseif(ctype_alpha($first_name) == false)
	{
		echo"Name does not contain only alphabet characters.\n";
		return false;
	}
	else
	{
		return true;
	}

}

//checks valid first name of the user and student
//returns false if name contains numbers, is null, or is too long
//returns true if name meets requirements:
//Number not contained in name.
//Name is not null
//Name is within size required
//Name only contains Alphabet characters
function check_validName_last($last_name)
{

	if(strlen($last_name)==0)
	{
		echo"No name given.\n";
		return false;
	}
	elseif(strlen($last_name)>25)
	{
		echo"Name is longer then 25 characters.\n";
		return false;
	}
	elseif(ctype_alpha($last_name) == false)
	{
		echo"Name does not contain only alphabet characters.\n";
		return false;
	}
	else
	{
		return true;
	}

}

#check for length of email and if email contains @ symbol
function check_valid_email($email)
{
	$emailChar = '@';
	$pos = strpos($email,$emailChar);
	if(strlen($email)==0)
	{
		echo"No email given.\n";
		return false;
	}
	elseif(strlen($email)>35)
	{
		echo"Email is longer then 35 characters.\n";
		return false;
	}
	elseif($pos === false)
	{
		echo"Invalid email address. \n";
		return false;
	}
	else
	{
		return true;
	}
}

#check valid password length, can be any combination of stuff
function check_valid_password($password)
{
	if(strlen($password)==0)
	{
		echo"No password given.\n";
		return false;
	}
	elseif(strlen($password)>20)
	{
		echo"Password is longer then 20 characters.\n";
		return false;
	}
	elseif(strlen($password)<6)
	{
		echo"Password is too short, length must be greater than 6 characters. \n";
		return false;
	}
	else
	{
		return true;
	}
}
/***********************************************************************************************************************/
/***********************************************************************************************************************/
//the purpose of the following funcitons is to test the input from the user for entering a new student

#Check the validation of the BannerID number
function check_validBannerID($student_BannerID)
{
	if(strlen($student_BannerID)==0)
	{
		echo"No ID number given.\n";
		return false;
	}
	elseif(strlen($student_BannerID)>10)
	{
		echo"Number is too long.\n";
		return false;
	}
	elseif(ctype_digit($student_BannerID) == false)
	{
		echo"Number does not contain only numbers.\n";
		return false;
	}
	else
	{
		return true;
	}
}
#check the year input to make sure it is at least a string value
function check_validYear($student_year)
{
	if(strlen($student_year)==0)
	{
		echo"No year given.\n";
		return false;
	}
	elseif(strlen($student_year)>10)
	{
		echo"Input is too long.\n";
		return false;
	}
	elseif(ctype_alpha($student_year) == false)
	{
		echo"Given input  year does not contain only alphabet letters.\n";
		return false;
	}
	else
	{
		return true;
	}
}

#check to see if the given collegeID number exists
function check_validCollege($college_id)
{
	$q = mysql_query("SELECT id FROM Colleges WHERE id = '$college_id'");
	$row = mysql_fetch_array($q);
	$id = $row['id'];
	if(($college_id == $id)&&($row['id']!=NULL))
	{
		return TRUE;
	}
	else
	{
		echo"Invalid input, please enter the ID number from the college list.\n";
		trim(readline("Press enter to continue. "));
		return FALSE;
	}
	
}


/***********************************************************************************************************************/
/****************************************************************************************************/
//the pupose of the following functions is to test the input from the user for entering a new address or college input
/****************************************************************************************************/

//Check valid college name
//returns false if name contains numbers, is null, or is too long
//returns true if name meets requirements:
//Number not contained in name.
//Name is not null
//Name is within size required
//Name only contains Alphabet characters
function check_validCollege_name($collegeName)
{
	if(strlen($collegeName)==0)
	{
		echo"No name given.\n";
		return false;
	}
	elseif(strlen($collegeName)>50)
	{
		echo"Name is longer then 50 characters.\n";
		return false;
	}
	else
	{
		return true;
	}
}



//this function will check to see if the number given is valid or not
//this will mainly check to see if the numbers are within range
//also will check to see if they are numbers
//there will be no spaces between the numbers
function check_valid_phone($phone)
{
	if(strlen($phone)==0)
	{
		echo"No phone number given.\n";
		return false;
	}
	elseif(strlen($phone)>15)
	{
		echo"Number is too long.\n";
		return false;
	}
	elseif(ctype_digit($phone) == false)
	{
		echo"Phone number does not contain only numbers.\n";
		return false;
	}
	else
	{
		return true;
	}
}

//check to see if the value entered by the user is valid
function check_valid_address($address)
{
	if(strlen($address)==0)
	{
		echo"No address given.\n";
		return false;
	}
	elseif(strlen($address)>35)
	{
		echo"Address is too long.\n";
		return false;
	}
	else
	{
		return true;
	}
}

//check if value is a valid zip5 number
function check_valid_zip5($zip5)
{
	if(strlen($zip5)==0)
	{
		echo"No number given.\n";
		return false;
	}
	elseif(strlen($zip5)>5)
	{
		echo"Number is too long.\n";
		return false;
	}
	elseif(strlen($zip5)<5)
	{
		echo"Number is too short.\n";
		return false;
	}
	elseif(ctype_digit($zip5) == false)
	{
		echo"Input given does not contain only numbers.\n";
		return false;
	}
	else
	{
		return true;
	}
}


//check if value is a valid zip4 number
function check_valid_zip4($zip4)
{
if(strlen($zip4)==0)
	{
		echo"No number given.\n";
		return false;
	}
	elseif(strlen($zip4)>4)
	{
		echo"Number is too long.\n";
		return false;
	}
	elseif(strlen($zip4)<4)
	{
		echo"Number is too short.\n";
		return false;
	}
	elseif(ctype_digit($zip4) == false)
	{
		echo"Input given does not contain only numbers.\n";
		return false;
	}
	else
	{
		return true;
	}
}

//check if state value is vaild
function check_valid_state($state)
{
if(strlen($state)==0)
	{
		echo"No code given.\n";
		return false;
	}
	elseif(strlen($state)>2)
	{
		echo"State Code is too long.\n";
		return false;
	}
	elseif(ctype_alpha($state) == false)
	{
		echo"State code does not contain only alphabet letters.\n";
		return false;
	}
	else
	{
		return true;
	}
}


//check if the city is a valid statement
function check_valid_city($city)
{
	if(strlen($city)==0)
	{
		echo"No city given.\n";
		return false;
	}
	elseif(strlen($city)>25)
	{
		echo"City name is too long.\n";
		return false;
	}
	else
	{
		return true;
	}
}
/***********************************************************************************************************************/


?>
