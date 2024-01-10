<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Track The Price Of OLX

- [Опис](#description)
- [Сторінки](#pages)
- [Getting Started](#getting-started)

## Опис

  Вітаю, це маленький сервіс для відстежування цін на оголошення з сайту OLX. 

## Сторінки

Для того щоб їм користуватися, терба зареєструватися (тут проста форма  з введенням емейлу, им'ям та паролем)

<img src="./public/img/git-hub/register-page.png" width="1000"/>

  далі підтвердити свій емейл, і після цього сервісом можна користуватися.
  Або якщо ви вже зареєстрованні, то можна просто увійти.

<img src="./public/img/git-hub/login-page.png" width="1000"/>

  Після того як увійшли, або зареєструвалися, можна додати посилання на сторінку з об'явою, і сервіс далі буде слідкувати за зміненням ціни.

<img src="./public/img/git-hub/home-page.png" width="1000"/>  

Якщо ціна змінилася, то на Ваш емейл який Ви вказали при реєстрації, буде відправленно лист, з посиланням на сторінку об'яви, та новою ціною.

## Getting Started

<h2>Version :</h2>
<ul>
    <li>
        <p style="font-size: 20px"> LARAVEL  <span style="color: red">10</span></p>
    </li>
    <li>
        <p style="font-size: 20px"> PHP <span style="color: red">8.2</span></p>
    </li>
    <li>
        <p style="font-size: 20px"> Docker <span style="color: red"> >= 4</span></p>
    </li>
    <li>
        <p style="font-size: 20px"> MySQL <span style="color: red">MariaDB - >= 10.8</span></p>
    </li>
    <li>
        <p style="font-size: 20px"> NPM  <span style="color: red">6.14.14</span></p>
    </li>
    <li>
        <p style="font-size: 20px"> NODE.JS  <span style="color: red">min 14.17.4
    </span></p>
    </li>
</ul>

Качаємо архів. Розпаковуємо в папку, де буде знаходитись проект. Після запускаємо консоль, переходимо в папку з проектом і встановлюємо проект.
Або можна склонувати до себе.

<ul>
    <li>
        <p>Встановлюємо всі бібліотеки для Laravel</p>
    </li>
</ul>

    `composer install`
<ul>
    <li>
        <p>створюєте файл і заповнюєте поля для відправки емейлів, і з'єднання з базою данних</p> 
    </li>
</ul>

    `.env` 
<ul>
    <li>
        <p>Генеруємо ключ</p>
    </li>
</ul>

    `php artisan key:generate`
<ul>
    <li>
        <p>Встановлюємо контейнер з базою данних в Докер</p>
    </li>
</ul>

   `docker-compose up -d`
<ul>
    <li>
        <p>Для перевірки чи запустилася база данних, можна ввести цю команду</p>
    </li>
</ul>

    `docker ps`
<ul>
  <li>
        <p>Встановлюємо таблиці до нашої бази данних</p>
    </li>
</ul>

   `php artisan migrate`
<ul>
    <li>
        <p>Встановлюємо всі js бібліотеки для Laravel</p>
    </li>
 </ul>

   `npm install`
<ul>
  <li>
        <p>Запускаємо наш сервіс</p>
        <p>Далі переходимо в браузер по посиланню данному в консолі</p>
    </li>
</ul>

    `php artisan serv`
<ul>
    <li>
        <p>Запускаємо ще одну консоль, і вній запускаємо crone, який буде слідкувати за зміною ціни в оголошеннях на OLX</p>
    </li>
</ul>

    `php artisan schedule:work`
 



 
 





 
