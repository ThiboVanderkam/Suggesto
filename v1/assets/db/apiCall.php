<?php
    include "apiClass.php";

    $api = new Api();
    $output = $api->selectCall($_GET);
    // var_dump($output);
    if($_GET["call"] == "preferencesId") {
        // print_r($output);
        $stringDing = "[";
        foreach($output as $item) {
            // echo json_encode($item) . ",";
            // var_dump($item);
            if (count($item) > 0) {
                $ding = json_encode($item) . ",";
                $stringDing .= $ding; // °o° => ook nog [ en ] op begin en einde zetten en de laatste comma wegdoen
            }
        }
        $stringDing = strval($stringDing);
        $stringDing = str_replace(",,", ",", $stringDing);
        $stringDing = json_encode($stringDing);

        // $stringDing = $stringDing . str_replace($stringDing, ",,", ","); // werkt niet, zet de fout bij {"name":"Smoby Nature House + zomerkeuken - 145 x 110 x 127 cm - Speelhuis","link":"https:\/\/www.bol.com\/be\/nl\/p\/smoby-nature-house-zomerkeuken-145-x-110-x-127-cm-speelhuis\/9300000023436902\/","prijs":"151.55","fotoLink":"https:\/\/media.s-bol.com\/D8jgDA4KORKA\/168x146.jpg","preference":"nature"},,
        $stringDing[strlen($stringDing) - 1] = ']';
        $stringDing .= '"';
        
        echo ($stringDing);
        // echo json_encode($stringDing);
    }
    else {
        echo json_encode($output);
    }
?>