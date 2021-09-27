<?php

// if ($userid == $_COOKIE["userid"]) {
$zipcode = $_COOKIE["zipcode"];
include("header.php");




include("menu_admin.php");
?>
<style>
    .container {
        padding-left: 50px;
        padding-top: 50px;
        padding-bottom: 50px;
        padding-right: 50px;
    }
</style>

<form action="" method="post">
    <div class="container">

        <div class="menu">
            <br>
            <a href="signup.php?kng=0"><input class="w3-button w3-white w3-border w3-border-purple w3-round-large" type="button" name="add_admin" value="Add Admin/Expert"></a>

        </div>
        <hr>
        <br>
        <select class="w3-input" name="selection" id="selection" onchange="changeSearch()">
            <option value="name">Name</option>
            <option value="username">Username</option>
            <option value="mobno">Mobile</option>
            <option value="email">Email</option>
            <option value="state">State</option>
            <option value="city">City</option>
            <option value="type">Type</option>
        </select>
        <br>
        <div class="form-group" id="searchbar">

        </div>
        <br>
        <input class="w3-button w3-white w3-border w3-border-blue" type="submit" name="submit" value="GO">



        <script type="text/javascript">
            function changeSearch() {
                var val = document.getElementById("selection").value;
                var elementVar = document.getElementById("searchbar");
                var change = "<input  type='radio' id='1' name='type' value='1'>Admin User&nbsp<input type='radio' id='0' name='type' value='0'>Normal User&nbsp<input type='radio' id='0' name='type' value='2'>Expert User";
                if (val == "type")
                    elementVar.innerHTML = change;
                else
                if (val == "mobno")
                    elementVar.innerHTML = ' <input type="number" class="w3-input" name="searchbar" value="Enter the value" min="1000000000" max="9999999999">';
                else
                    elementVar.innerHTML = ' <input type="text" class="w3-input" name="searchbar" value="Enter the value">';
            }
        </script>

        <div class="main">
            <br> <br>
            <table class="w3-table-all w3-card-4 w3-hoverable" cellspacing="3">
                <tr>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Type</th>
                    <th>Mobile Number</th>
                    <th>Email</th>
                    <th>Zipcode</th>
                    <th>State</th>
                    <th>District</th>
                    <th>City</th>
                    <th>Operation</th>
                </tr>
                <?php
                if ($_POST) {
                    include_once "conn.php";

                    $selection = $_POST["selection"];
                    $value = $_POST[$selection];
                    if ($selection == "type")
                        $q = "select * from user where $selection=$value";
                    else
                        $q = "select * from user where $selection='$value'";
                    $r = mysqli_query($conn, $q);

                    while ($row = mysqli_fetch_assoc($r)) {
                        if ($row["type"] == 1) {
                            $type = "Admin User";
                        } else {
                            $type = "Normal User";
                        }
                        echo '<tr>
                    <td>' . $row["name"] . '</td>
                    <td>' . $row["username"] . '</td>
                    <td>' . $type . '</td>
                    <td>' . $row["mobile_no"] . '</td>
                    <td>' . $row["email"] . '</td>
                    <td>' . $row["zipcode"] . '</td>
                    <td>' . $row["state"] . '</td>
                    <td>' . $row["district"] . '</td>
                    <td>' . $row["city"] . '</td>
                    <td>
                        <a href="update_user.php?username=' . $row["username"] . '&sts=edit_users&msg=bs&kng=0"><button type="button">Update</button></a>
                        <a href="delete_user.php?username=' . $row["username"] . '"><button type="button">Delete</button></a>
                    </td>
                    
                </tr>';
                    }
                }
                ?>

            </table>
        </div>
    </div>
</form>
<?php
include("footer.php");
?>