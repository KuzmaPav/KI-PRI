<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (!isset($_GET['id'])) {
        echo json_encode(['status' => 'error', 'message' => 'Form ID is required.']);
        exit;
    }

    $formName = $_GET['id'];
    $answersFolder = '../forms/answers/';
    $answersFile = $answersFolder . pathinfo($formName, PATHINFO_FILENAME) . '_answers.xml';

    if (!file_exists($answersFolder)) {
        mkdir($answersFolder, 0777, true);
    }

    if (file_exists($answersFile)) {
        $xml = simplexml_load_file($answersFile);
    } else {
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><form></form>');
        $xml->addChild('questions');
    }

    $questionsElement = $xml->questions;

    if (isset($data['tempFileName'])) {
        $tempFileName = "../" . $data['tempFileName'];
        if (file_exists($tempFileName)) {
            unlink($tempFileName);
            unset($data['tempFileName']);
        }
    }

    foreach ($data as $key => $value) {
        $questionIndex = str_replace('question', '', $key);
        
        // Remove trailing [] if present
        $questionIndex = rtrim($questionIndex, '[]');

        // Check if question already exists
        $existingQuestion = null;
        foreach ($questionsElement->question as $question) {
            if ((string) $question['num'] === $questionIndex) {
                $existingQuestion = $question;
                break;
            }
        }

        if ($existingQuestion) {
            if (is_array($value)) {
                foreach ($value as $answer) {
                    $existingQuestion->addChild('answer', htmlspecialchars($answer));
                }
            } else {
                $existingQuestion->addChild('answer', htmlspecialchars($value));
            }
        } else {
            $questionElement = $questionsElement->addChild('question');
            $questionElement->addAttribute('num', $questionIndex);
            if (is_array($value)) {
                foreach ($value as $answer) {
                    $questionElement->addChild('answer', htmlspecialchars($answer));
                }
            } else {
                $questionElement->addChild('answer', htmlspecialchars($value));
            }
        }
    }

    $dom = dom_import_simplexml($xml)->ownerDocument;
    $dom->formatOutput = true;
    $dom->save($answersFile);

    echo json_encode(['status' => 'success', 'message' => 'Data byla úspěšně poslána na server.']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Nepovedlo se uložit na server.']);
}
