<?php
include_once "conn.php";
include("header.php");
if ($_GET["sts"] == "edit_profile") {
    $temp = 1;
    $userid = $_COOKIE["userid"];
    $type = $_COOKIE["type"];
    
    $q = "select * from user where userid=$userid";
   
      
    
} else {
    $temp = 0;
    $username = $_GET["username"];
   
    $q = "select * from user where username='$username'";
   }


$r = mysqli_query($conn, $q);

$row = mysqli_fetch_assoc($r);

if ($row["type"] == 1) {
    $type = "Admin User";
    $bkurl = "admin_index.php";
} else {
    $type = "Normal User";
    
}

    if($temp==1)
    {
        if($type==1)
            $url="admin_index.php?sts=done";
        else
            $url="user_index.php?sts=done";
    }
    else
    {
        $url= "edit_users.php?sts=done";
    }
if(isset($_GET["kng"]))
{
    $bkurl= "admin_index.php";
}
else{
    $bkurl="user_index.php";
}

echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
    .w3-input{
        background-color: #f2f2f2
    }
    .container {
        justify-items: center;
        /* background-image: linear-gradient(to right, #e6f7ff, white, white, white, white, #e6f7ff); */
        background-color: #f2f2f2;

    }</style><div class="scrollmenu">
<a href='.$bkurl. '>Back</a>
<a href="logout.php">logout</a>
</div>';
echo '<div class="container">';
 if($_GET["msg"]=="de")
                      {echo '<br><p align=center style="color:Green">Data  has been successfully updated.   </p>';}
        echo '<br><form action="" method="post"><table border="0" align=center cellspacing=30>
           <tr><td>Username
            </td><td><input class="w3-input" type="text" name="username" value="' . $row['username'] . '" readonly></td></tr>';
              if($temp==1)
                {
                    echo
    '<tr><td>Password
                    </td><td><input class="w3-input" type="password" name="password" id="password" placeholder="Enter password" >

                   </td></tr><tr><td>confirm Password
                    </td><td><input class="w3-input" type="password" name="pwd" id="pwd" placeholder="reenter the password" onchange="validate()" ><span id="err1"></span><span id="err"></span>
                    <script type="text/javascript">
                        function validate() {
                            var pwd = document.getElementById("password").value;
                            var pwd1 = document.getElementById("pwd").value;
                            if (pwd != pwd1) {
                                document.getElementById("err").innerHTML = "unmatched";
                            } else {
                                document.getElementById("err").innerHTML = "matched";
                            }
                        }
                    </script>';
                }

    echo '</td></tr><tr><td>Name
            </td><td><input class="w3-input" type="text" name="name" value="' . $row['name'] . '" required>

           </td></tr><tr><td>MobileNO
            </td><td><input class="w3-input" type="text" name="mobno" value="' . $row['mobile_no'] . '" >

           </td></tr><tr><td>Email
            </td><td><input class="w3-input" type="text" name="email" value="' . $row['email'] . '" readonly>

           </td></tr><tr><td>
           Zipcode
            </td><td><input class="w3-input" type="text" name="zipcode" value="' . $row['zipcode'] . '">

           </td></tr><tr><td> State 
            </td><td><input class="w3-input" type="text" name="state" value="' . $row['state'] . '">

           </td></tr><tr><td>District
            </td><td><input class="w3-input" type="text" name="district" value="' . $row['district'] . '">

           </td></tr><tr><td>City
            </td><td><input class="w3-input" type="text" name="city" value="' . $row['city'] . '">



            
            </td></tr><tr><td colspan=2 align=center><input class="w3-button w3-white w3-border w3-border-grey" type="submit" value="Update" name="submit"></td></tr>

       
                
          </table></form>
                ';
               
                    echo "</div>";
if ($_POST) {
    echo "ok";
    $err=0;
    $username = $_POST["username"];
    
    $name = $_POST["name"];
    $mobno = $_POST["mobno"];
    $email = $_POST["email"];
    $state = $_POST["state"];
    $district = $_POST["district"];
    $city = $_POST["city"];
    $zipcode = $_POST["zipcode"];
    
    if ($_GET["sts"] == "edit_profile") {
        if($_POST["password"] && $_POST["pwd"])
        {
            
            if($_POST["password"] == $_POST["pwd"])
            {

                $upwd = $_POST["password"];
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
                $q = "UPDATE `user` SET `name`='$name',`username`='$username',`pwd`='$epwd',`mobile_no`='$mobno',`email`='$email',`zipcode`=$zipcode,`state`='$state',`city`='$city',`district`='$district' WHERE userid=$userid";
            }
            else
            {
                $err=1;
                echo "<div class=msg>Passwords not matched.</div>";
            }
            
        }
        else
        {
            $q = "UPDATE `user` SET `name`='$name',`username`='$username',`mobile_no`='$mobno',`email`='$email',`zipcode`=$zipcode,`state`='$state',`city`='$city',`district`='$district' WHERE userid=$userid";
        }
    } else {
        $q = "UPDATE `user` SET `name`='$name',`username`='$username',`mobile_no`='$mobno',`email`='$email',`zipcode`=$zipcode,`state`='$state',`city`='$city',`district`='$district' WHERE username='$username'";
    }
    $r = mysqli_query($conn, $q);
    if($r && $err==0){
        $msg = "de";
        if($_GET["sts"]=="edit_profile")
        {
            if (isset($_GET["kng"]))
                header("location: update_user.php?sts=edit_profile&msg=$msg&kng=0");
            else
                header("location: update_user.php?sts=edit_profile&msg=$msg");
        }
        else
        {
            $uname= $_GET["username"];
            if (isset($_GET["kng"]))
                header("location: update_user.php?sts=edit_users&username=$uname&msg=$msg&kng=0");
            else
                header("location: update_user.php?sts=edit_users&username=$uname&msg=$msg");
        }
    }
    else
        echo "<div class=msg>Please try again.   </div>";
}

mysqli_close($conn);
include("footer.php");
?>