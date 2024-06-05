<?php

function removeForm($formName) {
    $xmlFilesFolder = 'forms/';
    $xmlFilePath = $xmlFilesFolder . $formName;
    $inactivePath = $xmlFilesFolder . "inactive/" . $formName;

    // Zkontrolujte, zda soubor existuje a smažte ho
    if (file_exists($xmlFilePath)) {
        rename($xmlFilePath, $inactivePath);
        //unlink($xmlFilePath);
        return true;
    } else {
        return false;
    }
}