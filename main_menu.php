<?php
###################################################################################
##Name:		MyJaqi Store Application
##Programmer:	Jacob Schoenfeld
##Purpose:	To Create A Store that allows Students to make their own Fundraiser
##Class:	Intro To Database System Design
##Professor:	Paul S. Wang
##Date:		3/13/12
##Modifications:	Date:		Description:		Programmer:
##
##
###################################################################################
#List of objectives of this room:
#This menu is the main menu of the MyJaqi Application
#Each Choice is its own function and has its own corresponding php file here
#Choices The user has to chose from:
#1 This menu displays the options of viewing items when logged in
	#1 User must be a member
	#2 User must log in to view items

#2 This menu will allow a new user to be created
	#1 New User must enter their email address
	#2 New User must enter their name: first, last
	#3 New User must enter their address: street, city, state, zip5, zip4
	#4 If they have a student, add student assigned ID to account
	#5 If they have no student, "default" student is assigned: 
		#which will take the money into a fund instead for all students

#3 This menu should be able to allow new students to be added
	#1 New student must provide name
	#2 New student must provide school name
	#3 New student must provide busar office details

#4 This menu should be able to exit the program entirly
####################################################################################

#Connect to database
require_once("mysql.php");
#add in other menu files
require_once("items_menu.php");
require_once("new_member.php");
require_once("new_student.php");
require_once("new_college.php");
require_once("checkvalue.php");
require_once("getvalue.php");
#Enter code here to clear screen maybe

#Main menu's Controller
$exitApplication = false;
while($exitApplication == false)
{
	

	#display main menu
	display_main_menu();
	#gather user choice from input
	$UserChoice = trim(readline("Your Input Choice: "));
	switch($UserChoice)
	{
		case 1:
			#Login User, takes them to View Item's main menu
 			items_main_menu();
			#This should call a void function that handles all the View Item's Main Menu features
			break;
		case 2:
			#Create New Member
			new_member();
			#This should call the void Function for New User Creation
			break;
		case 3:
			#Create New Student
			new_student();
			#This should call the void Function for New Student Creation
			break;
		case 4:
			#Add New College
			new_college();
			break;
		case 5:
			#This function should allow for the user to exit the program Entirely
			$exitApplication = true;
			break;
		default:
			echo "Invalid Input. Please enter the corresponding menu number.\n";
			break;
	}
	
}
	#Exiting statement for user to know it is the end of the program
	echo "Exiting Program, Thank You for Using MyJaqi.\n \n";
	trim(readline("Press enter to continue"));


#Display Main Menu Function, All it does is display text of the menu Controller
function display_main_menu()
{
	echo "\n";
	echo "Welcome to MyJaqi's Main Menu.\nPlease Enter a number to do the following tasks:\n";
	echo "1. Login and View Items.\n";
	echo "2. Register New Member.\n";
	echo "3. Register New Student.\n";
	echo "4. Register New College.\n";
	echo "5. Exit Store.\n";
	echo "\n";
}


?>
