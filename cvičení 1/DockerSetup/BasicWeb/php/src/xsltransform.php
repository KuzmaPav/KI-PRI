<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XML a XSL Transformace</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1 class="mt-4">XML a XSL Transformace</h1>
        <a href="index.php" class="btn btn-secondary mb-3">Zpět</a>

        <hr>

        <div class="row">
            <div class="col-md-4">
                <form method="POST" action="">
                    <?php
                    $xmlFilesFolder = "xml/";
                    $files = scandir($xmlFilesFolder);

                    foreach ($files as $file) {
                        if (is_file($xmlFilesFolder . $file) && pathinfo($file, PATHINFO_EXTENSION) == 'xml') {
                            echo "<button type='submit' name='file' value='$file' class='btn btn-primary mb-2'>$file</button><br>";
                        }
                    }
                    ?>
                </form>

                <hr>

                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="cssFile" class="col-sm-2 col-form-label">CSS soubor:</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control-file" name="css" id="cssFile" accept="text/css" data-max-file-size="2M">
                            <input type="submit" class="btn btn-primary mt-2" value="Odeslat CSS">
                        </div>
                    </div>
                </form>

                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="xslFile" class="col-sm-2 col-form-label">XSL soubor:</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control-file" name="xsl" id="xslFile" data-max-file-size="2M">
                            <input type="submit" class="btn btn-primary mt-2" value="Odeslat XSL">
                        </div>
                    </div>
                </form>

                <hr>

            </div>
            <div class="col-md-8">
                <?php
                function getMatchingXslFiles($xmlFile, $xslFilesFolder) {
                    $xmlFileName = pathinfo($xmlFile, PATHINFO_FILENAME);
                    $xslFiles = scandir($xslFilesFolder);
                    $matchingXslFiles = [];

                    foreach ($xslFiles as $file) {
                        if (strpos($file, $xmlFileName) !== false && pathinfo($file, PATHINFO_EXTENSION) == 'xsl') {
                            $matchingXslFiles[] = $file;
                        }
                    }

                    return $matchingXslFiles;
                }

                function transformXsl($xmlFile, $xslFile, $xmlFilesFolder) {
                    $xmlPath = $xmlFilesFolder . $xmlFile;
                    $xslPath = $xmlFilesFolder . "xsl/" . $xslFile;

                    $xml = new DOMDocument;
                    $xml->load($xmlPath);

                    $xsl = new DOMDocument;
                    $xsl->load($xslPath);

                    $xslt = new XSLTProcessor();
                    $xslt->importStylesheet($xsl);

                    $transformed_xml = $xslt->transformToXml($xml);

                    // Save the transformed XML to a temporary file
                    $transformed_xml_file = tempnam(sys_get_temp_dir(), 'xml');
                    file_put_contents($transformed_xml_file, $transformed_xml);

                    // Generate a unique URL for the iframe source
                    $iframe_src = "data:text/html;charset=utf-8," . rawurlencode(file_get_contents($transformed_xml_file));

                    echo "<iframe src='$iframe_src' width='100%' height='1000px' max-height='2000px' style='border:0;'></iframe>";

                    // Clean up the temporary file
                    unlink($transformed_xml_file);
                }

                function saveFile($file, $folder) {
                    $target_dir = $folder;
                    $target_file = $target_dir . basename($file["name"]);
                    if (move_uploaded_file($file["tmp_name"], $target_file)) {
                        echo "Soubor " . htmlspecialchars(basename($file["name"])) . " byl úspěšně nahrán.<br>";
                    } else {
                        echo "Chyba při nahrávání souboru.<br>";
                    }
                }

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (isset($_FILES['css'])) {
                        saveFile($_FILES['css'], $xmlFilesFolder . "css/");
                    }

                    if (isset($_FILES['xsl'])) {
                        saveFile($_FILES['xsl'], $xmlFilesFolder . "xsl/");
                    }

                    if (isset($_POST['file'])) {
                        $xmlFile = $_POST['file'];
                        $xslFilesFolder = $xmlFilesFolder . "xsl/";
                        $matchingXslFiles = getMatchingXslFiles($xmlFile, $xslFilesFolder);

                        echo "<h2>Výběr XSL souboru pro $xmlFile</h2>";
                        echo "<form method='POST' action=''>";
                        echo "<input type='hidden' name='xmlFile' value='$xmlFile'>";

                        $xmlPath = $xmlFilesFolder . $xmlFile;
                        echo "<a href='$xmlPath' target='_blank' class='btn btn-info mb-2'>Zobrazit původní XML</a><br>";

                        foreach ($matchingXslFiles as $xslFile) {
                            echo "<button type='submit' name='xslFile' value='$xslFile' class='btn btn-primary mb-2'>$xslFile</button><br>";
                        }

                        echo "</form>";
                    }

                    if (isset($_POST['xslFile'])) {
                        $xmlFile = $_POST['xmlFile'];
                        $xslFile = $_POST['xslFile'];

                        if ($xslFile != 'original') {
                            transformXsl($xmlFile, $xslFile, $xmlFilesFolder);
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>
