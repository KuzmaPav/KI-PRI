<?php

// Funkce pro přidání podřízeného prvku a nastavení textového obsahu
function addChildWithText($parent, $name, $text) {
    $child = $parent->addChild($name);
    $child[0] = $text;
    return $child;
}

// Vytvoření kořenového prvku 'fakulta'
$fakulta = new SimpleXMLElement('<fakulta děkan="Michal Varady"></fakulta>');

// Přidání katedry
$katedra = $fakulta->addChild('katedra');
$katedra->addAttribute('zkratka_katedry', 'KI');

// Přidání vedoucího katedry
$vedouci = $katedra->addChild('vedoucí');
addChildWithText($vedouci, 'jméno', 'Jiří Škvor');
addChildWithText($vedouci, 'telefon', '420 475 286 711');
addChildWithText($vedouci, 'email', 'Jiri.Skvor@ujep.cz');

// Přidání zaměstnanců
$zamestnanci = $katedra->addChild('zaměstnanci');

// Přidání zaměstnance
$zamestnanec = $zamestnanci->addChild('zaměstnanec');
addChildWithText($zamestnanec, 'jméno', 'Pavel Beránek');
addChildWithText($zamestnanec, 'telefon', '420 475 286 723');
addChildWithText($zamestnanec, 'email', 'Pavel.Beranek@ujep.cz');
$pozice = $zamestnanec->addChild('pozice');
$pozice->addChild('odborný_asistent');

// Přidání předmětů
$predmety = $katedra->addChild('předměty');

// Přidání předmětu
$predmet = $predmety->addChild('předmět');
$predmet->addAttribute('zkratka', 'APR1');
$predmet->addAttribute('typ', 'kombinované');
addChildWithText($predmet, 'název', 'Programování 1');
addChildWithText($predmet, 'popis', 'Jak se má programovat pt.1');

// Uložení XML do souboru
$xmlFilePath = 'generovana_fakulta.xml';
$fakulta->asXML($xmlFilePath);

echo "XML soubor '$xmlFilePath' byl úspěšně vygenerován.\n";

