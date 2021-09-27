<?php
include_once "conn.php";



$username = $_POST["username"];
$upwd = $_POST["password"];
$cupwd = $_POST["pwd"];
$name = $_POST["name"];
$mobno = $_POST["mobno"];
$email = $_POST["email"];
$state = $_POST["state"];
$district = $_POST["district"];
$city = $_POST["city"];
$zipcode = $_POST["zipcode"];
if(isset($_POST["type"])){
    $type=$_POST["type"];
}
else
    {$type=0;}

$q1 = "select * from user where email='$email'";
$r1 = mysqli_query($conn, $q1);
$num = mysqli_num_rows($r1);

$q2 = "select * from user where username='$username'";
$r2 = mysqli_query($conn, $q2);
$num2 = mysqli_num_rows($r2);


if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
    $err = "Only letters and white space allowed in name";
    header("Location: signup.php?msg=$err");
}
else{
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err = "Invalid email format";
        header("Location: signup.php?msg=$err");
    }
    else{
        if($upwd != $cupwd ){
            $err = "passwords are not same.";
            header("Location: signup.php?msg=$err"); 
        }
   
    else{
        if (!preg_match("/^[a-zA-Z-' ]*$/", $city)) {
            $err = "Only letters and white space allowed in city";
            header("Location: signup.php?msg=$err");
        } else {
                if (!preg_match("/^[a-zA-Z-' ]*$/", $state)) {
                    $err = "Only letters and white space allowed in state";
                    header("Location: signup.php?msg=$err");
                }
            
            else {
                if (!preg_match("/^[a-zA-Z-' ]*$/", $district)) {
                    $err = "Only letters and white space allowed in district";
                    header("Location: signup.php?msg=$err");
                }

                    if($num == 0 && $num2 == 0)
                    {
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
                        
                        $q = "INSERT INTO `user` (`userid`, `name`, `username`, `type`, `pwd`, `mobile_no`, `email`, `zipcode`, `state`, `city`, `district`) VALUES (NULL, '$name', '$username' , $type , '$epwd' ,'$mobno', '$email' , $zipcode , '$state', '$city','$district')";
                        $r = mysqli_query($conn, $q);
                        if ($_COOKIE["type"] == 1)
                        {
                                header("Location: admin_index.php?sts=done!");
                        }
                        else{
                              header("Location: login.php");
                        }
                    }
                    else
                    {
                        if($num2 != 0)
                            header("Location: signup.php?msg=username already exist");
                        else
                            header("Location: signup.php?msg=email already exist");
                    }
                    mysqli_close($conn);
                }
            }
        }
    }
}

?>
