<?php

$servername = "database";
$username = "admin";
$password = "heslo";
$dbname = "univerzita";

// Připojení k databázi pomocí mysqli
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Funkce pro přidání podřízeného prvku a nastavení textového obsahu
function addChildWithText($parent, $name, $text) {
    $child = $parent->addChild($name);
    $child[0] = $text;
    return $child;
}

// Získání dat z tabulky fakulta
$sql = "SELECT * FROM fakulta WHERE id = 1";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $fakultaData = mysqli_fetch_assoc($result);

    // Vytvoření kořenového prvku 'fakulta'
    $fakulta = new SimpleXMLElement("<fakulta děkan='{$fakultaData['dekan']}'></fakulta>");

    // Získání dat z tabulky katedra
    $sql = "SELECT * FROM katedra WHERE fakulta_id = {$fakultaData['id']}";
    $katedraResult = mysqli_query($conn, $sql);

    while ($katedraData = mysqli_fetch_assoc($katedraResult)) {
        // Přidání katedry
        $katedra = $fakulta->addChild('katedra');
        $katedra->addAttribute('zkratka_katedry', $katedraData['zkratka_katedry']);
        $katedra->addAttribute('webové_stránky', $katedraData['webove_stranky']);

        // Získání dat z tabulky vedouci
        $sql = "SELECT * FROM vedouci WHERE katedra_id = {$katedraData['id']}";
        $vedouciResult = mysqli_query($conn, $sql);

        if ($vedouciData = mysqli_fetch_assoc($vedouciResult)) {
            // Přidání vedoucího katedry
            $vedouci = $katedra->addChild('vedoucí');
            addChildWithText($vedouci, 'jméno', $vedouciData['jmeno']);
            addChildWithText($vedouci, 'telefon', $vedouciData['telefon']);
            addChildWithText($vedouci, 'email', $vedouciData['email']);
        }

        // Získání dat z tabulky zamestnanec
        $sql = "SELECT * FROM zamestnanec WHERE katedra_id = {$katedraData['id']}";
        $zamestnanecResult = mysqli_query($conn, $sql);

        // Přidání zaměstnanců
        $zamestnanci = $katedra->addChild('zaměstnanci');

        while ($zamestnanecData = mysqli_fetch_assoc($zamestnanecResult)) {
            $zamestnanec = $zamestnanci->addChild('zaměstnanec');
            addChildWithText($zamestnanec, 'jméno', $zamestnanecData['jmeno']);
            addChildWithText($zamestnanec, 'telefon', $zamestnanecData['telefon']);
            addChildWithText($zamestnanec, 'email', $zamestnanecData['email']);

            // Přidání pozice zaměstnance
            $pozice = $zamestnanec->addChild('pozice');
            $pozice->addChild($zamestnanecData['pozice']);
        }

        // Získání dat z tabulky predmet
        $sql = "SELECT * FROM predmet WHERE katedra_id = {$katedraData['id']}";
        $predmetResult = mysqli_query($conn, $sql);

        // Přidání předmětů
        $predmety = $katedra->addChild('předměty');

        while ($predmetData = mysqli_fetch_assoc($predmetResult)) {
            $predmet = $predmety->addChild('předmět');
            $predmet->addAttribute('zkratka', $predmetData['zkratka']);
            $predmet->addAttribute('typ', $predmetData['typ']);
            addChildWithText($predmet, 'název', $predmetData['nazev']);
            if (!empty($predmetData['popis'])) {
                addChildWithText($predmet, 'popis', $predmetData['popis']);
            }
        }
    }

    // Uložení XML do souboru
    $xmlFilePath = 'fakulta.xml';
    $fakulta->asXML($xmlFilePath);

    echo "XML soubor '$xmlFilePath' byl úspěšně vygenerován.\n";
} else {
    echo "Žádná data nebyla nalezena.\n";
}

mysqli_close($conn);
