<?php
include("header.php");

include("conn.php");
include("menu_expert.php");
$username = $_COOKIE["username"];
?>
<style>
    .qby {
        grid-area: qb;
        background-color: #e6e6e6;
        padding: 15px 15px;

    }

    .ansby {
        grid-area: ab;
        background-color: #e6e6e6;
        padding: 15px 15px;
    }

    .ans {
        grid-area: a;
        background-color: #e6e6e6;
        padding: 15px 15px;
    }

    .que {
        width: 100%;
        grid-area: q;
        background-color: #e6e6e6;
        padding: 15px 15px;
    }

    .query {
        width: 100%;
        padding: 15px 15px;
        background-color: #f2f2f2;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        display: grid;
        grid-gap: 5px;
        grid-template-columns: auto auto;
        grid-template-areas: "qb q"
            "ab a";
        align-items: center;
        font-size: 22px;
    }
</style>
<div class="queries">
    <?php

    if (isset($_POST["ans"])) {
        $qid = $_POST["qid"];

        $ans = $_POST["ans"];
        $update_qry = "UPDATE `query` SET `aname`='$username',`ans`='$ans' WHERE qid=$qid";
        $r = mysqli_query($conn, $update_qry);
        if ($r) {
            echo "Answer posted successfully";
        } else {
            echo "please try again";
        }
    }

    ?>



    <?php

    $fetch_qry = "select * from query ";
    $r1 = mysqli_query($conn, $fetch_qry);
    while ($row = mysqli_fetch_assoc($r1)) {
    ?><br>
        <hr>
        <div class="query">
            <form method="POST">
                <div class="qby"><strong>Question By </strong>: <br><?php echo $row['qname']; ?>(ME)</div>
                <div class="que">
                    <strong> Query </strong> :<br> <?php echo $row['que'];
                                                    ?>
                </div>

                <div class="ansby"><strong>Answer By </strong>:<br> <?php echo $row['aname']; ?></div>

                <div class="ans">
                    <strong>Answer</strong> :<br> <?php echo $row['ans']; ?><br><input type="hidden" name="qid" value="<?= $row['qid'] ?>">
                    <input type="text" name="ans" placeholder="Enter your answer."><input type="submit" name="submit" value="Post">
                </div>
            </form>
        </div>
    <?php

    }
    ?>

</div>


<?php
include("footer.php");
?>