<?php include "includes/header.html"; ?>

<div class="container mt-5 mb-5">
    <h3>Vytvořte si vlastní jednoduché formuláře</h3>
    <form id="form-creator" method="post">
        <div class="form-group">
            <label for="form_title">Název formuláře:</label>
            <input type="text" name="form_title" class="form-control" required>
        </div>
        <div id="questions-container"></div>
        <div class="row ml-1">
            <button type="button" class="btn btn-primary" id="add-question">Přidat otázku</button>
        </div>
        <hr>
        <div class="row d-flex justify-content-center">
            <button type="submit" class="btn btn-success">Vytvořit formulář</button>
        </div>
    </form>
</div>


<template id="question-template">
    <div class="question-item mb-3">
        <div class="d-flex justify-content-between align-items-center">
            <label for="question_text" class="mb-0">Otázka:</label>
            <button type="button" class="btn btn-danger btn-sm remove-question py-0">Odstranit otázku</button>
        </div>
        <input type="text" name="questions[0][question_text]" class="form-control" required>
        <label for="type">Typ:</label>
        <select name="questions[0][type]" class="form-control question-type" required>
            <option value="text">Text</option>
            <option value="checkbox">Checkbox</option>
            <option value="radiobox">Radiobox</option>
        </select>
        <div class="options-container mt-3" style="display: none;">
            <label for="options">Možnosti:</label>
            <div class="options-list">
                <div class="d-flex align-items-center mb-2 option-item">
                    <input type="text" name="questions[0][options][]" class="form-control">
                    <button type="button" class="btn btn-danger btn-sm remove-option ml-2">x</button>
                </div>
            </div>
            <button type="button" class="btn btn-light add-option">Přidat možnost</button>
        </div>
        <hr>
    </div>
</template>


<script>
// JavaScript to handle adding and removing questions and options
document.addEventListener('DOMContentLoaded', function() {
    let questionIndex = 0;

    function updateOptionsVisibility() {
        document.querySelectorAll('.question-type').forEach(function(select) {
            const optionsContainer = select.closest('.question-item').querySelector('.options-container');
            optionsContainer.style.display = (select.value === 'checkbox' || select.value === 'radiobox') ? 'block' : 'none';
        });
    }

    function addQuestion() {
        const template = document.getElementById('question-template');
        const clone = template.content.cloneNode(true);

        // Update names and ids
        const questionText = clone.querySelector('[name="questions[0][question_text]"]');
        questionText.name = `questions[${questionIndex}][question_text]`;

        const questionType = clone.querySelector('[name="questions[0][type]"]');
        questionType.name = `questions[${questionIndex}][type]`;

        const options = clone.querySelectorAll('[name="questions[0][options][]"]');
        options.forEach(option => {
            option.name = `questions[${questionIndex}][options][]`;
        });

        document.getElementById('questions-container').appendChild(clone);
        questionIndex++;

    }

    document.getElementById('add-question').addEventListener('click', addQuestion);

    document.getElementById('questions-container').addEventListener('change', function(e) {
        if (e.target.classList.contains('question-type')) {
            updateOptionsVisibility();
        }
    });

    document.getElementById('questions-container').addEventListener('click', function(e) {
        if (e.target.classList.contains('add-option')) {
            const optionsList = e.target.closest('.options-container').querySelector('.options-list');
            const newOption = document.createElement('div');
            newOption.className = 'd-flex align-items-center mb-2 option-item';
            newOption.innerHTML = `
                <input type="text" name="${optionsList.closest('.question-item').querySelector('.question-type').name.replace('[type]', '[options][]')}" class="form-control">
                <button type="button" class="btn btn-danger btn-sm remove-option ml-2">x</button>
            `;
            optionsList.appendChild(newOption);
        }

        if (e.target.classList.contains('remove-option')) {
            e.target.closest('.option-item').remove();
        }

        if (e.target.classList.contains('remove-question')) {
            e.target.closest('.question-item').remove();
        }
    });

    // Initialize with one question
    addQuestion();
});
</script>

<?php 
include "scripts/save_form.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $questions = $_POST['questions'];
    $formTitle = htmlspecialchars($_POST['form_title']); // Získání hodnoty titulu formuláře

    $dom = new DOMDocument('1.0', 'UTF-8');
    $dom->formatOutput = true;

    $root = $dom->createElement('form');
    $root->setAttribute('title', $formTitle); // Přidání atributu title
    $dom->appendChild($root);

    $questionsElement = $dom->createElement('questions');
    $root->appendChild($questionsElement);

    foreach ($questions as $index => $question) {
        $questionElement = $dom->createElement('question');
        $questionElement->setAttribute('num', $index + 1);
        $questionElement->setAttribute('type', $question['type']);

        $questionText = $dom->createElement('question_text', htmlspecialchars($question['question_text']));
        $questionElement->appendChild($questionText);

        if (isset($question['options']) && ($question['type'] == 'checkbox' || $question['type'] == 'radiobox')) {
            $optionsElement = $dom->createElement('options');
            foreach ($question['options'] as $option) {
                $optionElement = $dom->createElement('option', htmlspecialchars($option));
                $optionsElement->appendChild($optionElement);
            }
            $questionElement->appendChild($optionsElement);
        }

        $questionsElement->appendChild($questionElement);
    }

    saveForm($dom, $xmlFilesFolder, $lastIndexPath);
}
?>



<?php include "includes/footer.html"; ?>

