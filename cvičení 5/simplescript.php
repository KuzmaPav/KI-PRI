<?
$file_path = "C:\Users\Kuzma\Desktop\ki_php\cvičení 1\student.xml";


$xml = file($file_path);
$simpleXML = simplexml_load_file($file_path);

echo "XML\n";
echo print_r($xml) . "\n";
echo "SmipleXML\n";
echo print_r($simpleXML) . "\n";

