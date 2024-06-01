# 1. Cvičení

0. Připravit docker a sestavit a spustit php validator
    - docker setup script: [compose.bat](DockerSetup\BasicWeb\compose.bat)

---

1. Vytvořit jednoduchý XML dokument `student.xml`, ve kterém budou informace o entitě "student naší univerzity". Měl by tedy obsahovat informace jako __jméno__, __příjmení__, __studentské číslo__, __fakulta__, aj. Některé informace můžete uložit do vnořených elementů, jiné do atributů.
   - Soubor řešení: [student.xml](student.xml)

---

2. Opravte XML kód `knihy.xml` tak, aby byl well-formed. Výsledek otestujte validátorem.
   - Soubor řešení: [knihy.xml](knihy.xml)

---

3. Vytvořit návrh struktury XML dokumentu (strom) podle následující specifikace:
    > Webová aplikace pro záznam studentů univerzity. Zaznamenávejte informace: __jméno__, __příjmení__, __studentské číslo__, __email__, __studijní rok__, __rozvrh__, __předměty__, __splněné předměty__ a další zajímavé informace.

    > Zaznamenat fakulty univerzity, každá fakulta zaznamenává informace: __děkan__, __katedry__, __vedoucí kateder__, __zaměstnanci__, __kontakt na zaměstnance__, __pozice zaměstnanců__, __tituly__ a další zajímavé informace. </ul>

    - Soubor řešení: [strom.xml](strom.xml)

---

4. Napsat XML soubor `prf.xml`, která bude obsahovat informace o Přírodovědecké fakultě UJEP, nebo soubor s názvem `pf.xml`, která bude obsahovat informace o Pedagogické fakultě UJEP. Tyto soubory musí být dobře formované a musí být soubor validní, splňuje požadavky schématu `fakulta.dtd`

   - Připravený soubor: [fakulta.dtd](fakulta.dtd)
   - Soubor řešení: [prf.xml](prf.xml)

---