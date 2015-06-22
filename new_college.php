<?php

function new_college()
{
	#clear screen
	
	$end_menu = false;
	while($end_menu == false)
	{	
		display_new_college_menu();
		$choice = trim(readline("Your Choice: "));
		switch($choice)
		{
			case 1:
				add_new_college();
				break;
			case 2:
				$end_menu = true;
				break;
			default:
				echo"Invalid Input. Please enter the number shown on the menu\n";
				break;
		}
	}

}


//display new college menu
function display_new_college_menu()
{
	echo"Welcome new colleges to MyJaqi!\n Please input a number to do the following commands.\n";
	echo"1. Sign up new college.\n";
	echo"2. Return to the main menu.\n";
}

//collect the data needed from the user
function add_new_college()
{
	echo"Please answer the following questions. \n";
	echo"Note: to exit at any time. Please type \":exit\" \n";

	$validInput = false;
	#get and check name of college
	while($validInput == false)
	{
	$college_name = trim(readline("Please enter the college's name: "));
	if($college_name == ":exit") 
	{
	return 0;#allow user to exit sign up form, checked each time
	}
	elseif($college_name ==":quit") 
	{
	die("Exiting Program!\n");
	}
	#Check valid name input, this case is length of name
	$validInput = check_validCollege_name($college_name);
	}

	#get and check college's address
	$validInput = false;
	while($validInput == false)
	{
	$college_address = trim(readline("Please enter the college's street address: "));
	if($college_address== ":exit") 
	{
	return 0;#allow user to exit sign up form, checked each time
	}
	elseif($college_address ==":quit") 
	{
	die("Exiting Program!\n");
	}
	#Check valid address input, this only records the length and type input
	$validInput = check_valid_address($college_address);
	}

	#get and check college's city
	$validInput = false;
	while($validInput == false)
	{
	$college_city = trim(readline("Please enter the college's city: "));
	if($college_city== ":exit") 
	{
	return 0;#allow user to exit sign up form, checked each time
	}
	elseif($college_city ==":quit") 
	{
	die("Exiting Program!\n");
	}
	$validInput = check_valid_city($college_city);	
	}
	
	#get and check college's state initials
	$validInput = false;
	while($validInput == false)
	{
	$college_state = trim(readline("Please enter the college's state initials: "));
	if($college_state== ":exit") 
	{
	return 0;#allow user to exit sign up form, checked each time
	}
	elseif($college_state ==":quit") 
	{
	die("Exiting Program!\n");
	}
	$validInput = check_valid_state($college_state);
	}

	#get and check college's first 5 zip digits
	$validInput = false;
	while($validInput == false)
	{
	$college_zip5 = trim(readline("Please enter the first 5 digits of the college's zip code: "));
	if($college_zip5== ":exit") 
	{
	return 0;#allow user to exit sign up form, checked each time
	}
	elseif($college_zip5 ==":quit") 
	{
	die("Exiting Program!\n");
	}
	$validInput = check_valid_zip5($college_zip5);
	}

	#get and check college's last 4 zip digits
	$validInput = false;
	while($validInput == false)
	{
	$college_zip4 = trim(readline("Please enter the last 4 digits of the college's zip code: "));
	if($college_zip4== ":exit") 
	{
	return 0;#allow user to exit sign up form, checked each time
	}
	elseif($college_zip4 ==":quit") 
	{
	die("Exiting Program!\n");
	}
	$validInput = check_valid_zip4($college_zip4);
	}

	#get and check college burser phone number
	$validInput = false;
	while($validInput == false)
	{
	$burserPhone = trim(readline("Please enter the college's bursur phone number: "));
	if($burserPhone== ":exit") 
	{
	return 0;#allow user to exit sign up form, checked each time
	}
	elseif($burserPhone ==":quit") 
	{
	die("Exiting Program!\n");
	}
	$validInput = check_valid_phone($burserPhone);
	}

	
	new_college_commit($college_name,$college_address,$college_city,$college_state,$college_zip5,$college_zip4,$burserPhone);
	echo"Registration for $college_name complete!\n";
}


//This function then commits everything the user entered
function new_college_commit($college_name,$college_address,$college_city,$college_state,$college_zip5,$college_zip4,$burserPhone)
{
	//call collegeID generator
	$newID = false;
	while($newID == false)
	{
	$collegeID = generate_CollegeID();
	$newID = new_check_collegeID($collegeID);
	echo "$collegeID \n";
	}
	//code to update database
	mysql_query("INSERT INTO Colleges VALUES('$collegeID','$college_name','$college_address','$college_city','$college_state','$college_zip5','$college_zip4','$burserPhone');");	

	
	
}




?>
