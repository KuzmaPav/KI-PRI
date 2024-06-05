<?php include "includes/header.html"; ?>

<div class="container mt-5 mb-5">
<?php
// Check if form ID or filename is provided
if (!isset($_GET['id'])) {
    echo "Form ID is required.";
    exit;
}

$formName = $_GET['id'];

$xmlFilesFolder = 'forms/';
$xmlFile = $xmlFilesFolder . $formName;

// Check if XML file exists
if (!file_exists($xmlFile)) {
    echo "Form not found.";
    exit;
}

$xslPath = 'style/form.xsl';

$xml = new DOMDocument;
$xml->load($xmlFile);

$xsl = new DOMDocument;
$xsl->load($xslPath);

$xslt = new XSLTProcessor();
$xslt->importStylesheet($xsl);

$transformed_xml = $xslt->transformToXml($xml);

// Save the transformed XML to a temporary file
$tempFile = tempnam(sys_get_temp_dir(), 'xml') . '.html';
file_put_contents($tempFile, $transformed_xml);

// Get the URL for the temporary file
$tempUrl = 'temp/' . basename($tempFile);

// Copy the temporary file to a publicly accessible location
copy($tempFile, $tempUrl);

echo "<iframe id='formIframe' src='$tempUrl' width='100%' height='1000px' style='border:0;'></iframe>";

// Store the temporary file name in a hidden input field
echo "<input type='hidden' id='tempFileName' value='$tempUrl'>";

?>

<button id='submitBtn' class='btn btn-primary mt-3'>Submit Answers</button>

</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('submitBtn').addEventListener('click', function() {
        var iframe = document.getElementById('formIframe').contentWindow;
        var tempFileName = document.getElementById('tempFileName').value;

        // Collect data from the form in the iframe
        function collectFormData() {
            var form = iframe.document.querySelector('form');
            var formData = new FormData(form);
            var data = {};
            formData.forEach((value, key) => {
                if (!data[key]) {
                    data[key] = value;
                } else {
                    if (!Array.isArray(data[key])) {
                        data[key] = [data[key]];
                    }
                    data[key].push(value);
                }
            });
            return data;
        }

        // Function to send data to the server
        function sendDataToServer(data, tempFileName) {
            data.tempFileName = tempFileName; // Include tempFileName in the data to be sent
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'scripts/save_answers.php?id=<?php echo $formName; ?>', true);
            xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        alert(response.message);
                        window.location.href = 'view_forms.php';
                    } else {
                        alert('Error: ' + response.message);
                    }
                } else {
                    console.error('Error in sending data');
                }
            };
            xhr.send(JSON.stringify(data));
        }

        var data = collectFormData();
        sendDataToServer(data, tempFileName);
    });
});
</script>

<?php include "includes/footer.html"; ?>
