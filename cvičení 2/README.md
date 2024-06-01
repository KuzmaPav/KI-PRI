# 2. Cvičení

1. Prozkoumat RSS strukturu (např. https://news.bitcoin.com/feed nebo https://www.ceskenoviny.cz/rss/). Mnoho RSS zdrojů najdete na [rss.feedspot.com](https://rss.feedspot.com/) nebo podle návodu. Uložte RSS XML do souboru a ověřte (v našem validátoru), zda je well-formed. Zobrazte RSS feed v nějaké RSS čtečce, např. v [rssviewer.app](https://rssviewer.app/).

    - Soubor: [bitcoin.rss](bitcoin.rss)

---

1. DTD validační soubor k entitě student z minulé hodiny ([student.xml](/cvičení%201/student.xml)), případně také vlastní DTD pro fakultu.

    - Soubor řešení: [student.dtd](student.dtd)

---

3. K DTD souboru vytvořte XSD soubor, které budou validovat stejné XML soubory. Jelikož XSD umí více než DTD, můžete rozšířit validační možnosti. Zaměřte se na to, ať máte XSD soubory přehledně strukturované.

    - Soubor řešení: [student.xsd](student.xsd)

---

4. Upravte soubor index.php tak, aby validoval ne pomocí DTD schématu, ale pomocí XSD schématu
   
    - Řešení na webu: [localhost:51001](http://localhost:51001/)
        - php soubor: [index.php](/cvičení%201/DockerSetup/BasicWeb/php/src/index.php) (dokáže validovat přes dtd i xsd)

---