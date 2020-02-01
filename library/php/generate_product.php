<?php
$query = 'SELECT * FROM kamer';  
$execute = $database_connection->query($query);
$titel = array('','','','Soort Kamer:','WC:','Douche:','Wastafel','Prijs:');

echo '<div id="producten">';
    foreach($execute as $row){
        echo '<button><table>';
        for($i = 1; $i < (count($row) / 2); $i++){

            echo '<tr id="row_' . $i . '">';
            if($i > 2){
                echo '<td id="category">' . $titel[$i] . '</td>';
                echo '<td id="value">' . $row[$i] . '</td>';
            } else{
                echo '<td colspan="2" id="product_omschrijving_' . $i . '">' . $row[$i] . '</td>';
            }
            echo '</tr>';
        } 
        echo '</table></button>';
    }
echo '</div>';