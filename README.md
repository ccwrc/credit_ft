
First enter "composer install" in the command line.
#
To run unit tests:  
./vendor/bin/phpunit
               
To run behat test:  
./vendor/bin/behat

> Poniżej treść zadania.

> Proszę o napisanie testów automatycznych oraz jednej klasy, której odpowiedzialnością jest księgowanie 
> obciążeń, uznań i rozliczeń dla pożyczki. Rozliczenie następuje gdy pojawi się uznanie (np. wpłata od
> klienta) i to uznanie przeznaczamy na pokrycie obciążenia. Rodzaje obciążeń: kapitał, prowizja, 
> odsetki kapitałowe. Rodzaje uznań: wpłata od klienta. Kolejność rozliczeń: odsetki kapitałowe, 
> prowizja, kapitał.

> Przykład:
> Klient składa wniosek o pożyczkę na 1700zł z prowizją w wysokości 466,65 zł. Wysokość odsetek 
> naliczanych dziennie to 0,45zł. Klient wpłaca kwotę w wysokości 1000zł w 3 dniu pożyczki. 
> Zatem ksiegowanie i rozliczenie wpłaty dla tej pożyczki będzie następujące:

> 1. Kapitał 1700 zł, data naliczenia 01.01.2018
> 2. Prowizja 466,65 zł, data naliczenia 01.01.2018
> 3. Odsetki kapitałowe 0,45 zł, data naliczenia 02.01.2018
> 4. Odsetki kapitałowe 0,45 zł, data naliczenia 03.01.2018
> 5. Wpłata 1000 zł, data naliczenia 03.01.2018
> 6. Rozliczenie odsetki kapitałowe 0,45 zł, data rozliczenia 03.01.2018
> 7. Rozliczenie odsetki kapitałowe 0,45 zł, data rozliczenia 03.01.2018
> 8. Rozliczenie prowizja 466,65 zł, data rozliczenia 03.01.2018
> 9. Rozliczenie kapitał 532,45 zł, data rozliczenia 03.01.2018
> 10. Odsetki kapitałowe 0,45 zł, data naliczenia 04.01.2018 (saldo 1168)

