<?php
if (isset($_POST["plant name"])) {
    $plants = simplexml_load_file('data.xml');
    //$name=$_GET["plantname"];
    foreach ($plants->cat as $cat) {
        if ($cat["name"] == $plantname) {


?>
            <div class="crop-container">
                <div class="crop-container">
                    <div>
                        <header class="crop-header">
                            <div class="crop-img"> <img alt="Lemon Crop Farming" src=".\upload\crops\<?= $cat->crop_img ?>" title="" /> </div>
                            <div class="crop-main-points skew">
                                <div class="inner-crop-header anti-skew">
                                    <h1> <?php echo $cat->name; ?></h1>

                                </div>
                            </div>
                        </header>

                        <section class="crop-info-container">
                            <article class="crop-info-repeater">
                                <h2 id="GeneralInformation"> General Information </h2>
                                <div class="more">
                                    <p>
                                        <?php echo $cat->general_info; ?>
                                    </p>
                                </div>
                            </article>
                            <article class="crop-info-repeater climate-info">
                                <h2 id="Climate"> Climate<?php $climate = $cat->climate; ?> </h2>
                                <div class="climate-body">
                                    <ul>
                                        <li> <span class="pic-temp">
                                                <!-- <img alt="Season" src="/images/svg/temprature.svg" /> -->
                                                <h4>Temperature</h4>
                                            </span>
                                            <div class="winter-Temp"><span class="dig-temp"><?php echo $climate->temperature; ?></span><span class="temp-season"></span></div>

                                        </li>
                                        <li> <span class="pic-temp">
                                                <h4>Rainfall</h4>
                                            </span>
                                            <div class="winter-Temp"><span class="dig-temp"><?php echo $climate->rainfall; ?></span><span class="temp-season"></span></div>

                                        </li>
                                        <li> <span class="pic-temp">
                                                <!-- <img alt="Season" src="/images/svg/planting.svg" /> -->
                                                <h4>Sowing Temperature</h4>
                                            </span>
                                            <div class="winter-Temp"><span class="dig-temp"><?php echo $climate->sowing_temperature; ?></span></div>
                                        </li>
                                        <!-- <li> <span class="pic-temp"> 
                                    <img alt="Season" src="/images/svg/planting.svg" /> 
                                            <h4>Sowing Time</h4>
                                        </span>
                                        <div class="winter-Temp"><span class="dig-temp"><?php echo $climate->hsowing_time; ?></span></div>
                                    </li> -->
                                        <li> <span class="pic-temp">
                                                <!-- <img alt="Season" src="/images/svg/plantation.svg" /> -->
                                                <h4>Harvesting Temperature</h4>
                                            </span>
                                            <div class="winter-Temp"><span class="dig-temp"><?php echo $climate->harvesting_temperature; ?> </span><span class="temp-season"></span></div>

                                        </li>
                                    </ul>
                                </div>
                            </article>


                            <article class="crop-info-repeater">
                                <h2 id="Soil"> Soil </h2>
                                <div class="more">
                                    <p><?php echo $cat->soil; ?></p>
                                </div>
                            </article>
                            <article class="crop-info-repeater">
                                <h2 id="PopularVarietiesWithTheirYield"> Popular Varieties With Their Yield </h2>
                                <div class="more">
                                    <?php foreach ($cat->Popular_variety->varieties as $var) {
                                        echo "<p><strong> $var->variety_name</strong><br>&nbsp </strong>$var->variety_description</p>";
                                    } ?>


                                </div>
                            </article>
                            <article class="crop-info-repeater">
                                <h2 id="LandPreparation"> Land Preparation </h2>
                                <div class="more">
                                    <p><?php echo $cat->land_prep; ?></p>
                                </div>
                            </article>
                            <article class="crop-info-repeater">
                                <h2 id="Sowing"> Sowing <?php $sowing =  $cat->sowing; ?></h2>
                                <div class="more">
                                    <p><strong>Time of sowing</strong><br />

                                        <?php echo $sowing->sowing_time; ?> </p>

                                    <p><strong>Spacing</strong><br />

                                        <?php echo $sowing->sowing_space; ?></p>
                                    <p><strong>Sowing Depth</strong><br />

                                        <?php echo $sowing->sowing_depth; ?></p>
                                    <p><strong>Method of sowing</strong><br />
                                        <?php echo $sowing->sowing_method; ?>


                                    </p>
                                </div>
                            </article>
                            <article class="crop-info-repeater">
                                <h2 id="Seed"> Seed <?php $seed =  $cat->seed; ?></h2>
                                <div class="more">
                                    <p><strong>Seed Rate</strong><br />

                                        <?php echo $seed->seed_rate; ?></p>
                                </div>
                            </article>
                            <article class="crop-info-repeater">
                                <div class="more">
                                    <?php echo $seed->seed_treatment; ?></p>
                                </div>
                            </article>
                            <article class="crop-info-repeater">
                                <h2 id="Fertilizer"> Fertilizer
                                    <?php

                                    $fert =  $cat->fertilizer;



                                    ?></h2>
                                <div class="more">

                                    <?php
                                    foreach ($fert->table as $table) {
                                        echo   '<p style="display:flex; justify-content:center;"><strong> ' . $table->table_heading . ' </strong></p>';
                                        echo '<table border="1" cellpadding="5px"  width="100%" cellspacing="5px">';
                                        foreach ($table->tr as $tr) {
                                            echo '<tr>';
                                            foreach ($tr->td as $td) {
                                                echo '<td>' . $td . '</td>';
                                            }
                                            echo '</tr>';
                                        }
                                        echo '</table>';
                                    }
                                    ?>




                                    <p class="MsoNormal" style="text-align: left;">
                                        <?php echo $seed->fertilizer_desc; ?>
                                    </p>
                                </div>
                            </article>
                            <article class="crop-info-repeater">
                                <h2 id="WeedControl"> Weed Control </h2>
                                <div class="more">
                                    <p>
                                        <?php echo $cat->weed_control; ?>
                                    </p>
                                </div>
                            </article>
                            <article class="crop-info-repeater">
                                <h2 id="Irrigation"> Irrigation </h2>
                                <div class="more">
                                    <p><?php echo $cat->irrigation; ?></p>
                                </div>
                            </article>
                            <article class="crop-info-repeater">
                                <h2 id="Plantprotection"> Plant protection <?php $pp =  $cat->plant_protection->pp; ?></h2>

                                <?php
                                foreach ($pp as $p1)
                                    echo '<div class="more">';
                                //echo '<img alt="Citrus Psylla" src="pp_image" title="" /></div>pp_image';
                                echo '<p><strong>' . $pp->pp_category . '</strong></p>';
                                echo '<p><strong>' . $pp->pp_name . '</strong>:' . $pp->pp_description . '</p>';
                                echo '</div>';
                                ?>
                            </article>
                            <article class="crop-info-repeater">
                                <h2 id="Harvesting"> Harvesting </h2>
                                <div class="more">
                                    <p><?php echo $cat->harvesting; ?></p>
                                </div>
                            </article>
                            <article class="crop-info-repeater">
                                <h2 id="Post-Harvest"> Post-Harvest </h2>
                                <div class="more">
                                    <p><?php echo $cat->post_harvesting; ?></p>
                                </div>
                            </article>

                        </section>
                    </div>
                </div>
            </div>

<?php
        }
    }
} ?>
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