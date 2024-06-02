# 7. Cvičení

1. Projděte si předložená XPath/XSLT řešení a porovnejte se svými. Vyberte si některá a dokončete příslušný XSL soubor tak, aby výstupem bylo buď validní HTML nebo XML.
    - vlastní xsl soubory: [složka](/cvičení%206/task%205)

---

2. V *Projektu 7* je skript `form.php`. Použijte jej jako základ pro experiment s `<form>`. Vyzkoušejte:
    > * method: `get` / `post`
    > * action: přechod na jinou stránku
    > * `<input>`: použijte různé typy dat
    
    Formulář po případě ostylujte.

    - řešení na basic webu (cvičení1): [localhost:51001/form/form.php](http://localhost:51001/form/form.php)


3. Skript `form-predmety.php` obsahuje variantu ukázkového řešení XPath problému č. 4 – tabulku s údaji pro daný předmět. Transformačnímu souboru `studium-predmet.xsl` je kód předmětu předán z PHP jako parametr.
    > 1. Doplňte formulář (method, `<input>`, ...) a použijte PHP superglobální proměnné tak, aby uživatel mohl zadat kód požadovaného předmětu.
    > 2. Použijte `<select>` a `<option>` tak, aby uživatel měl kódy předmětů na výběr.
    > 3. Zkuste napsat další transformační XSL soubor, který bude pro formulář generovat seznam předmětů na výběr v `<select>`.

    -  řešení na basic webu (cvičení1): [localhost:51001/form/form-predmety.php](http://localhost:51001/form/form-predmety.php)
    -  studium predmet xsl soubor: [studium-predmet.xsl](studium-predmet.xsl)
    -  Vytvořený vybírací xsl soubor: [form-predmety-select.xsl](/cvičení%201/DockerSetup/BasicWeb/php/src/form/form-predmety-select.xsl)