<?php include "includes/header.html"; ?>

<?php
include "scripts/remove_form.php";

if (isset($_GET['delete'])) {
    $formId = $_GET['delete'];
    if (removeForm($formId)) {
        echo '<script>window.location.href="view_forms.php";</script>';
        exit();
    } else {
        echo "Formulář nebyl nalezen.";
    }
}
?>

<div class="container mt-5 mb-5">
    <h3>Aktivní formuláře</h3>
    <div class="row justify-content-around">
        <?php
        $xmlFilesFolder = 'forms/';
        $xmlFiles = glob($xmlFilesFolder . '*.xml');

        if ($xmlFiles) {
            foreach ($xmlFiles as $xmlFile) {
                $xml = simplexml_load_file($xmlFile);
                if ($xml) {
                    $title = (string) $xml->attributes()->title;
                    $questionCount = count($xml->questions->question);
                    $xmlFileName = basename($xmlFile);
        ?>
                    <div class="col-lg-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $title; ?></h5>
                                <p class="card-text">Počet otázek: <?php echo $questionCount; ?></p>
                                <div class="d-flex justify-content-between">
                                    <a href="form.php?id=<?php echo $xmlFileName; ?>" class="btn btn-primary py-1">Vyplnit</a>
                                    <a href="<?php echo $xmlFilesFolder . $xmlFileName; ?>" class="btn btn-success py-1" download>Export schéma</a>
                                    <a href="<?php echo $xmlFilesFolder ."answers/" . pathinfo($xmlFileName, PATHINFO_FILENAME) . "_answers.xml"; ?>" class="btn btn-success py-1" download>Export odpovědi</a>
                                    <a href="?delete=<?php echo $xmlFileName; ?>" class="btn btn-danger" onclick="return confirm('Opravdu chcete tento formulář smazat?')">Vymazat</a>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                } else {
                    echo "Error loading XML file: $xmlFile";
                }
            }
        } else {
            echo "Neexistují žádné aktivní formuláře. :/";
        }
            ?>
    </div>
</div>

<?php include "includes/footer.html"; ?>
