<?php

$lastIndexPath = "last_index.txt";
$xmlFilesFolder = "forms/";

function saveForm($xml, $xmlFormsFolder, $lastIndexPath)
{
    $fh = fopen($xmlFormsFolder . $lastIndexPath, "r");
    $lastIndex = fgets($fh);
    fclose($fh);

    $lastIndex += 1;
    if($xml->save($xmlFormsFolder . "form" . $lastIndex . ".xml"))
        echo "Xml formulář byl úspěšně nahrán.";

    $fh = fopen($xmlFormsFolder . $lastIndexPath, "w");
    fwrite($fh, $lastIndex);
    fclose($fh);

}