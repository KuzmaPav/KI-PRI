# 5. Cvičení

1. Dokončit model databázových tabulek z minulého cvičení.
    - sql soubor: [univerzita.sql](DockerSetup/DatabaseWeb/schema/univerzita.sql)

---

2. Načtěte vaše XML soubory do SimpleXML a pomocí [print_r()](https://www.php.net/manual/en/function.print-r.php) vypište SimpleXML strukturu. Porovnejte ji se zdrojovým XML.
    - soubor s řešením: [simplescript.php](simplescript.php)

---

3. Na vašech datech si vyzkoušejte procházení SimpleXML stromem, podobně jako ve výše uvedeném kódu, který podle potřeby rozšiřte pomocí dalších [SimpleXML funkcí](https://www.w3schools.com/Php/php_ref_simplexml.asp).
    - soubor s řešením: [intermediatescript.php](intermediatescript.php)

---

4. Napište PHP skript, který pomocí SimpleXML vygeneruje XML, odpovídající vašemu [fakulta.xsd](fakulta.xsd).
    - soubor s řešením: [hardscript.php](hardscript.php)
    - generovaný xml: [fakulta.xml](generovana_fakulta.xml)

---

5. Upravte váš skript z Úkolu 5.4 tak, aby data četl z databáze, a generoval validní XML odpovídající vašemu souboru `fakulta.xsd`.
Potřebujete [select](https://www.w3schools.com/mysql/mysql_select.asp) a [where](https://www.w3schools.com/mysql/mysql_where.asp).
    - soubor s řešením: [hardcorescript.php](/cvičení%204/DockerSetup/DatabaseWeb/html/phpscript/hardcorescript.php)
    - generovaný xml: [fakulta.xml](/cvičení%204/DockerSetup/DatabaseWeb/html/phpscript/fakulta.xml)

---

6. Vyberte si jednu z uvedených CSS knihoven: [W3 CSS](https://www.w3schools.com/w3css), [Tailwind](https://tailwindcss.com/), [Bootstrap](https://getbootstrap.com/), nebo podobnou, a použijte ji ve vašem projektu, místo "vanilla" CSS.
    - upravený web: [localhost:51001](http://localhost:51001/)
    - upravený soubory: [index.php](/cvičení%201/DockerSetup/BasicWeb/php/src/index.php) a [xsltransform.php](/cvičení%201/DockerSetup/BasicWeb/php/src/xsltransform.php)

