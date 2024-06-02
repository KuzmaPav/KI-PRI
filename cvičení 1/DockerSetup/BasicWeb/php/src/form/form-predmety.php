<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <title>Výběr předmětu</title>
</head>

<body>
    <h1>Výběr předmětu</h1>
    <form method="get" action="form-predmety.php">
        <label for="predmet">Vyberte předmět:</label>
        <?php
        // Načtení XML souboru
        $xml = new DOMDocument;
        $xml->load('../xml/studium.xml');

        // Načtení XSL souboru
        $xsl = new DOMDocument;
        $xsl->load("form-predmety-select.xsl");

        // Vytvoření transformátoru
        $proc = new XSLTProcessor();
        $proc->importStyleSheet($xsl);

        // Aplikace transformace
        echo $proc->transformToXML($xml);
        ?>
        <input type="submit" value="Zobrazit">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["predmet"])) {
        $kodPredmetu = $_GET["predmet"];
        echo tabulkaPredmetu($kodPredmetu);
    }

    function tabulkaPredmetu($kodPredmetu)
    {
        $xml = new DOMDocument;
        $xml->load('../xml/studium.xml');

        $xsl = new DOMDocument;
        $xsl->load("studium-predmet.xsl");

        $xslt = new XSLTProcessor();
        $xslt->importStylesheet($xsl);

        $xslt->setParameter('', 'kodPredmetu', $kodPredmetu);

        return $xslt->transformToXml($xml);
    }
    ?>
</body>

</html>
