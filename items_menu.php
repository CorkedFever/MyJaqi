<?php
#This is the Item's and Member's Main Menu
#This is controlled by a void Funtion with a While-Switch statement and will return back to the main_menu
#menu features: 
	#Should be able to display Date at the top of main menu
	#Should be able to display Size of Cart at all times
	#orderID will be generated before menu is displayed
	#memberID will be taken from Login
#This menu should do the following tasks:
#1. This menu should display All Items of the store
	#1. Should be able to ADD items,RETURN to Item's Menu
#2. This menu should allow Viewing of the Item's Cart.
	#1. Should be able to Edit Quanity of items in the Cart
		#REMOVE items, CLEAR ALL items
#3. This menu should allow check out. 
	#1. Checkout should display recipt
	#2. Display List of Purchases, description, product
	#3. Display Student's Cut
#4. Be able to view all previous purchase made.
	#1. List Purchases made by Date
#5. This menu should allow Exiting to main menu and clear the Item's Cart and log out user

function items_main_menu()
{	
	#menu controller, while-switch controller
	#This variable will also void all access to the rest of this function if changed to true before the while loop
	$exitItemsMenu = false;

	#clear screen code
	
	#login user using email address and PASSWORD
	$user=login_user();
	#$pass = trim(readline("Please enter your password: "));
	#$exitItemsMenu = AuthenUserPassword($pass); #if it is real, then exit is false and the user can continue
	#generate orderID
	

	
	$cartArray = array();#sets the cart to nothing at start of function

	echo $user;
	if($user == false)
	{
		echo"Invalid Email Address.\n";
	}
	else
	{
	while($exitItemsMenu == false)
	{
		item_main_display();
		$UserChoice = trim(readline("Your Input Choice: "));
		switch($UserChoice)
		{
			case 1:
				#View List of Items
				display_items();
				view_addItem(&$cartArray);
				echo "\n";
				break;
			case 2:
				#Display Cart
				$cartArray = view_cart_controls(&$cartArray);
				break;
			case 3:
				#Display Checkout
				checkout_cart($cartArray,$user);
				break;
			case 4:
				#Add new student to the account
				link_student_member($user);
				break;
			case 5:
				#exits back to the main menu
				$exitItemsMenu = true;
				break;
			case ":quit":
				#exit program
				die("Exiting Program!");
				break;
			default:
				echo "Invalid Input. Please enter the corresponding menu number.\n";
				break;
		}
	}
	}
}
#Add new student to account
function link_student_member($user)
{
	$validInput = false;
	while($validInput == false)
	{
	echo"\n";
	echo"To return to previous menu. Type \":exit\"\n";
	$student_code = trim(readline("Please enter the student code: "));
	if($student_code == ":quit")
	{
		die("Exiting Program!");
	}
	elseif($student_code == ":exit")
	{
		return 0;
	}
		$validInput = check_studID($student_code);
		$useOnce = check_studAddOnce($user,$student_code);
		if($validInput== true && $useOnce == true)
		{
			link_commit($user,$student_code);
			echo"Student ADDED!";
		}
		elseif($useOnce == false)
		{
			echo"You already have that student added.\n";
		}
	
	}
}
#commit link for student and member accounts
function link_commit($user,$student_code)
{
	$startAmount = 0.00;
	$newID = false;
	while($newID == false)
	{
	$lnkID = generate_lnkID();
	$newID = new_check_lnkID($lnkID);
	}
	mysql_query("INSERT INTO Members_Student VALUES('$lnkID','$user','$student_code','$startAmount');");
	
}


#item main menu display function
function item_main_display()
{
	echo "\n";
	echo "Welcome to our Product's Menu.\nPlease enter a number to do the following tasks:\n";
	echo "1. View Products.\n";
	echo "2. Display Cart.\n";
	echo "3. Checkout.\n";
	echo "4. Add Student to your account. \n";
	echo "5. Exit to Main Menu.\n";
}


#Displays all the times and the given Choices to make on this sub menu
function display_items()
{
	#$spaces == number of character spaces created by \t and ||
	$spaces = 114;
	echo "\n";
	$i = 0;
	while($i<$spaces)
	{
	echo "=";
	$i = $i +1;
	}
	echo "\n";
	echo "||\t";
	echo "Product ID";
	echo "\t||\t";
	echo "Description";
	echo "\t\t\t||\t";
	echo "Type";
	echo "\t\t||\t";
	echo "Price\t\t||\n";
	$i = 0;
	while($i<$spaces)
	{
	echo "=";
	$i = $i +1;
	}
	echo "\n";
	$QU3 = mysql_query("SELECT DISTINCT Product.id, Product.description, Product.type, Product.price FROM Product");
	while($row = mysql_fetch_array($QU3))
	{
		echo "||\t";
		echo $row['id'];
		echo "\t||\t";
		echo $row['description'];
		echo "\t\t||\t";
		echo $row['type'];
		echo "\t\t||\t";
		echo $row['price'];
		echo "\t\t||";
		echo "\n";
	}
	$i = 0;
	while($i<$spaces)
	{
	echo "=";
	$i = $i +1;
	}
	echo "\n";
	
}
#########################################################################################################################
//This function will Authenticate the user's email address and pass back user's MemberID
function AuthenUserLog($loginEmail)
{
	$clean = mysql_escape_string($loginEmail);
	$sql = "SELECT id FROM Members WHERE email = '$clean'";
	$result = log_email($sql);# get id code
	return $result;
}
//prompt for user's login, which will just ask for the email address
function login_user()
{
	$login= trim(readline("Please log in with your email address: "));
	#$password = getpass();
	$result = AuthenUserLog($login);
	
	return $result;
}
#function used to hide password and only show stars
function getpass()
{   echo "Password: ";
    $p="";
    system('stty -echo -cooked');
    while ( ($c = fgetc(STDIN)) != "\r" )
    { echo "*"; $p .= $c; }
    system('stty echo cooked');
    echo "\n";
    return trim($p);
}
#########################################################################################################################




#########################################################################################################################
#allows control over the cart_Array
function view_addItem(&$cart_Array)
{
	//this section will allow the user to add items to the cart array which will be returned
	//ADC = add cart
$loopADC = false;
while($loopADC == false)
{
	echo "Type \"ADD\" to add to your cart. \nType \"RETURN\" to return to main menu and procede to checkout.\n \n";
	$adc = trim(readline("Your Choice: "));
	switch($adc)
	{
		
		case "ADD":
			$ChosenID = trim(readline("Please enter the ID number of the product: "));
			if(check_prodID($ChosenID) == TRUE)
			{
				
					$Quantity = trim(readline("Please enter the Quanity: "));
					if($Quantity>0)
					{
					// add to array of product IDs checks for duplicates in array
						if(check_cartProd($ChosenID,$cart_Array))
						{
							$listCart = cartLocation($ChosenID,&$cart_Array);
							editCart($listCart, $Quantity,&$cart_Array);
						}
						else
						{
						addCart($ChosenID, $Quantity,&$cart_Array);
						}
					}
					elseif($Quantity == ":exit")
					{
						return 0;
					}
					elseif($Quantity == ":quit")
					{
						die("Exiting Program!");
					}
					else
					{
					echo "Invalid Input. Value is not a positive integer.\n";
					}
			}
			elseif($ChosenID == ":exit")
			{
				return 0;
			}
			elseif($ChosenID == ":quit")
			{
				die("Exiting Program!");
			}
			else
			{
				echo "Invalid Input. ID number of product does not exist.\n";
			}
			
			break;
		//exit this switch and while loop
		case "RETURN":
			$loopADC = true;
			break;
		case ":exit":
			return 0;//exiting switch
			break;
		case ":quit":
			die("Exiting Program!");
		default:
		//invalid input catch
			echo "Invalid input. Please type either \"ADD\" or \"RETURN\".\n";
			break;
	}		
}
}

//checks cart for previous product ID value
function check_cartProd($ChosenID,$cart_Array)
{
	reset($cart_Array);
	foreach($cart_Array as $key =>$value)
	{
		if($value[0] == $ChosenID)
		{
			return TRUE;
		}

	}
	return FALSE;
}


//add to cart function,
function addCart($ChosenID, $Quanity,&$cart_Array)
{
	//add $ChosenID and quanity to an array
	//array is call by reference
	array_push($cart_Array, array($ChosenID,$Quanity));
}

//edits Cart by modifying the cart at the given location and adding the Quantities together
function editCart($listCart, $NewQuantity,&$cart_Array)
{
	
	$currentQuant = $cart_Array[$listCart][1];
	$listCartADD1 = $listCart +1;//needs adjusted for the changeQuant for subtracting 1
	$NewQuant = $currentQuant + $NewQuantity;
	changeQuant(&$cart_Array,$listCartADD1,$NewQuant);
}
#########################################################################################################################





#########################################################################################################################
//edits the cart
function cartLocation($ChosenID,&$cart_Array)
{
	$counter = 0;
	reset($cart_Array);
	foreach($cart_Array as $key =>$value)
	{
		if($value[0]==$ChosenID)
		{
			echo $counter;
			echo "\n";
			return $counter;
		}
	$counter++;
	}
	echo "Product not found in Cart\n";

}
function view_cart($cart_Array)
{
	echo "\n \t YOUR CART\n";
	//Display the cart Array to the Screen
	reset($cart_Array);
	echo "||\tITEM\t||\t\tDESCRIPTION\t\t\t||\tQUANITY\t\t||\n";
	foreach ($cart_Array as $key=>$value) {
   	$counter = 0;
	$CartPlace = $key + 1;//used to make a number place in the cart display
	echo "||\t";
	echo $CartPlace;
	echo "\t||\t\t";
        echo get_descpt($value[0]);
	echo "\t\t||\t";
	echo $value[1];
	echo "\t\t||";
        $counter++;

	echo "\n";
	}
	$exit = false;
	echo"\n";
	echo"\n";

}
//view cart function and displays the cart array to the user
function view_cart_controls(&$cart_Array)
{
	/*echo "||\t";
		echo $row['id'];
		echo "\t||\t";
		echo $row['description'];
		echo "\t\t||\t";
		echo $row['type'];
		echo "\t\t||\t";
		echo $row['price'];
		echo "\t\t||";
		echo "\n";
	*/
	if(count($cart_Array)>0)
	{
	//This is the choice to change your item's amount
	$exit = false;
	while($exit == false || count($cart_Array)>0)
	{
		view_cart($cart_Array);
		echo"Do you wish to edit your cart?\n";
		echo"Type EMPTY to empty your cart entirly\nType REMOVE to remove items from your cart\nType CHANGE to change amount already in the cart\n, or RETURN to return to main menu\n";
		$edit = trim(readline("Your Choice: "));
		
		switch($edit)
		{
			case "CHANGE":
				$listNum = trim(readline("Enter Cart item's number to edit amount: "));
				$listActual = count($cart_Array);
				if(($listNum<=$listActual)&&(ctype_digit($listNum)==TRUE)&&($listNum>=0))
				{
				
					$newValue = trim(readline("Enter new quanity for item: "));
					if(((ctype_digit($newValue))&&($newValue>0)))
					{
						
						changeQuant(&$cart_Array,$listNum,$newValue);//changeQuant function call
						echo "Quantity Changed\n";
					}
					elseif($newValue == ":exit")
					{
						return $cart_Array;
					}
					elseif($newValue == ":quit")
					{
						die("Exiting Program!");
					}
					else
					{
						echo "Number is not a positive Integer.\n";
					}

				}				
				elseif($listNum == ":exit")
				{
					return $cart_Array;
				}
				elseif($listNum == ":quit")
				{
					die("Exiting Program!");
				}
				else
				{
					echo "Number not listed in Your Cart's Item list\n";
				}
				break;
			case "REMOVE":
				$listNum2 = trim(readline("Enter Cart item's number to delete: "));
				$listActual2 = count($cart_Array);
				if(($listNum2<=$listActual2)&&(ctype_digit($listNum2)==TRUE)&&($listNum2>=0))
				{
				
					itemRemove($cart_Array,$listNum2);
					echo "Item $listNum2 deleted\n";

				}
				elseif($listNum2 == ":exit")
				{
					return $cart_Array;
				}
				elseif($listNum2 == ":quit")
				{
					die("Exiting Program!");
				}
				else
				{
					echo "Number not listed in Your Cart's Item list\n";
				}
				break;
			case "EMPTY":
				unset($cart_Array); #deletes all contents of cart array inculding the cart itself
				$cart_Array = array(); #redefines cart Array	
				return $cart_Array;
				break;
			case "RETURN":
				return $cart_Array;//exiting switch
				break;
			case ":exit":
				return $cart_Array;//exiting switch
				break;
			case ":quit":
				die("Exiting Program!");
				break;
			default:
				echo "Invalid input. Please re-enter. Either YES or RETURN\n";
				break;
		}
		if(count($cart_Array)==0)
		{
		echo "\n\nYOUR CART IS EMPTY\n View Products to Add Items to cart\n\n";
		}
		
	}
}
	else
{
	echo "\n\nYOUR CART IS EMPTY\n View Products to Add Items to cart\n\n";
}
	return $cart_Array;
}


//this function will change the quanity of an item in the cart array
function changeQuant(&$cart_Array,$listNum,$newValue)
{
	$place = $listNum - 1;
	$cart_Array[$place][1] = $newValue;
	
}
//this funciton will remove an item from your cart
function itemRemove(&$cart_Array,$listNum2)
{
	$listNum2 = $listNum2 - 1;
	unset($cart_Array[$listNum2]);
	array_values($cart_Array);
}
#########################################################################################################################



#########################################################################################################################
//this function actually accesses the database and stores the cartArray inside it
function checkout_cart($cart_Array,$user)
{
	$newID = false;
	while($newID == false)
	{
	$orderID = generate_orderID();
	$newID = new_check_orderID($orderID);
	echo "$orderID \n";
	}


view_cart($cart_Array);
$confirm = trim(readline("Confirm checkout? yes/no\n"));

if(count($cart_Array)>0&&$confirm == "yes")
{

	reset($cart_Array);
	foreach ($cart_Array as $key=>$value)
	{
	$product = $value[0];
	$quanity = $value[1];
	mysql_query("INSERT INTO MyOrders VALUES('$orderID','$user',CURRENT_DATE)");
	//mysql_query("UPDATE orders SET order_date = CURRENT_DATE WHERE id ='$orderID'AND customer = '$user'");
	mysql_query("INSERT INTO Order_Items VALUES('$orderID','$product','$quanity')");//If value is needed to be re entered 	after checkout.
	}
	$totalPrice = view_receipt($cart_Array,$user,$orderID);
	stud_commision($totalPrice,$user);
	
}
elseif($confirm ==":quit")
{
	die("Exiting Program!\n");
}
elseif($confirm != "yes"&& count($cart_Array)>0)
{
		echo"Returning to previous menu.\n";
		return 0;
}
else
{
	echo "\n\nYOUR CART IS EMPTY\n View Products to Add Items to cart\n\n";
}

}
//function used to evenly distribute the 1/2totalPrice to all the students with user account
function stud_commision($totalPrice,$user)
{
	//divide totalPrice by half
	$halfTotal = $totalPrice / 2;
	
	//get student array
	$studArray = get_studArray($user);
	if($studArray >0)
	{
	//divide 1/2totalPrice by total amount of students
	$commission = $halfTotal/count($studArray);
	//update each student-member link
	foreach($studArray as $key => $value)
	{
		mysql_query("UPDATE Members_Student set student_earn = student_earn + '$commission' WHERE mem_id = '$user' AND stud_id = '$value'");
	}
	
	}

}
//function used to veiw the reciept based on the cartArray
function view_receipt($cart_Array,$user,$orderID)
{
if(count($cart_Array)>0)
{

	$totalPrice = 0;
	echo "\n \n";
	date_default_timezone_set('US/Eastern');
	$Date = getdate(date("U"));
	//Displaying Receipt
	echo "Displaying Receipt\n";

	//Displaying Date
	echo "Date: $Date[weekday], $Date[month] $Date[mday], $Date[year]";
	echo "\n";

	//Displaying Order ID
	echo "Order ID: $orderID \n \n";
	echo "Customer Information: \n";
	//Displaying User Information
	echo get_CustNameFirst($user)."\t".get_CustNameLast($user);
	echo "\n";
	echo get_CustAddress($user);
	echo "\n";
	echo get_CustCity($user)."\t".get_CustState($user);
	echo "\t";
	echo get_CustZip5($user)."-".get_CustZip4($user);
	echo "\n";
	echo "\n";

	//Displaying orders
	echo "Product\t \t\tPrice\t Quanity\n";
	foreach($cart_Array as $key => $value)
	{
		echo get_descpt($value[0]);
		echo "\t \t";
		$price = get_price($value[0]) * $value[1];
		$totalPrice = $totalPrice + $price;
		echo get_price($value[0]);
		echo "\t ";
		echo $value[1]; //This is the Quanity Value
		echo "\n";
		
	}
	//Displaying Total Price
	echo "Total Price:$ $totalPrice";
	
	
	echo "\n";
	echo "\n";
	return $totalPrice;
}
else
{
	echo "\n\nYOUR CART IS EMPTY\n View Products to Add Items to cart\n\n";
}

}





?>
