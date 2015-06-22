<?php

function new_student()
{
	#clear screen
	
	
	
	$end_menu = false;
	while($end_menu == false)
	{
		student_display_menu();
		$choice = trim(readline("Your Choice: "));
		switch($choice)
		{
			case 1:
				add_student();
				break;
			case 2:
				$end_menu = true;
				break;
			case ":quit":
				die("Exiting Program!\n");
			default:
				echo"Invalid Input. Please enter the number shown on the menu\n";
				break;
		}
	}

}

function student_display_menu()
{
	echo"Welcome new students to MyJaqi!\n Please input a number to do the following commands.\n";
	echo"1. Sign up as a new student.\n";
	echo"2. Return to the main menu.\n";
}

function add_student()
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
	
	#get and check last name of student
	$validInput = false;
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
	$validInput = check_validName_first($last_name);
	}
	
	#get year of student
	$validInput = false;
	while($validInput == false)
	{
	$student_year = trim(readline("Please enter your year in college: "));
	if($student_year== ":exit") 
	{
	return 0;#allow user to exit sign up form, checked each time
	}
	elseif($student_year==":quit") 
	{
	die("Exiting Program!\n");
	}
	$validInput = check_validYear($student_year);
	}

	#get name of student's college
	$validInput = false;
	while($validInput == false)
	{
	$q = mysql_query("SELECT id, name FROM Colleges");
	
	while($row = mysql_fetch_array($q))
	{
		echo $row['id'];
		echo "\t";
		echo $row['name'];
		echo "\n";
	}
	echo"\n";
	echo"Note: If your college is not listed, please exit and sign it up from the main menu.\n";
	$listNumber = trim(readline("Please enter your College's id number from the list: "));
	if($listNumber== ":exit") 
	{
	return 0;#allow user to exit sign up form, checked each time
	}
	elseif($listNumber==":quit") 
	{
	die("Exiting Program!\n");
	}
	#Check valid name input, this case is length of name
	$validInput = check_validCollege($listNumber);
	}


	#get student's bannerID number
	$validInput = false;
	while($validInput == false)
	{
	$student_bannerID = trim(readline("Please enter your banner or college ID number: "));
	if($student_bannerID== ":exit") 
	{
	return 0;#allow user to exit sign up form, checked each time
	}
	elseif($student_bannerID==":quit") 
	{
	die("Exiting Program!\n");
	}
	$validInput = check_validBannerID($student_bannerID);
	}

	
	new_student_commit($first_name,$last_name,$student_bannerID,$listNumber,$student_year);
	echo"Welcome to myJaqi $first_name!\n";
	trim(readline("Press enter to continue."));
}

function new_student_commit($student_firstName,$student_lastName,$student_BannerID,$student_collegeID,$student_year)
{
	//call collegeID generator
	$newID = false;
	while($newID == false)
	{
	$studentID = generate_StudentID();
	$newID = new_check_studentID($studentID);
	}
	//code to update database
	mysql_query("INSERT INTO Students VALUES('$studentID','$student_firstName','$student_lastName','$student_BannerID','$student_collegeID','$student_year');");	

	echo"Here is your studentID code number for MyJaqi: $studentID \n";
	echo"Give your ID to any customer so they can add you to their account! \n";
	echo"Every Purchase they make with your code will give you money to your student account! \n";
	
}

?>
