<!DOCTYPE html>
<html lang="cs">

<?php
    $title = 'XML validátor';
    $xmlFilesFolder = "xml/";
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1><?= $title ?></h1>
        <p>Nahrajte XML soubor, případně také také DTD soubor nebo XSD soubor.</p>
        <hr>
        <form enctype="multipart/form-data" method="POST">
            <div class="form-group row">
                <label for="xmlFile" class="col-sm-2 col-form-label">XML soubor:</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control-file" name="xml" id="xmlFile" accept="text/xml" data-max-file-size="2M">
                </div>
            </div>
            <div class="form-group row">
                <label for="structFile" class="col-sm-2 col-form-label">Strukturový soubor:</label>
                <div class="col-sm-7">
                    <input type="file" class="form-control-file" name="structfile" id="structFile" data-max-file-size="2M">
                </div>
                <div class="col-sm-3">
                    <select name="structtype" class="form-control">
                        <option value="dtd">DTD</option>
                        <option value="xsd">XSD</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10 offset-sm-2">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="saveoption" id="saveOption">
                        <label class="form-check-label" for="saveOption">Save XML file</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10 offset-sm-2">
                    <input type="submit" class="btn btn-primary" value="Odeslat">
                </div>
            </div>
        </form>
        <hr>
        <a href="xsltransform.php" class="btn btn-secondary">Catalog</a>
        <hr>

        <?php
        function printErrors()
        { ?>
            <table class="table">
                <?php foreach (libxml_get_errors() as $error) { ?>
                    <tr>
                        <td><?= $error->line ?></td>
                        <td><?= $error->message ?></td>
                    </tr>
                <?php } ?>
            </table>
        <?php }

        function validate($xmlPath, $structType, $structPath = '')
        {
            $doc = new DOMDocument;
            libxml_use_internal_errors(true);
            $doc->loadXML(file_get_contents($xmlPath));
            printErrors();
            libxml_use_internal_errors(false);
            if ($structType == "dtd") {
                $root = $doc->firstElementChild->tagName;
                if ($root && $structPath) {
                    $root = $doc->firstElementChild->tagName;
                    $systemId = 'data://text/plain;base64,' . base64_encode(file_get_contents($structPath));
                    echo "<p>Validuji podle DTD. Kořen: <b>$root</b></p>";
                    $creator = new DOMImplementation;
                    $doctype = $creator->createDocumentType($root, '', $systemId);
                    $newDoc = $creator->createDocument(null, '', $doctype);
                    $newDoc->encoding = "utf-8";
                    $oldRootNode = $doc->getElementsByTagName($root)->item(0);
                    $newRootNode = $newDoc->importNode($oldRootNode, true);
                    $newDoc->appendChild($newRootNode);
                    $doc = $newDoc;
                }
                libxml_use_internal_errors(true);
                $isValid = $doc->validate();
                printErrors();
                libxml_use_internal_errors(false);
                return $isValid;
            } elseif ($structType == "xsd") {
                libxml_use_internal_errors(true);
                $isValid = $doc->schemaValidate($structPath);
                printErrors();
                libxml_use_internal_errors(false);
                return $isValid;
            } else {
                return false;
            }
        }

        $xmlFile = @$_FILES['xml'];
        $structFile = @$_FILES['structfile'];
        $structType = @$_POST['structtype'];
        if (@$xmlTmpName = $xmlFile['tmp_name']) {
            $structTmpName = $structFile['tmp_name'];
            $isValid = validate($xmlTmpName, $structType, $structTmpName);
            if ($isValid)
                echo "Nahraný XML soubor je validní. ";
            if (isset($_POST["saveoption"])) {
                $destination = $xmlFilesFolder . $xmlFile['name'];
                if (move_uploaded_file($xmlTmpName, $destination)) {
                    echo "XML soubor byl úspěšně uložen.";
                } else {
                    echo "Chyba při ukládání XML souboru.";
                }
            }
        }
        ?>
    </div>
</body>

</html>
