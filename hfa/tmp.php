<form action="" method="post">
    name:
    <input type=text name="name"><br>
    password:
    <input type=password name="password"><br>
    <input type="submit" name="submit">

</form>
<?php
if (isset($_POST["password"])) {
    $pwd = $_POST["password"];
    $temp = str_split($pwd);
    $temp2 = array();
    $c=0;
    foreach ($temp as $x) {
        //echo $x;
        $temp3 = ord($x);
        //echo $temp3."<br>";
       // $temp2[$c] = $temp3+1;
        $temp4[$c] = chr($temp3 + 1);
        $c++;
    }
    $epwd=implode("",$temp4);
    echo $epwd;
    
}
?>