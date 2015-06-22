<?php
//This Function will only get the id from and requires the email to do so
//needs format: SELECT id FROM Members WHERE email = $email
function log_email($q)
{
    	$r = mysql_query($q);
    	$row = mysql_fetch_array($r);
	$result = $row['id'];// only assign the id value to be returned
	return $result;
	
}

//get functions based on Customer
//get orderID based on Members id
function get_orderID($customerID)
{
	$q = mysql_query("SELECT id FROM MyOrders WHERE Members = '$customerID'");
	$row = mysql_fetch_array($q);
	$result = $row['id'];
	return $result;
}

//function to get Customer First Name
function get_CustNameFirst($customerID)
{
	$q = mysql_query("SELECT firstname FROM Members WHERE id = '$customerID'");
	$row = mysql_fetch_array($q);
	$result = $row['firstname'];
	return $result;
}

//function to get Customer Last Name
function get_CustNameLast($customerID)
{
	$q = mysql_query("SELECT lastname FROM Members WHERE id = '$customerID'");
	$row = mysql_fetch_array($q);
	$result = $row['lastname'];
	return $result;
}

//function to get Customer Address
function get_CustAddress($customerID)
{
	$q = mysql_query("SELECT address FROM Members WHERE id = '$customerID'");
	$row = mysql_fetch_array($q);
	$result = $row['address'];
	return $result;
}

//function to get Customer city
function get_CustCity($customerID)
{
	$q = mysql_query("SELECT city FROM Members WHERE id = '$customerID'");
	$row = mysql_fetch_array($q);
	$result = $row['city'];
	return $result;
}

//function to get Customer State
function get_CustState($customerID)
{
	$q = mysql_query("SELECT state FROM Members WHERE id = '$customerID'");
	$row = mysql_fetch_array($q);
	$result = $row['state'];
	return $result;
}

//function to get Customer Zip5
function get_CustZip5($customerID)
{
	$q = mysql_query("SELECT zip5 FROM Members WHERE id = '$customerID'");
	$row = mysql_fetch_array($q);
	$result = $row['zip5'];
	return $result;
}

//function to get Customer Zip4
function get_CustZip4($customerID)
{
	$q = mysql_query("SELECT zip4 FROM Members WHERE id = '$customerID'");
	$row = mysql_fetch_array($q);
	$result = $row['zip4'];
	return $result;
}


//get functions based on productID
//get the description of Product
function get_descpt($productID)
{
	$q = mysql_query("SELECT description FROM Product WHERE id= '$productID'");
	$row = mysql_fetch_array($q);
	$result = $row['description'];
	return $result;
}

//get price of Product
function get_price($productID)
{
	$q = mysql_query("SELECT price FROM Product WHERE id= '$productID'");
	$row = mysql_fetch_array($q);
	$result = $row['price'];
	return $result;
}
#select the link of the member's and students
function get_studArray($user)
{
	$q = mysql_query("SELECT stud_id FROM Members_Student WHERE mem_id= '$user'");
	$row = mysql_fetch_array($q);
	return $row;
}

//Generates a new OrderID
//returns a new OrderID
function generate_OrderID()
{
	/////    genOrd.php    /////
     	$prefix="ord_";
        if ( function_exists("date_default_timezone_set") )
           date_default_timezone_set('US/Eastern');
        $dt=date("d");
        $r=rand(100, 999);
        return "$prefix".$dt.$r;

}

//Generates a new CollegeID
//returns a new CollegeID
function generate_CollegeID()
{
	/////    genCollege.php    /////
     	$prefix="coll_";
        if ( function_exists("date_default_timezone_set") )
           date_default_timezone_set('US/Eastern');
        $dt=date("d");
        $r=rand(10, 99);
        return "$prefix".$dt.$r;

}


//Generates a new MemberID
//returns a new MemberID
function generate_MemberID()
{
	/////    genCollege.php    /////
     	$prefix="mem_";
        if ( function_exists("date_default_timezone_set") )
           date_default_timezone_set('US/Eastern');
        $dt=date("d");
        $r=rand(100, 999);
        return "$prefix".$dt.$r;

}


//Generates a new StudentID
//returns a new StudentID
function generate_StudentID()
{
	/////    genCollege.php    /////
     	$prefix="stud_";
        if ( function_exists("date_default_timezone_set") )
           date_default_timezone_set('US/Eastern');
        $dt=date("d");
        $r=rand(100, 999);
        return "$prefix".$dt.$r;

}

//Generates a new LinkID
//returns a new LinkID
function generate_lnkID()
{
	/////    genCollege.php    /////
     	$prefix="lnk_";
        if ( function_exists("date_default_timezone_set") )
           date_default_timezone_set('US/Eastern');
        $dt=date("d");
        $r=rand(100, 999);
        return "$prefix".$dt.$r;

}


?>
