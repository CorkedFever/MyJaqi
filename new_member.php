<?php

//Call function to clear the above text
function new_member()
{
	
$exitMenu = false;
while($exitMenu == false)
{
	new_member_menu_display();
	$UserChoice = trim(readline("Your Input Choice: "));
	switch($UserChoice)
	{
		case 1:
		#Call function to create new member
			add_new_member();
			break;

		case 2:
		#Exit to main menu
			$exitMenu = true;
			break;
		default:
			echo "Invalid Input. Please enter the corresponding menu number.\n";
			break;
	}

}
	
}




#menu display function for creating new members
function new_member_menu_display()
{
	echo "Welcome New Member to MyJaqi!\n";
	echo "Please Enter a number to do the following tasks:\n";
	echo "1.  Create a new Member Account.\n";
	echo "2.  Return to main menu.\n";
}






#this function gathers the member info needed from the user
function add_new_member()
{
	echo"Please answer the following questions. \n";
	echo"Note: to exit at any time. Please type \":exit\" \n";

	$validInput = false;
	#get and check first name of student
	while($validInput == false)
	{
	$first_name = trim(readline("Please enter your first name: "));
	if($first_name== ":exit") 
	{
	return 0;#allow user to exit sign up form, checked each time
	}
	elseif($first_name==":quit") 
	{
	die("Exiting Program!\n");
	}
	#Check valid name input, this case is length of name
	$validInput = check_validName_first($first_name);
	}

	$validInput = false;
	#get and check first name of student
	while($validInput == false)
	{
	$last_name = trim(readline("Please enter your last name: "));
	if($last_name== ":exit") 
	{
	return 0;#allow user to exit sign up form, checked each time
	}
	elseif($last_name==":quit") 
	{
	die("Exiting Program!\n");
	}
	#Check valid name input, this case is length of name
	$validInput = check_validName_last($last_name);
	}

	#get and check college's address
	$validInput = false;
	while($validInput == false)
	{
	$address = trim(readline("Please enter the your street address: "));
	if($address== ":exit") 
	{
	return 0;#allow user to exit sign up form, checked each time
	}
	elseif($address ==":quit") 
	{
	die("Exiting Program!\n");
	}
	#Check valid address input, this only records the length and type input
	$validInput = check_valid_address($address);
	}

	#get and check college's city
	$validInput = false;
	while($validInput == false)
	{
	$city = trim(readline("Please enter your city's name: "));
	if($city== ":exit") 
	{
	return 0;#allow user to exit sign up form, checked each time
	}
	elseif($city ==":quit") 
	{
	die("Exiting Program!\n");
	}
	$validInput = check_valid_city($city);	
	}
	
	#get and check college's state initials
	$validInput = false;
	while($validInput == false)
	{
	$state = trim(readline("Please enter the your state initials: "));
	if($state== ":exit") 
	{
	return 0;#allow user to exit sign up form, checked each time
	}
	elseif($state ==":quit") 
	{
	die("Exiting Program!\n");
	}
	$validInput = check_valid_state($state);
	}

	#get and check college's first 5 zip digits
	$validInput = false;
	while($validInput == false)
	{
	$zip5 = trim(readline("Please enter the first 5 digits of your zip code: "));
	if($zip5== ":exit") 
	{
	return 0;#allow user to exit sign up form, checked each time
	}
	elseif($zip5 ==":quit") 
	{
	die("Exiting Program!\n");
	}
	$validInput = check_valid_zip5($zip5);
	}

	#get and check college's last 4 zip digits
	$validInput = false;
	while($validInput == false)
	{
	$zip4 = trim(readline("Please enter the last 4 digits of your zip code: "));
	if($zip4== ":exit") 
	{
	return 0;#allow user to exit sign up form, checked each time
	}
	elseif($zip4 ==":quit") 
	{
	die("Exiting Program!\n");
	}
	$validInput = check_valid_zip4($zip4);
	}



	#look check for email address input
	$validInput = false;
	while($validInput == false)
	{
	$email = trim(readline("Please enter your email address: "));
	if($email== ":exit") 
	{
	return 0;#allow user to exit sign up form, checked each time
	}
	elseif($email==":quit") 
	{
	die("Exiting Program!\n");
	}
	#Check valid name input, this case is length of name
	$validInput = check_valid_email($email);
	}


	#look check for password input
	$validInput = false;
	while($validInput == false)
	{
	$password = trim(readline("Please enter your password, must be at least 6 characters long: "));
	if($password== ":exit") 
	{
	return 0;#allow user to exit sign up form, checked each time
	}
	elseif($password==":quit") 
	{
	die("Exiting Program!\n");
	}
	#Check valid name input, this case is length of name
	$validInput = check_valid_password($password);
	}

	submitMember($first_name,$last_name,$email,$password,$address,$city,$state,$zip5,$zip4);
	echo"Welcome to MyJaqi! Please return to the main menu to start shopping!\n";
}
#This function Updates the Member's Table in the database 
function submitMember($firstName,$lastName,$Email,$Password,$Address_street,$City,$State,$Zip5,$Zip4)
{
	$newID = false;
	while($newID == false)
	{
	$memberID = generate_MemberID();
	$newID = new_check_memberID($memberID);
	}
	//code to update database
	mysql_query("INSERT INTO Members VALUES('$memberID','$firstName','$lastName','$Email',PASSWORD('$Password'),'$Address_street','$City','$State','$Zip5','$Zip4');");	

}



#This Function Links the Member to the Student
function link_member_student ()
{

}

?>
