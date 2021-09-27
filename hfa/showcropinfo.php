<link rel="stylesheet" type="text/css" href="/assets/afa7e97e/jui/css/base/jquery-ui.css" />
<script type="text/javascript" src="/assets/afa7e97e/jquery.js"></script>
<script type="text/javascript" src="/assets/afa7e97e/jquery.yii.js"></script>
<style>
    .zoo-img {
        width: 100px;
        height: auto;
    }
</style>
<div class="list"><br>
    <form method="POST">
        Select Category : <select class="w3-input" name="cat" id="cat" onchange="plants()">
            <option selected>None</option>
            <?php
            $cat = ['citrus', 'flowers', 'forestry', 'fruits', 'medicinal', 'plantation', 'spice_and_condiments', 'vegetables'];
            foreach ($cat as $cat) {
                echo "<option value='" . $cat . "'>" . $cat . "</option>";
            }
            ?>
        </select><br>
        <script>
            function plants() {
                var cat = document.getElementById("cat").value;
                var citrus = ['lemon', 'lime-nimboo'];
                var flowers = ['carnation', 'chrysanthemum', 'gerbera', 'gladiolus', 'jasmine', 'marigold', 'rose', 'tuberose-rajnigandha'];
                var forestry = ['drek', 'eucalyptus', 'poplar', 'sagwan'];
                var fruits = ['banana', 'ber', 'date-palm', 'grapes', 'guava', 'jamun', 'kinnow', 'litchi', 'loquat', 'mango', 'mulberry', 'muskmelon', 'orange-mandarins-santra', 'papaya', 'peach', 'pear-nashpati', 'plum', 'pomegranate', 'sapota', 'sweet-oranges-malta', 'watermelon'];
                var medicinal = ['aloe-vera', 'amla', 'ashwagandha', 'bahera', 'bhumi-amalaki', 'brahmi', 'dill-seeds', 'honey', 'indian-bael', 'kalihari', 'lemon-grass', 'mulethi', 'neem', 'pudina', 'sadabahar', 'safed-musli', 'sarpagandha', 'shankhpushpi', 'shatavari', 'stevia', 'sweet-flag', 'tulsi'];
                var plantation = ['fig'];
                var spice_and_condiments = ['coriander', 'fennel', 'fenugreek', 'ginger-adrakh', 'trumeric-haldi']
                var vegetables = ['ash-gourd', 'beetroot', 'bitter-gourd', 'bottle-gourd', 'brinjal', 'broccoli', 'cabbge', 'capsicum', 'carrot', 'cauliflower', 'celery', 'chilli', 'cucumber', 'garlic', 'kharif-onion-pyaz', 'lettuce', 'long-melon', 'mushroom', 'okra', 'peas', 'potato', 'pumpkin', 'rabi-onion-pyaz', 'radish', 'spinach', 'sponge-gourd', 'squash-melon', 'summer-squash', 'sweet-potato', 'tomato', 'turnip'];
                var text = "Select Plant : <select class='w3-input' name='plantname'>";
                if (cat == "citrus") {
                    for (var i = 0; i < citrus.length; i++) {
                        text += "<option value='" + citrus[i] + "'>" + citrus[i] + "</option>";
                    }
                } else {
                    if (cat == "flowers") {
                        for (var i = 0; i < flowers.length; i++) {
                            text += "<option value='" + flowers[i] + "'>" + flowers[i] + "</option>";
                        }
                    } else {
                        if (cat == "forestry") {
                            for (var i = 0; i < forestry.length; i++) {
                                text += "<option value='" + forestry[i] + "'>" + forestry[i] + "</option>";
                            }
                        } else {
                            if (cat == "fruits") {
                                for (var i = 0; i < fruits.length; i++) {
                                    text += "<option value='" + fruits[i] + "'>" + fruits[i] + "</option>";
                                }
                            } else {
                                if (cat == "medicinal") {
                                    for (var i = 0; i < medicinal.length; i++) {
                                        text += "<option value='" + medicinal[i] + "'>" + medicinal[i] + "</option>";
                                    }
                                } else {
                                    if (cat == "plantation") {
                                        for (var i = 0; i < plantation.length; i++) {
                                            text += "<option value='" + plantation[i] + "'>" + plantation[i] + "</option>";
                                        }
                                    } else {
                                        if (cat == "spice_and_condiments") {
                                            for (var i = 0; i < spice_and_condiments.length; i++) {
                                                text += "<option value='" + spice_and_condiments[i] + "'>" + flowspice_and_condimentsers[i] + "</option>";
                                            }
                                        } else {
                                            if (cat == "vegetables") {
                                                for (var i = 0; i < vegetables.length; i++) {
                                                    text += "<option value='" + vegetables[i] + "'>" + vegetables[i] + "</option>";
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }



                text += "</select>";
                document.getElementById("names").innerHTML = text;
            }
        </script>
        <br>
        <div id="names">

        </div><br>
        <input class="w3-button w3-white w3-border w3-border-brown" type="submit" name=submit value="submit"><br>
    </form>

</div>
<hr><br>
<?php
if (isset($_POST["plantname"])) {
    $plant =  $_POST["plantname"];
    include("sources/$plant.html");
}
?>
<script async src="https://static.addtoany.com/menu/page.js" defer></script>
<!-- AddToAny END -->

<!-- CSS -->
<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="https://www.apnikheti.com/css/jquery.mCustomScrollbar.min.css">
<link rel="stylesheet" type="text/css" href="https://www.apnikheti.com/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="https://www.apnikheti.com/css/apni-kheti-style.css">

<!-- JS -->
<!-- For Image Lazy Load (Low Server Request Time) -->
<script src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/4.1.5/lazysizes.min.js" defer></script>
<script src="https://www.apnikheti.com/js/jquery-ui.min.js"></script>
<script src="https://www.apnikheti.com/js/jquery.validate.min.js"></script>
<script src="https://www.apnikheti.com/js/modernizr.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://www.apnikheti.com/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="https://www.apnikheti.com/js/tinynav.min.js"></script>
<script src="https://www.apnikheti.com/js/select2.min.js"></script>
<!-- Collapseable Menu -->
<script src="https://www.apnikheti.com/js/metisMenu.min.js"></script>
<!-- Read More Jquery UI-->
<script src='https://www.apnikheti.com/plugins/jquery-ui-showmore/js/jquery-ui-showmore.min.js'></script>
<!-- Image Hover Zoom Plugin-->
<script src="https://www.apnikheti.com/js/zoomove.min.js"></script>
<!--Custom Script-->
<script src="https://www.apnikheti.com/js/custom-script.js"></script>
<!-- fancybox -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/3.1.25/jquery.fancybox.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/3.1.25/jquery.fancybox.min.js"></script>