<?php
 include_once "conn.php";
	//$conn=mysqli_connect("localhost","root","","ps5");
	
	session_start();
	$username=$_POST["username"];
	$upwd=$_POST["password"];
	$uans=$_POST["ans"];

	$pwd = $upwd;
	$temp = str_split($pwd);
	$temp2 = array();
	$c = 0;
	foreach ($temp as $x) {
		//echo $x;
		$temp3 = ord($x);
		//echo $temp3."<br>";
		// $temp2[$c] = $temp3+1;
		$temp4[$c] = chr($temp3 + 1);
		$c++;
	}
	$epwd = implode("", $temp4);
	if(intval($_SESSION["ans"])!=$uans)
	{
		$msg="Ans is incorrect!";
		header("Location: login.php?err=$msg");
	}
    else
    {
		if($username==NULL || $epwd==NULL)
		{
				header("Location: login.php?err=Please Enter all details");
		}
		else{
		$q="select * from user where username='$username' and pwd='$epwd'";


		$r = mysqli_query($conn, $q);
		$row = mysqli_fetch_assoc($r);



		if (mysqli_num_rows($r) == 1)
		{	
				
					$zipcode= $row["zipcode"];
					setcookie("zipcode", $zipcode, time() + 3600 * 12, "/", "", 0);
					$userid=$row["userid"];
					setcookie("userid", $userid, time() + 3600 * 12, "/", "", 0);
					$type = $row["type"];
					setcookie("type", $type, time() + 3600 * 12, "/", "", 0);
					$unm = $row["username"];
					setcookie("username", $unm, time() + 3600 * 12, "/", "", 0);
			
			if($row["type"]==1)
				header("Location: admin_index.php?id=$userid");
			else{
				if($row["type"] == 2){
					header("Location: expert_index.php?id=$userid");
				}
				else {
					header("Location: user_index.php?id=$userid");
				}
			}

		}
		else
		{
			$msg="name/Password is incorrect!";
			header("Location: login.php?err=$msg");
		}
		}
	}
