# 6. Cvičení

1. Prostudujte si tyto soubory a porovnejte s vaší verzí souborů `fakulta.*` a `student.*`. Posuďte je a proveďte nebo navrhněte úpravy, změny a vylepšení.
    - Xsl zobrazení vypadá kvalitně (100% lepší než můj styl), žadné vylepšení mě nenapadá
    - Soubory: [xml](fakulta.xml), [xsd](fakulta.xsd), [xsl](fakulta.xsl)

---

2. Z proketu 6 doplňit soubor studium.xml o:
    * přidejte do programu studia další předměty, také z jiných kateder
    * rozšiřte element `<vyucujici>` o telefon a email
    Poté vytvořte podle XML souboru XSD soubor `studium.xsd` pro validaci. V XSD souboru použijte [datové typy](https://www.w3schools.com/xml/schema_dtypes_string.asp), [xs:simpleType](https://www.w3schools.com/xml/el_simpletype.asp) a [xs:restriction](https://www.w3schools.com/xml/el_restriction.asp), [xs:complexType](https://www.w3schools.com/xml/el_complextype.asp), [xs:sequence]() a další možnosti, které [XSD Schema](https://www.w3schools.com/xml/schema_intro.asp) nabízí.

    - studium xml soubor: [studium.xml](studium.xml) 
        - Přidané předměty: MAT1 - 1. ročník, zimní semestr
                            MAT2 - 1. ročník, letní semestr
                            FYS  - 2. ročník, zimní semestr
                            CHEM - 3. ročník, letní semestr
    
    - studium xsd soubor: [studium.xsd](studium.xsd)

---

3. Podle svého souboru `studium.xsd` z úkolu 2 vytvořte `studium.xsl`, který transformuje XML na HTML5. ([XSLT](https://www.w3schools.com/xml/xsl_intro.asp))
    - xsl soubor: [studium.xsl](studium.xsl)

---

4. Váš transformační soubor `studium.xsl` z úkolu 3 upravte tak, aby používal HTML5 sémantické elementy, pokud a kde je možné a vhodné. Případně použijte i vlastní uživatelské značky, např `<uni-studium>`, `<uni-rocnik>`, apod.
    - xsl soubor [studium2.xsl](studium2.xsl)

---

5. Vytvořte různé XSL soubory, které transformují `studium.xsl` tak, že generují následující HTML nebo XML:

    1. Seznam všech předmětů: kód + názvy předmětů, jako seznam s odrážkami nebo číslovaný seznam.
        - Soubor s řešením: 
        - Soubor s řešením: 
    2. Seznam předmětů upravte (ostylujte) tak, aby předměty vyučované různými katedrami měly různé pozadí (barvu).
        - Soubor s řešením: 
    3. Tabulku předmětů v prvním roce studia, v zimním semestru. Sloupce tabulky obsahují: kód předmětu (např. *KI/PRI*), počet kreditů, vyučující, ... atd.
        - Soubor s řešením: 
    4. Tabulku s údaji pro daný předmět (např. MRL).
        - Soubor s řešením: 
    5. Seznam předmětů v posledním semestru:
        * v pořadí, v jakém jsou v XML souboru
        * seřazené podle kódu předmětu
        * seřazené podle počtu kreditů
        * pod tabulku uveďte „Celkem kreditních bodů = ...“.
        - Soubor s řešením: 
    6.  Tabulku předmětů podle semestrů, pouze předměty s počtem kreditů > 2.
        - Soubor s řešením: 
    7.  Seznam semestrů podle celkového počtu kreditních bodů.
        - Soubor s řešením: 
    8.  Seznam předmětů v prvním semestru. Předměty, které vyučují různé katedry, mají mít různé pozadí (barvu).
        - Soubor s řešením: 
    9.  Seznam předmětů pro semestr s nejvyšším celkovým počtem kreditů.
        - Soubor s řešením: 
