<?php
include("header.php");
session_start();
$num1 = rand(1, 9);
$num2 = rand(1, 9);
$_SESSION["ans"] = $num1 + $num2;
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

<head>

    <meta name="viewport" content="width=device-width, initial-">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>


<body>
    <br>
    <div class="container">


        <form class="form" method="post" action="logincheck.php">


            <table align=center cellspacing=30 class="tbl">
                <tr>
                    <td>Username</td>
                    <td><input class="w3-input" type="text" name="username" placeholder="Enter userId" required></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input class="w3-input" type="password" name="password" placeholder="Enter password" required></td>
                </tr>
                <tr>
                    <td><?= $num1 ?> + <?= $num2 ?></td>
                    <td><input class="w3-input" type="text" name="ans" placeholder="Enter the answer" required></td>
                </tr>
                <tr>
                    <td colspan=2> <input class="w3-button w3-white w3-border w3-border-blue" type="submit" value="Submit" name="submit">
                        <input class="w3-button w3-white w3-border" type="reset" value="Clear" name="clear">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">Don't have account?<br><br><a href="signup.php"><input class="w3-button w3-white w3-border w3-border-orange w3-round-large" type="button" value="Register"></a></td>
                </tr>
                <tr>
                    <td colspan="2"><a href="forgetpwd.php">forget username/password?</a></td>
                </tr>
                <tr>
                    <td colspan="2" style="color:red"><?php
                                                        if (isset($_GET["err"])) {
                                                            echo $_GET["err"];
                                                        } ?></td>
                </tr>
                <tr>
                    <td colspan="2" style="color: Green;"><?php
                                                            if (isset($_GET["msg"])) {
                                                                echo "<span class='msg'>" . $_GET["msg"] . "</span>";
                                                            } ?></td>
                </tr>
            </table>

        </form>
    </div>


</body>
<?php
include("footer.php");
?>