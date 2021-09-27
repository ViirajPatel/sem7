<?php

include("header.php");
session_start();
$num1 = rand(1, 9);
$num2 = rand(1, 9);
$_SESSION["ans"] = $num1 + $num2;



?>
<style>
    .container {
        padding-left: 50px;
        padding-top: 50px;
        padding-bottom: 50px;
        padding-right: 50px;
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

</head>

<body>
    <div class="container"><?php if(isset($_GET["kng"])){echo '<a href="edit_users.php"><input class="w3-button w3-white w3-border w3-border-black" type="button" value="Back"></a>';}?>
        <form class="form" method="post" action="signupstore.php">
            <table class="tbl" cellspacing=30 align=center>
                <tr>
                    <td>
                        Username <span style="color:red;">*</span></td>
                    <td>
                        <input class="w3-input" type="text" name="username" placeholder="Enter username" required>
                    </td>
                </tr>
                <tr>
                    <td>Password <span style="color:red;">*</span></td>
                    <td><input class="w3-input" type="password" name="password" id="password" placeholder="Enter password" required></td>
                </tr>
                <tr>
                    <td>confirm Password <span style="color:red;">*</span></td>
                    <td><input class="w3-input" type="password" name="pwd" id="pwd" placeholder="reenter the password" onchange="validatepwd()" required><span id="err1"></span><span id="err"></span></td>
                    <script type="text/javascript">
                        function validatepwd() {
                            var pwd = document.getElementById("password").value;
                            var pwd1 = document.getElementById("pwd").value;

                            if (pwd != pwd1) {
                                document.getElementById("err").innerHTML = "unmatched";
                            } else {
                                document.getElementById("err").innerHTML = "matched";
                            }
                        }
                    </script>

                </tr>
                <tr>
                    <td> Name <span style="color:red;">*</span></td>
                    <td><input type="text" class="w3-input" name="name" placeholder="Enter name" required></td>

                    <?php
                    if (isset($_COOKIE["type"])) {
                        if ($_COOKIE["type"] == 1) {
                            echo '</tr><tr><td>Type</td><td><input type="radio" id="male" name="type" value="1">';
                            echo 'Admin';
                            echo '<input type="radio" id="female" name="type" value="2">';
                            echo 'Expert</td>';
                        }
                    }
                    ?>
                </tr>
                <tr>
                    <td>MobileNO</td>
                    <td> <input class="w3-input" type="number" name="mobno" placeholder="Enter Mobile No." min=1000000000 max=10000000000></td>
                </tr>
                <tr>
                    <td>Email <span style="color:red;">*</span></td>
                    <td> <input class="w3-input" type="text" name="email" placeholder="Enter Email" required></td>
                </tr>
                <tr>
                    <td>zipcode</td>
                    <td> <input class="w3-input" type="text" name="zipcode" placeholder="Enter zipcode"></td>
                </tr>
                <tr>
                    <td>state</td>
                    <td> <input class="w3-input" type="text" name="state" placeholder="Enter state"></td>
                </tr>
                <tr>
                    <td> district</td>
                    <td> <input class="w3-input" type="text" name="district" placeholder="Enter District"></td>
                </tr>
                <tr>
                    <td> city</td>
                    <td> <input class="w3-input" type="text" name="city" placeholder="Enter city"></td>
                </tr>
                <tr>

                    <td> <input class="w3-button w3-white w3-border w3-border-blue" type="submit" value="Submit" name="submit"></td>
                    <td><input class="w3-button w3-white w3-border w3-border-grey" type="reset" value="Clear" name="clear"></td>

                </tr>
                <tr>
                    <td colspan="2">Already have account?<br><br><a href="login.php"><input class="w3-button w3-white w3-border w3-border-green" type="button" value="Login"></a></td>
                </tr>
            </table>

        </form>
    </div>

</body>
<?php
include("footer.php");
?>