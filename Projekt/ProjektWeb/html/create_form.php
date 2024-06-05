<?php include "includes/header.html"; ?>

<!-- Modal for upload rules -->
<div class="modal fade" id="uploadRulesModal" tabindex="-1" aria-labelledby="uploadRulesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadRulesModalLabel">Pravidla pro vkládání formulářů</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul>
                    <li>Formuláře musí být ve formátu XML.</li>
                    <li>Soubor nesmí překročit velikost 2 MB.</li>
                    <li>Soubor musí být validní a správně formátovaný.</li>
                    <li>Musí splňovat toto schéma: <a href="forms.xsd">XSD schéma</a>, <a href="forms_example.xml">příklad</a></li>
                </ul>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zavřít</button>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5 text-center w-75 d-flex flex-column align-items-center">
    <h3>Vytvořit formulář</h3>
    <a href="form_former.php" class="btn btn-primary">Vytvořit</a>
    <hr class="w-50">
    <h3>Nahrát připravený formulář</h3>
    <form method="post" enctype="multipart/form-data" class="mb-2">
        <input type="file" name="uploadedFile" accept=".xml, .txt" class="form-control-file mb-2" data-max-file-size="2M"/>
        <button type="submit" class="btn btn-success">Odeslat</button>
    </form>
    <a href="#" data-toggle="modal" data-target="#uploadRulesModal">Pravidla pro vkládání formulářů</a>

    <?php 
    include "scripts/validate_upload.php";
    include "scripts/save_form.php";

    $xsdFilePath = "./style/forms.xsd";

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] == UPLOAD_ERR_OK) {
            $xmlFilePath = $_FILES['uploadedFile']['tmp_name'];
            $xmlFileName = $_FILES['uploadedFile']['name'];

            $fileExtension = strtolower(pathinfo($xmlFileName, PATHINFO_EXTENSION));

            if (in_array($fileExtension, ["xml", "txt"]))
            {
                if(xml_validate($xmlFilePath, $xsdFilePath))
                {
                    $dom = new DOMDocument('1.0', 'UTF-8');
                    $dom->formatOutput = true;

                    $dom->load($xmlFilePath); #loadXML nefunguje

                    saveForm($dom, $xmlFilesFolder, $lastIndexPath);
                }
            }
        }
    }

    ?>
</div>



<?php include "includes/footer.html"; ?>