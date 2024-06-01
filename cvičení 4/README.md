# 4. Cvičení

0. Setup docker. (root password: root, database: univerzita, user: admin, password: heslo)
    - Docker setup script: [compose.bat](DockerSetup/DatabaseWeb/compose.bat)

---

1. Konfigurační soubory Apache a PHP. Prohlédněte konfigurační soubory, které naleznete v kontejneru php-apache v adresářích /etc/apache2 a v /usr/local/etc/php. V konfiguraci Apache vyhledejte např. DocumentRoot. Konfiguraci PHP vypíšete:
    ```
    php -v
    php -i
    ```
    A běžící procesy zobrazíte příkazem
    ```
    top
    ```
    - Použitý příkaz pro čtení souborů: `cat`
    - *DocumentRoot* se nachází v konfiguračních souborech:
      ```
      /etc/apache2/sites-available/default-ssl.conf
      /etc/apache2/sites-available/000-default.conf
      ```

---

2. Tabulky student a fakulta, případně další (katedra, předmět apod.). Pomocí phpadmin nebo adminer založte v databázi tabulky pro vaše data s odpovídájícími atributy a datovými typy.
    - sql dump: 
```
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `fakulta` (
  `id` int NOT NULL,
  `dekan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `katedra` (
  `id` int NOT NULL,
  `fakulta_id` int DEFAULT NULL,
  `zkratka_katedry` text NOT NULL,
  `webove_stranky` varchar(255) DEFAULT 'https://www.ujep.cz/cs/'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `predmet` (
  `id` int NOT NULL,
  `katedra_id` int DEFAULT NULL,
  `zkratka` text NOT NULL,
  `typ` enum('přednáška','seminář','cvičení','kombinované') DEFAULT 'kombinované',
  `nazev` text NOT NULL,
  `popis` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `student` (
  `jmeno` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `prijmeni` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `stid` int NOT NULL,
  `email` text,
  `fakulta_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `vedouci` (
  `id` int NOT NULL,
  `katedra_id` int DEFAULT NULL,
  `jmeno` text NOT NULL,
  `telefon` text,
  `email` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `zamestnanec` (
  `id` int NOT NULL,
  `katedra_id` int DEFAULT NULL,
  `jmeno` text NOT NULL,
  `telefon` text,
  `email` text,
  `pozice` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


ALTER TABLE `fakulta`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `katedra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fakulta_id` (`fakulta_id`);

ALTER TABLE `predmet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `katedra_id` (`katedra_id`);

ALTER TABLE `student`
  ADD PRIMARY KEY (`stid`),
  ADD KEY `fakulta_id` (`fakulta_id`);

ALTER TABLE `vedouci`
  ADD PRIMARY KEY (`id`),
  ADD KEY `katedra_id` (`katedra_id`);

ALTER TABLE `zamestnanec`
  ADD PRIMARY KEY (`id`),
  ADD KEY `katedra_id` (`katedra_id`);


ALTER TABLE `fakulta`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `katedra`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `predmet`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `vedouci`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `zamestnanec`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;


ALTER TABLE `katedra`
  ADD CONSTRAINT `katedra_ibfk_1` FOREIGN KEY (`fakulta_id`) REFERENCES `fakulta` (`id`);

ALTER TABLE `predmet`
  ADD CONSTRAINT `predmet_ibfk_1` FOREIGN KEY (`katedra_id`) REFERENCES `katedra` (`id`);

ALTER TABLE `student`
  ADD CONSTRAINT `fakulta_id` FOREIGN KEY (`fakulta_id`) REFERENCES `fakulta` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `vedouci`
  ADD CONSTRAINT `vedouci_ibfk_1` FOREIGN KEY (`katedra_id`) REFERENCES `katedra` (`id`);

ALTER TABLE `zamestnanec`
  ADD CONSTRAINT `zamestnanec_ibfk_1` FOREIGN KEY (`katedra_id`) REFERENCES `katedra` (`id`);
```
---

3. Pomocí phpadmin nebo adminer naplňte vytvořené tabulky testovacími daty o studentech a fakultách.
```
INSERT INTO `fakulta`(`id`, `dekan`) VALUES ('1','Michal Varady');
INSERT INTO `katedra`(`id`, `fakulta_id`, `zkratka_katedry`) VALUES ('1','1','PRF');
INSERT INTO `vedouci`(`id`, `katedra_id`, `jmeno`, `telefon`, `email`) VALUES ('1','1','Jiří Škvor','420 475 286 711','Jiri.Skvor@ujep.cz');
INSERT INTO `zamestnanec`(`id`, `katedra_id`, `jmeno`, `telefon`, `email`, `pozice`) VALUES ('1','1','Pavel Beránek','420 475 286 723','Pavel.Beranek@ujep.cz','odbotrný_assistent');
INSERT INTO `predmet`(`id`, `katedra_id`, `zkratka`, `typ`, `nazev`, `popis`) VALUES ('1','1','APR1','kombinované','Programovani 1','Jak se má programovat pt.1');

INSERT INTO `student`(`jmeno`, `prijmeni`, `stid`, `email`, `fakulta_id`) VALUES ('Pavel','Kuzma','22127','kuzmapav@gmail','1');
```
---

4. Strukturu tabulek a vložená data vyexportujte jako SQL soubor. Ten si uložte, budete ho potřebovat pro obnovení dat, vždy, když smažete a znovu vytvoříte Docker kontejner.
    - sql soubor: [univerzita.sql](DockerSetup/DatabaseWeb/schema/univerzita.sql)
---

5. V příkazovém řádku v kontejneru php-apache si vyzkoušejte připojení databáze.
    ```
    php -a
    php > mysqli_connect("database","admin","heslo","univerzita");
    php > new mysqli("database","admin","heslo","univerzita");
    ```

    - vyzkoušeno! `print_r(mysqli_connect("database", "admin", "heslo", "univerzita"));`
