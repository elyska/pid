<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Laravel
Migrace databáze
```bash
php artisan migrate
```
Spuštění lokálního serveru
```bash
php artisan serve
```
## Prodejní místa PID

Po stisknutí tlačítka **Aktualizovat data** aplikace uloží do databáze aktuální data z https://data.pid.cz/pointsOfSale/json/pointsOfSale.json

Po výběru kokrétního data a času a stisknutí tlačítka **Najít prodejní místa** se zobrazí prodejní místa, která jsou otevřena ve vybraný čas.

Po stisknutí tlačítka **Najít nyní otevřená prodejní místa** se zobrazí prodejní místa, která jsou otevřena právě teď.
