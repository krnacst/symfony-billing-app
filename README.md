Symfony számlázás applikáció
========================

Ez a web alkalmazás egy felvételi feladat keretein belül jött létre. Három oldal található az alkalmazásban a `Számlázási címeim`, `Megrendelés` és `Megrendelések listázása`. Az első oldalon létre lehet hozni új számlázási címet, ezt lehet módosítani valamint törölni is. A második oldalon lehet a már meglévő számlázási címre rendelni de itt létre lehet hozni új számlázási címet is amit a rendszer lement a számlázási címek közé. A harmadik, egyben utolsó oldalon csak egy egyszerű lista található a megrendelésekről.

Futtatáshoz szükséges:
-
  * PHP 7
  * Composer
  * Symfony CLI
  * MySQL szerver

Telepítése:
-
  1. Alkalmazás letöltése GitHub-ról
  2. Kicsomagolás
  3. A kicsomagolt mappában `app/config/parameters.yml`-ben adatok megadása: szerver címe, adatbázis neve, felhasználónév, jelszó
  4. Ezután indítunk a mappában egy parancssort és elindítjuk a symfony webszervert `symfony server:start`
  5. Létrehozzuk az adatbázist: `php bin/console doctrine:database:create`
  6. Létrehozzuk a táblákat: `php bin/console doctrine:schema:update --force
`
  7. Megnyitjuk böngészőben: `localhost:8000`

Készítette: Krnács Tamás
