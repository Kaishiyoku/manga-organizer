[![Build Status](https://travis-ci.org/Kaishiyoku/manga-organizer.svg?branch=master)](https://travis-ci.org/Kaishiyoku/manga-organizer)

<img align="right" src="https://i.imgur.com/p8UGVQb.jpg" alt="Astolfo"/>

Table of contents
=================
* [About](#about)
* [Features](#features)
* [Installaion](#installation)
* [Screenshots](#screenshots)
* [License](#license)
* [Author](#author)

About
=====
**A self-hostable, simple web service to keep track of your owned mangas.**

Features
========
* manga list with owned volumes and specials
* plain text list for data saving / fast loading times while being at a convention for example
* people can recommend you new mangas
* statistics about how many mangas and volumes you own
* MyAnimeList-related data on your manga list (e.g. score, cover image)
* mark mangas as completed

Installation
============
1. Download the latest release: https://github.com/Kaishiyoku/manga-organizer/releases/latest
2. run `composer install --no-dev --no-scripts`
3. run `php artisan migrate`
4. run `php artisan make:user`
5. run `npm install`
6. run `npm run prod`
7. copy the .env.example file and fill in the necessary values:  
   ```@php -r \"file_exists('.env') || copy('.env.example', '.env');\"```

If you want to use the MAL API fetching automatism you have to setup a cronjob:
```
$ sudo crontab -e -u www-data
```

Add the cronjob (please adjust the path if necessary):
```
* * * * * php /var/www/html/manga-organizter/artisan schedule:run >> /var/www/html/manga-organizer/storage/logs/scheduler.log 2>&1
```

Screenshots
===========
![Manga list](https://i.imgur.com/ZXY1GpV.png)

![Edit manga](https://i.imgur.com/0JhKzTK.png)

![Plain text list](https://i.imgur.com/XORokMA.png)

License
=======
MIT (https://github.com/Kaishiyoku/manga-organizer/blob/master/LICENSE)


Author
======
Twitter: [@kaishiyoku](https://twitter.com/kaishiyoku)  
Website: www.andreas-wiedel.de  
MAL: [kaishiyoku](https://myanimelist.net/profile/Kaishiyoku)
