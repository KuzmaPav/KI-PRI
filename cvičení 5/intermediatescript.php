<?php


function getInput($possibleInputs)
{
    while (true)
    {
        echo "Enter the number to go deeper, 'b' to go back, or 'q' to quit: ";
        $handle = fopen("php://stdin", "r");
        $input = trim(fgets($handle));
        echo "\n";

        if (in_array($input, $possibleInputs))
        {
            return $input;
        }
    }
}



function displayElement($xmlElement)
{

    while(true)
    {

        echo $xmlElement->GetName() . "\n\n";

        $xml_children = [];
        
        $idx = 0;
        foreach($xmlElement->children() as $child)
        {
            $xml_children[$idx] = $child;
            echo $idx . " - " . $child->getName() . "\n";
            $idx++;
        }
    
        echo "\n";
    
        $input = getInput(array_merge(["q", "b"], array_keys($xml_children)));
    
    
        if($input == "q")
        {
            exit("Exiting...\n");
        }
        elseif($input == "b")
        {
            return "back";
        }
        else
        {
            if(in_array($input, array_keys($xml_children)))
            {
                displayElement($xml_children[$input]);
            }
        }
    }
}




$file_path = "C:\Users\Kuzma\Desktop\ki_php\cvičení 1\student.xml";

if (!file_exists($file_path)) {
    exit("File not found: $file_path\n");
}

$xml = simplexml_load_file($file_path);

$file_name = pathinfo($file_path, PATHINFO_BASENAME);

echo $file_name . "\n";
echo "-----------------------\n";

displayElement($xml);