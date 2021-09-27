<?php
include("header.php");
include("menu_user.php");

$zipcode = $_COOKIE["zipcode"];

?>
<style>
    .date {
        grid-area: date;
    }

    .temp {
        grid-area: temp;
    }

    .hrs {
        grid-area: hrs;
    }

    .daysituation {
        grid-area: daysituation;
    }

    .nightsituation {
        grid-area: nightsituation;
    }

    .rain {
        grid-area: rain;
    }

    .wdate {

        grid-area: wdate;
    }

    .wtemp {

        grid-area: wtemp;
    }

    .whum {

        grid-area: whum;
    }

    .wrain {

        grid-area: wrain;
    }

    .wwind {
        grid-area: wwind;
        color: RGB(146, 168, 209);
    }

    .weather {
        font-size: large;
        color: whitesmoke;
        background-color: #34568B;
        grid-area: weather;
        padding: 25px 25px 25px 25px;
        display: grid;
        grid-template-columns: auto auto;
        grid-template-rows: auto auto auto;
        grid-template-areas: "wdate wtemp"
            "whum wwind"
            "wrain wwind";
        grid-gap: 20px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        text-align: center;
        height: 300px;
        justify-content: center;
    }

    .ttemp {
        grid-area: ttemp;

    }

    .desc {
        grid-area: desc;
    }

    .weathertoday {
        background-color: #88B04B;
        grid-area: wethertoday;
        font-size: large;
        color: whitesmoke;
        padding: 25px 25px 25px 25px;
        display: grid;
        grid-template-columns: auto;
        grid-template-rows: auto;
        grid-template-areas:
            "ttemp"
            "desc";
        grid-gap: 20px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        text-align: center;
        height: 120px;
        justify-content: center;
    }

    .weather1 {
        grid-area: weather1;
        font-size: large;
        color: whitesmoke;
        background-color: #FF6F61;
        padding: 25px 25px 25px 25px;
        display: grid;
        grid-template-columns: auto auto;
        grid-template-rows: auto;
        grid-template-areas: "date hrs"
            "temp temp"
            "daysituation rain"
            "nightsituation rain";
        grid-gap: 20px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        text-align: center;
        height: 300px;
        justify-content: center;
    }

    .btns {
        grid-area: btns;
    }

    .cuurent {
        justify-content: center;
        grid-area: wtdy;
    }

    .days {
        grid-area: days;
    }

    .allday {
        grid-area: alldays;


    }

    .con {
        padding: 50px 50px 50px 50px;
        display: grid;
        grid-template-columns: auto auto;
        grid-template-rows: auto auto;
        grid-template-areas:
            "btns wtdy"
            "days alldays";
        grid-gap: 20px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        
    }
</style>
<script>
    // async function xcurrent() {
    async function xcurrent() {
        const response = await fetch('https://dataservice.accuweather.com/locations/v1/cities/search?apikey=tbKWC8cfGRdUhHBzjB1pxYRADJZhhqv8&q=<?= $zipcode ?>');
        const data = await response.json();
        locationKey = data[0].Key;
        const response2 = await fetch('http://dataservice.accuweather.com/currentconditions/v1/' + locationKey + '?apikey=tbKWC8cfGRdUhHBzjB1pxYRADJZhhqv8');
        const data2 = await response2.json();
        var text = "";
        desc = data2[0].WeatherText;
        temp = data2[0].Temperature.Metric.Value;
        temp2 = data2[0].Temperature.Imperial.Value;

        text += "<div class='weathertoday'>";
        text += "<div class='ttemp'>" + temp + " °C | " + temp2 + " °F</div>";
        text += "<div class='desc'>" + desc + " </div>";

        text += "</div>";
        document.getElementById("wtdy").innerHTML = text;
    }
    async function xget() {

        const response = await fetch('https://dataservice.accuweather.com/locations/v1/cities/search?apikey=tbKWC8cfGRdUhHBzjB1pxYRADJZhhqv8&q=<?= $zipcode ?>');
        const data = await response.json();
        locationKey = data[0].Key;
        const response2 = await fetch('https://dataservice.accuweather.com/forecasts/v1/daily/5day/' + locationKey + '?apikey=tbKWC8cfGRdUhHBzjB1pxYRADJZhhqv8&details=true &metric=true');
        const data2 = await response2.json();
        var text = "";
        for (var i = 0; i < 5; i++) {
            date = data2.DailyForecasts[i].Date;
            mintemp = data2.DailyForecasts[i].Temperature.Minimum.Value;
            maxtemp = data2.DailyForecasts[i].Temperature.Maximum.Value;
            daysituation = data2.DailyForecasts[i].Day.LongPhrase;
            d_rain = data2.DailyForecasts[i].Day.RainProbability;
            nightsituation = data2.DailyForecasts[i].Night.LongPhrase;
            n_rain = data2.DailyForecasts[i].Night.RainProbability;
            hour = data2.DailyForecasts[i].HoursOfSun;
            text += "<div class='weather1'>";
            text += "<div class='date'><strong>Date </strong>: " + date + " </div>";
            text += "<div class='temp'><strong>Minimum Tempereature </strong>: " + mintemp + "°C<br>";
            text += "<strong>Maximum Tempereature </strong>: " + maxtemp + "°C</div>";
            text += "<div class='hrs'> <strong>Hours of sun </strong>: " + hour + " hrs.</div>";
            text += "<div class='daysituation'><strong> Day </strong>: " + daysituation + "</div>";
            text += "<div class='nightsituation'> <strong>Night </strong>: " + nightsituation + "</div>";
            text += "<div class='rain'><table style='color:whitesmoke'> <tr><th colspan=2>Rain Probability </th></tr><tr><td> Day </td><td>" + d_rain + "</td></tr><tr><td> Night </td><td>" + n_rain + "</td></tr></table></div>";
            text += "</div><br>";
        }
        document.getElementById("container").innerHTML = text;
    }
    async function xgettoday() {

        const response1 = await fetch('https://dataservice.accuweather.com/locations/v1/cities/search?apikey=tbKWC8cfGRdUhHBzjB1pxYRADJZhhqv8&q=<?= $zipcode ?>');
        const data1 = await response1.json();
        locationKey1 = data1[0].Key;
        const response2 = await fetch('http://dataservice.accuweather.com/forecasts/v1/hourly/12hour/' + locationKey1 + '?apikey=tbKWC8cfGRdUhHBzjB1pxYRADJZhhqv8&details=true&metric=true');
        const data21 = await response2.json();
        var text1 = "";
        for (var i = 0; i < 12; i++) {
            date = data21[i].DateTime;
            temp = data21[i].Temperature.Value;
            hum = data21[i].RelativeHumidity;
            rain = data21[i].Rain.Value;
            spd = data21[i].Wind.Speed.Value;
            dir = data21[i].Wind.Direction.Localized;
            hour = data21[i].HoursOfSun;
            text1 += "<div class='weather'>";
            text1 += "<div class='wdate'><strong>Date </strong>: " + date + " </div><br>";
            text1 += "<div class='wtemp'><strong>Tempereature </strong>: " + temp + " °C</div><br>";
            text1 += "<div class='whum'><strong>Humidity </strong>: " + hum + "</div><br>";
            text1 += "<div class='wrain'><strong>Rain </strong>: " + rain + "mm </div><br>";
            text1 += "<div class='wwind'><table style='color: whitesmoke' cellspacing=30> <tr><th colspan=2>Wind </th></tr><tr><td> Day </td><td>" + spd + "km/h</td></tr><tr><td> Direction </td><td>" + dir + "</td></tr></table></div><br>";
            text1 += "</div><br>";
        }
        document.getElementById("weathertoday").innerHTML = text1;
    }
</script>
<br>
<div class="con">

    <div class="btns">

        <input class="w3-bar-item w3-button" type="button" value="Current Weather" onclick="xcurrent()">
        <input class="w3-bar-item w3-button" type="button" value="Details of today" onclick="xgettoday()">

        <input class="w3-bar-item w3-button" type="button" value="Get Information about next 5 days" onclick="xget()">
    </div>
    <div id="wtdy" class="current">

    </div>
    <br>
    <div id="weathertoday" class="allday">
    </div>
    <br>
    <div id="container" class="days">

    </div>
</div>
<?php
include("footer.php")
?>