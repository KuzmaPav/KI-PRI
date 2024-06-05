<?php

function check_wellformed($xmlFilePath)
{
    libxml_use_internal_errors(true);
    $xml = new DOMDocument();
    $isValid = $xml->load($xmlFilePath);
    libxml_clear_errors();
    libxml_use_internal_errors(false);
    return $isValid;
}

function check_on_xsd($xmlFilePath, $xsdFilePath)
{
    libxml_use_internal_errors(true);
    $xml = new DOMDocument();
    $xml->load($xmlFilePath);
    $isValid = $xml->schemaValidate($xsdFilePath);
    libxml_clear_errors();
    libxml_use_internal_errors(false);
    return $isValid;
}

function xml_validate($xmlFilePath, $xsdFilePath)
{
    if (!check_wellformed($xmlFilePath)) {
        echo "XML soubor není dobře formátovaný.";
        return false;
    }

    if (!check_on_xsd($xmlFilePath, $xsdFilePath)) {
        echo "XML neodpovídá schématu.";
        return false;
    }

    return true;
}