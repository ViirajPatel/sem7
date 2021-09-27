<?php
include("header.php");
include("menu_user.php");
$url = "https://api.data.gov.in/resource/9ef84268-d588-465a-a308-a864a43d0070?api-key=579b464db66ec23bdd000001cdd3946e44ce4aad7209ff7b23ac571b&format=json&offset=0&filters[commodity]=";
?>
<div class="instructions">
    <hr>
    <p width='80%' align=center>
    <ul>
        <li> if you want to search by state then you must check the checkbox at after the text and if you want search by both then select both.</li>
        <li> if you want all the record you can direct click on <strong>Get Data</strong> button.</li>
        <li> Please enter the values with first letter capital.</li>
    </ul>
    <hr>
    </p>
    <p align=center>
    <table align=center cellspacing=20>
        <tr>
            <td><input type="checkbox" id="c_com">Search by Commodity : </td>
            <td><input class="w3-input" type="text" name="search" placeholder="Enter the name of commodity" id="commodity"></td>
        </tr>
        <tr>
            <td><input type="checkbox" id="c_state">Search by State : </td>
            <td><input class="w3-input" type="text" name="search" placeholder="Enter the name of State" id="state"></td>
        </tr>
        <tr>
            <td colspan="2" align=center><input class="w3-button w3-white w3-border" type="button" name="btn" value="Get Data" onclick="getx()"></td>
        </tr>
    </table>
    </p>
    <br>
</div>
<hr>
<script>
    async function getx() {
        c_name = document.getElementById("commodity").value;
        s_name = document.getElementById("state").value;
        c_com = document.getElementById("c_com");
        c_state = document.getElementById("c_state");
        var fltr = "";
        if (c_com.checked == true) {
            fltr += "&filters[commodity]=" + c_name;
        }
        if (c_state.checked == true) {
            fltr += "&filters[state]=" + s_name;
        }
        const response = await fetch('https://api.data.gov.in/resource/9ef84268-d588-465a-a308-a864a43d0070?api-key=579b464db66ec23bdd000001cdd3946e44ce4aad7209ff7b23ac571b&format=json&offset=0&limit=20' + fltr);
        const data = await response.json();
        totalt = data.total;
        total = Math.ceil(totalt / 10);

        max = data.count;
        var text = "Unit Price is in Rs/Quintal <br><table width='80%' class='w3-table-all w3-card-4 w3-hoverable' ><tr><th>State</th><th>District</th><th>Market</th><th>Commodity</th><th>Variety</th><th>Date</th><th>Minimum Price</th><th>Maximum Price</th><th>Modal Price</th></tr>";

        // for (var i = 0; i < max; i++) {
        //     state = data.records[i].state;
        //     district = data.records[i].district;
        //     market = data.records[i].market;
        //     commodity = data.records[i].commodity;
        //     variety = data.records[i].variety;
        //     arrival_date = data.records[i].arrival_date;
        //     min_price = data.records[i].min_price;
        //     max_price = data.records[i].max_price;
        //     modal_price = data.records[i].modal_price;
        //     text += "<tr><td>" + state + "</td>";
        //     text += "<td>" + district + "</td>";
        //     text += "<td>" + market + "</td>";
        //     text += "<td>" + commodity + "</td>";
        //     text += "<td>" + variety + "</td>";
        //     text += "<td>" + arrival_date + "</td>";
        //     text += "<td>" + min_price + "</td>";
        //     text += "<td>" + max_price + "</td>";
        //     text += "<td>" + modal_price + "</td></tr>";

        // }
        for (var j = 0; j < total; j++) {
            response1 = await fetch('https://api.data.gov.in/resource/9ef84268-d588-465a-a308-a864a43d0070?api-key=579b464db66ec23bdd000001cdd3946e44ce4aad7209ff7b23ac571b&format=json&offset=' + j * 10 + '&limit=20' + fltr);
            data1 = await response1.json();
            max = data1.count;
            for (var i = 0; i < max; i++) {
                state = data1.records[i].state;
                district = data1.records[i].district;
                market = data1.records[i].market;
                commodity = data1.records[i].commodity;
                variety = data1.records[i].variety;
                arrival_date = data1.records[i].arrival_date;
                min_price = data1.records[i].min_price;
                max_price = data1.records[i].max_price;
                modal_price = data1.records[i].modal_price;
                text += "<tr><td>" + state + "</td>";
                text += "<td>" + district + "</td>";
                text += "<td>" + market + "</td>";
                text += "<td>" + commodity + "</td>";
                text += "<td>" + variety + "</td>";
                text += "<td>" + arrival_date + "</td>";
                text += "<td>" + min_price + "</td>";
                text += "<td>" + max_price + "</td>";
                text += "<td>" + modal_price + "</td></tr>";

            }

        }
        text += "</table>";
        document.getElementById("info").innerHTML = text;
        text = "";
    }
</script>

<div id="w3-responsive"></div>
<hr>
<?php
include("footer.php");
?>