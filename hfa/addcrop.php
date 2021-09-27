<?php
include("header.php");
include("menu_admin.php");
if (isset($_POST['submit'])) {
    $plants = simplexml_load_file('data.xml');
    $node = $_POST["name"];

    $tableel = $_POST["notables"];
    $rows = $_POST["rows"];
    $cols = $_POST["cols"];


    $plant = $plants->addChild('cat');
    $plant->addAttribute('name', $_POST["category"]);
    $plant->addChild('name', $_POST['name']);
    $plant->addChild('hsowing_time', $_POST['hsowing_time']);

    // if (isset($_FILES['image'])) {

    //     $errors = array();
    //     $file_name = $_FILES['image']['name'];
    //     $file_size = $_FILES['image']['size'];
    //     $file_tmp = $_FILES['image']['tmp_name'];
    //     $file_type = $_FILES['image']['type'];
    //    // $file_ext = strtolower(end(explode('.',$_FILES['image']['name'])));
    //     $text0 = explode('.', $_FILES['image']['name']);
    //     $text = end($text0);
    //     $file_ext = strtolower($text);
    //     $extensions = array("jpeg", "jpg", "png");

    //     if (in_array($file_ext, $extensions) === false) {
    //         $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
    //     }

    //     // if ($file_size > 2097152) {
    //     //     $errors[] = 'File size must be excately 2 MB';
    //     //}

    //     if (empty($errors) == true) {
    //         move_uploaded_file($file_tmp, "./upload/crops/" . $file_name);

    //     } else {
    //         if($file_name !="")
    //             print_r($errors);
    //     }
    // }

    // $plant->addChild('crop_img', $file_name);
    $plant->addChild('crop_img', $_POST['img_main']);
    $plant->addChild('general_info', $_POST['general_info']);

    $climate = $plant->addChild('climate');
    $climate->addChild('temperature', $_POST['temperature']);
    $climate->addChild('rainfall', $_POST['rainfall']);
    $climate->addChild('sowing_temperature', $_POST['sowing_temperature']);
    $climate->addChild('harvesting_temperature', $_POST['harvesting_temperature']);

    $plant->addChild('soil', $_POST['soil']);

    $popular_variety = $plant->addChild('Popular_variety');
    $noofvarieties = $_POST["vno"];
    for ($x = 0; $x < $noofvarieties; $x++) {
        $v = $popular_variety->addChild('varieties');
        $v->addChild('variety_name', $_POST['variety_name' . $x]);
        $v->addChild('variety_description', $_POST['variety_description' . $x]);
    }

    $plant->addChild('land_prep', $_POST['land_prep']);

    $sowing = $plant->addChild('sowing');
    $sowing->addChild('sowing_time', $_POST['sowing_time']);
    $sowing->addChild('sowing_space', $_POST['sowing_space']);
    $sowing->addChild('sowing_depth', $_POST['sowing_depth']);
    $sowing->addChild('sowing_method', $_POST['sowing_method']);

    $seed = $plant->addChild('seed');
    $seed->addChild('seed_rate', $_POST['seed_rate']);
    $seed->addChild('seed_treatment', $_POST['seed_treatment']);

    $fertilizer = $plant->addChild('fertilizer');
    for ($i = 0; $i < $tableel; $i++) {
        $tabletag = $fertilizer->addChild('table');
        $tabletag->addChild('table_heading', $_POST["th" . $i]);
        for ($j = 0; $j < $cols; $j++) {
            $coltag = $tabletag->addChild('tr');
            for ($k = 0; $k < $rows; $k++) {
                $coltag->addChild('td', $_POST['c' . $j . 'r' . $k . '']);
            }
        }
    }
    $fertilizer->addChild('fertilizer_desc', $_POST['fertilizer_desc']);

    $plant->addChild('weed_control', $_POST['weed_control']);

    $plant->addChild('irrigation', $_POST['irrigation']);

    $pp1 = $plant->addChild('plant_protection');
    $ppno = $_POST["ppno"];
    for ($x = 0; $x < $ppno; $x++) {
        $pp = $pp1->addChild('pp');
        $pp->addChild('pp_category', $_POST['pp_category' . $x]);
        // if (isset($_FILES['pp_img'.$x])) {
        //     $errors1 = array();
        //     $file_name1 = $_FILES['pp_img' . $x]['name'];
        //    // $file_size1 = $_FILES['pp_img' . $x]['size'];
        //     $file_tmp1 = $_FILES['pp_img' . $x]['tmp_name'];
        //     $file_type1 = $_FILES['pp_img' . $x]['type'];
        //     // $file_ext = strtolower(end(explode('.',$_FILES['image']['name'])));
        //     $text01 = explode('.', $_FILES['pp_img'.$x]['name']);
        //     $text1 = end($text01);
        //     $file_ext1 = strtolower($text1);
        //     $extensions1 = array("jpeg", "jpg", "png");

        //     if (in_array($file_ext1, $extensions1) === false) {
        //         $errors1[] = "extension not allowed, please choose a JPEG or PNG file.";
        //     }

        //     // if ($file_size > 2097152) {
        //     //     $errors[] = 'File size must be excately 2 MB';
        // // }

        // if (empty($errors1) == true) {
        //     move_uploaded_file($file_tmp1, "./upload/crops/crops_thumb/" . $file_name1);

        // } else {
        //     if ($file_name1 != "")
        //     print_r($errors);
        // }
        // }
        // $pp->addChild('pp_image', $file_name1);
        $pp->addChild('pp_name', $_POST['pp_name' . $x]);
        $pp->addChild('pp_image', $_POST['pp_img' . $x]);
        $pp->addChild('pp_description', $_POST['pp_desc' . $x]);
    }

    $plant->addChild('harvesting', $_POST['harvesting']);
    $plant->addChild('post_harvesting', $_POST['post_harvesting']);
    file_put_contents('data.xml', $plants->asXML());
}
?>
<script>
    function chng(n1, n2) {

        var checkBox = document.getElementById(n1);

        var text = document.getElementById(n2);


        if (checkBox.checked == true) {
            text.style.display = "block";
        } else {
            text.style.display = "none";
        }
    }
</script>
<br>
<hr>
<div class="container">
    <form method="post" enctype="multipart/form-data">
        <div>Select Category</div>
        <div><select name="category" id="category">
                <option value="citrus">citrus</option>
                <option value="flowers">Flowers</option>
                <option value="forestry">Forestry</option>
                <option value="fruits">Fruits</option>
                <option value="medicinal">Medicinal</option>
                <option value="plantation">Plantation</option>
                <option value="spice_and_condiments">Spice and Condiments</option>
                <option value="vegetable">Vegetable</option>
            </select></div>
        <div><input type="checkbox" id="myCheck1" onclick="chng('myCheck1','input_name')" checked>Name</div>
        <div id="input_name"><input type="text" name="name" id="name"></div>
        <div><input type="checkbox" id="myCheck2" onclick="chng('myCheck2','input_image')" checked>Image</div>
        <div id="input_image">
            <!-- <input type="file" name="image" /> -->
            <input type="text" name="img_main" id="img_main">
        </div>
        <div><input type="checkbox" id="myCheck3" onclick="chng('myCheck3','input_hsowingtime')" checked>Sowing Time</div>
        <div id="input_hsowingtime"><input type="text" name="hsowing_time" id="hsowing_time"></div>
        <div><input type="checkbox" id="myCheck4" onclick="chng('myCheck4','input_gi')" checked>General Information</div>
        <div id="input_gi"><input type="text" name="general_info" id="general_info"></div>

        <div><input type="checkbox" id="myCheck4" onclick="chng('myCheck4','input_climate')" checked>Climate
            <div id="input_climate">
                <div><input type="checkbox" id="myCheck5" onclick="chng('myCheck5','input_temperature')" checked>Temperature</div>
                <div id="input_temperature"><input type="text" name="temperature" id="temperature"></div>
                <div><input type="checkbox" id="myCheck6" onclick="chng('myCheck6','input_rainfall')" checked>Rainfall</div>
                <div id="input_rainfall"><input type="text" name="rainfall" id="rainfall"></div>
                <div><input type="checkbox" id="myCheck7" onclick="chng('myCheck7','input_stemp')" checked>Sowing Temperature</div>
                <div id="input_stemp"><input type="text" name="sowing_temperature" id="sowing_temperature"></div>
                <div><input type="checkbox" id="myCheck8" onclick="chng('myCheck8','input_htemp')" checked>Harvesting temperature</div>
                <div id="input_htemp"><input type="text" name="harvesting_temperature" id="harvesting_temperature"></div>
            </div>
        </div>
        <div><input type="checkbox" id="myCheck9" onclick="chng('myCheck9','input_soil')" checked>Soil</div>
        <div id="input_soil"><input type="text" name="soil" id="soil"></div>
        <div><input type="checkbox" id="myCheck10" onclick="chng('myCheck10','input_var')" checked>Popular Varieties
            <div id="input_var">
                Number of Varieties<input type="number" name="vno" id="vno" onchange="addin()">
                <span id="varieties"></span>
                <script>
                    function addin() {
                        var no = document.getElementById("vno").value;
                        var id = document.getElementById("varieties")
                        var text = "";
                        for (var i = 0; i < no; i++) {
                            text += '<br> Name of Variety <input type = "text" name = "variety_name' + i + '" id = "variety_name" >';
                            text += 'Description <input type = "text" name = "variety_description' + i + '"   id = "variety_description" ><br>';
                        }
                        id.innerHTML = text;
                    }
                </script>


            </div>
        </div>
        <div><input type="checkbox" id="myCheck13" onclick="chng('myCheck13','input_lpre')" checked>Land Preparation</div>
        <div id="input_lpre"><input type="text" name="land_prep" id="land_prep"></div>
        <div><input type="checkbox" id="myCheck14" onclick="chng('myCheck14','input_sowing')" checked>Sowing
            <div id="input_sowing">
                <div><input type="checkbox" id="myCheck15" onclick="chng('myCheck15','input_tos')" checked>Time of sowing</div>
                <div id="input_tos"><input type="text" name="sowing_time" id="sowing_time"></div>
                <div><input type="checkbox" id="myCheck16" onclick="chng('myCheck16','input_spacing')" checked>Spacing</div>
                <div id="input_spacing"><input type="text" name="sowing_space" id="sowing_space"></div>
                <div><input type="checkbox" id="myCheck17" onclick="chng('myCheck17','input_sd')" checked>Sowing Depth</div>
                <div id="input_sd"><input type="text" name="sowing_depth" id="sowing_depth"></div>
                <div><input type="checkbox" id="myCheck18" onclick="chng('myCheck18','input_mos')" checked>Method of Sowing</div>
                <div id="input_mos"><input type="text" name="sowing_method" id="sowing_method"></div>
            </div>
        </div>
        <div><input type="checkbox" id="myCheck19" onclick="chng('myCheck19','input_seed')" checked>Seed
            <div id="input_seed">
                <div><input type="checkbox" id="myCheck20" onclick="chng('myCheck20','input_sr')" checked>Seed Rate</div>
                <div id="input_sr"><input type="text" name="seed_rate" id="seed_rate"></div>
                <div><input type="checkbox" id="myCheck21" onclick="chng('myCheck21','input_sst')" checked>Seed Treatment</div>
                <div id="input_sst"><input type="text" name="seed_treatment" id="seed_treatment"></div>
            </div>
        </div>
        <div><input type="checkbox" id="myCheck22" onclick="chng('myCheck22','input_fertilizer')" checked>Fertilizer
            <div id="input_fertilizer"><input type="checkbox" id="myCheck32" onclick="chng('myCheck32','fertilizer_table')" checked>table
                <div id="fertilizer_table">
                    how many tables do you want? <input type="number" id="notables" name="notables"><br>
                    rows: <input type="number" id="rows" name="rows"> cols: <input type="number" id="cols" name="cols" onchange="table()">
                    <div id="t1"></div>
                    <script>
                        function table() {
                            var t = document.getElementById("t1");
                            var tables = document.getElementById("notables").value;
                            var rows = document.getElementById("rows").value;
                            var cols = document.getElementById("cols").value;
                            var text = "";
                            for (var i = 0; i < tables; i++) {
                                text += "<br>";
                                text += "table Heading <input type='text' name='th" + i + "'>"
                                for (var j = 0; j < cols; j++) {
                                    text += "<br>";
                                    for (var k = 0; k < rows; k++) {

                                        text += "<input type='text' name='c" + j + "r" + k + "'>";
                                    }
                                }
                            }
                            t.innerHTML = text;

                        }
                    </script>
                </div>


            </div>

            <div><input type="checkbox" id="myCheck33" onclick="chng('myCheck33','input_fdesc')" checked>Description</div>
            <div id="input_fdesc"><input type="text" name="fertilizer_desc" id="fertilizer_desc"></div>
        </div>

        <div><input type="checkbox" id="myCheck23" onclick="chng('myCheck23','input_wc')" checked>Weed control</div>
        <div id="input_wc"><input type="text" name="weed_control" id="weed_control"></div>
        <div><input type="checkbox" id="myCheck24" onclick="chng('myCheck24','input_irr')" checked>Irrigation</div>
        <div id="input_irr"><input type="text" name="irrigation" id="irrigation"></div>
        <div><input type="checkbox" id="myCheck25" onclick="chng('myCheck25','input_pp')" checked>Plant Protection
            <div id="input_pp">
                Number <input type="number" name="ppno" id="ppno" onchange="addinpp()">
                <span id="pp"></span>
                <script>
                    function addinpp() {
                        var no1 = document.getElementById("ppno").value;
                        var id1 = document.getElementById("pp")
                        var text1 = "";
                        for (var i = 0; i < no1; i++) {
                            text1 += ' <br>Category <input type = "text" name = "pp_category' + i + '" id = "pp_category" > ';
                            text1 += 'Name <input type = "text" name = "pp_name' + i + '" id = "pp_name" > ';
                            // text1 += 'Image   <input type="file" name="pp_img'+i+'" />';
                            text1 += 'Image Name <input type = "text" name = "pp_img' + i + '" id = "pp_img" > ';
                            text1 += 'Description <input type = "text" name = "pp_desc' + i + '" id = "pp_desc" >';


                        }
                        id1.innerHTML = text1;
                    }
                </script>

            </div>

            <div><input type="checkbox" id="myCheck30" onclick="chng('myCheck30','input_h')" checked>Harvesting</div>
            <div id="input_h"><input type="text" name="harvesting" id="harvesting"></div>
            <div><input type="checkbox" id="myCheck31" onclick="chng('myCheck31','input_pho')" checked>Post-Harvesting</div>
            <div id="input_pho"><input type="text" name="post_harvesting" id="post_harvesting"></div>

            <div><input type="submit" name="submit" value="Add"></div>
    </form>
</div><br>
<hr>

<?php
include("footer.php");
?>