# 3. Cvičení

1. Validace webové stránky pomocí W3 validátoru. Např. bing, ujep, webovka z minulého cvičení
    - W3 validátor: [odkaz na W3 validátor](https://validator.w3.org/)

---

2. Úprava webového serveru tak aby zpřístupnil soubory z disku. Přesuňte adresář xml do php/src, aby soubory v něm byly přístupné přes URL. Přidejte do webové stránky odkazy na vaše XML soubory a ověřte, že se zobrazují v prohlížeči.
    - Řešení na webu: [localhost:51001](http://localhost:51001/)
        - php soubor: [index.php](/cvičení%201/DockerSetup/BasicWeb/php/src/index.php) (dokáže přidávat soubory uživatelem) (zatím neřeší následují problémy: nepřidává css a xsl soubory)

---

3. Ostylujte váš XML pomocí CSS. Do XML souboru (student, fakulta) přidejte řádku specifikace CSS stylu a vytvořte soubory se stylem.
    - Řešení na webu: [localhost:51001](http://localhost:51001/)
        - css soubor student: [student.css](/cvičení%201/DockerSetup/BasicWeb/php/src/xml/css/student.css)
        - css soubor fakulta: [fakulta.css](/cvičení%201/DockerSetup/BasicWeb/php/src/xml/css/fakulta.css)

---

4. Zobrazení XML/XSL v prohlížeči. Do XML souboru (student, fakulta) přidejte řádku specifikace XSL stylu a vytvořte odpovídající xsl soubory.
    - Řešení na webu: [localhost:51001](http://localhost:51001/)
        - xsl soubor student: [student.xsl](/cvičení%201/DockerSetup/BasicWeb/php/src/xml/xsl/student.xsl)

---

5. Transformace XML/XSL server-side. XSLT - On server side.
    - Řešení na webu: [localhost:51001](http://localhost:51001/)
        - php soubor: [xsltransorfmation.php](/cvičení%201/DockerSetup/BasicWeb/php/src/xsltransform.php)

---

6. Zdokonalení webového serveru. Pokuste se svůj PHP skript upravit tak, aby, např., dal na výběr k zobrazení XML soubory, které nalezne na disku (nápověda: glob(...)). Zde máte volnou ruku – proveďte jakékoli úpravy, které uznáte za vhodné.
    - Moje úpravy: Vlkádání xml souborů do katalogu a možnost jejich zobrazení