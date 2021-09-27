<?php
include "conn.php";
include "header.php";
$temp = 0;
$method = "get";
if ($_POST) {

    $value = $_POST["email"];


    $method = "post";
} else {
    $value = "";
}
if (isset($_POST["otp"])) {

    if ($_COOKIE["temp"] == $_POST["otp"]) {
        $temp = 2;
    } else {

        $temp = 1;
        echo "otp is incorrect";
    }
}
if (isset($_POST["password"]) && isset($_POST["pwd"])) {
    if ($_POST["password"] == $_POST["pwd"]) {
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
        $x = "UPDATE `user` SET `pwd`='$epwd' WHERE email='$value'";
        $qry = mysqli_query($conn, $x);
        $temp = 3;
        if ($qry)
            header("Location: login.php?msg=Password Updated Successfully");
    } else {
        $temp = 2;
        echo "<div class=msg>Passwords not matched.</div>";
    }
}

?>

<style>
    .container {
        padding: 50px 50px 50px 50px;
        justify-items: center;
        /* background-image: linear-gradient(to right, #e6f7ff, white, white, white, white, #e6f7ff); */
        background-color: #f2f2f2;

    }

    .tbl {
        background-image: radial-gradient(white, #f2f2f2);
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    .form {
        text-align: center;
    }

    .tbl {
        text-align: center;
    }
</style>
<div class="container">
    <form class="form" action="" method="post">
        <table class="tbl" align="center" cellspacing=30>
            <tr>
                <td>
                    Enter Email
                </td>
                <td>
                    <input class="w3-input" type="text" name="email" value="<?= $value ?>" placeholder="Enter userId">
                </td>
            </tr>
            <?php
            if ($_POST) {


                $q = "select * from user where email='$value'";
                $r = mysqli_query($conn, $q);
                $row = mysqli_fetch_assoc($r);
                if (mysqli_num_rows($r) == 1) {


                    if ($temp == 2) {
                        echo ' <tr>
                <td>Password</td>
                <td>';
                        echo  '<input class="w3-input" type="password" name="password" id="password" placeholder="Enter password"></td>
            </tr>';

                        echo '<tr>
                <td>confirm Password</td>
                <td>';
                        echo  '<input class="w3-input" type="password" name="pwd" id="pwd" placeholder="reenter the password" onchange="validate()"><span id="err1"></span><span id="err"></span></td>
            </tr>';
                    } else {

                        if ($temp != 2 && $temp != 3) {
                            echo '<tr>
                <td>Enter Otp</td>
                <td>';
                            echo '<input class="w3-input" type="number" name="otp" placeholder="Enter OTP"></td>
            </tr>';
                        }
                        if ($temp == 0) {
                            $otp = rand(0000, 9999);
                            setcookie('temp', $otp, time() + 3600, "/", "", 0);

                            shell_exec("python mail.py " . $value . " " . $otp);
                        }
                    }
                } else {
                    echo "This email id not associated with any user's account.";
                }
            }
            ?><tr>
                <td colspan="2" align=center>
                    <input type="submit" class="w3-button w3-white w3-border w3-border-blue" value="Submit" name="submit">
                    <a href="login.php"><input class="w3-button w3-white w3-border w3-border-red" type="button" value="Back"></a>
                </td>
            </tr>
        </table>
    </form>

</div>
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
</script>
<?php
include "footer.php";
?>