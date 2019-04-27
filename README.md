# Project name
## Getting Started
This instruction will introduce our project and how deploye in your host

### Team Members and Roles
- Tenzin, Back-end

- LinJian Chen, Database

- Shunyong Weng, Front-end

- Winston Chang, Back-end

### Prerequisites
- An individual host

### Installing
There are __public_html__ directory in repository

1. Download repository Zip
2. Unzip repository
3. Open your individual host
4. If home directory is empty, you can place on home directory
5. If your home directory is not empty, create an directory for hosted
6. Drop and drag all sources from public_html dirctory to your host dirtory(remember the path)
7. Done

### Running the tests
__You can test this project on your host__ 
> following code to open your website
```
http://yourhostname/directoryPath/public_html
```
> In ours site will be

```
http://68.183.120.235/~lxc9094/
```

### Deployment
1. 
In order to deploy our project, you need:
- Apache server
- PHP module
- PHP-Pgsql - Postgres support for PHP
- Postgres server

or
- Local PHP installation
- (Local or Remote) Postgres server

2.
Download the Repository, extract contents of public_html to your public apache folder, or a directory on your disk if you are using a local php setup.

3. Edit the database configuration in <public_html>/assets/php/business/dbinfo.php
4. 
* If using apache, you can access the site @ index.php, or wherever your public files are

Otherwise

* Run php -S localhost:8080 or a port of your choice, within the directory you extracted public_html to


### Built With
* [HTML](https://www.w3schools.com/html/html_intro.asp) - Standard markup language for creating Web pages
* [JavaScript](https://www.w3schools.com/js/) - Hypertext Preprocessor for web development.
* [PHP](https://en.wikipedia.org/wiki/PHP) - Standard markup language for creating Web pages
* [PostgreSQL ](https://www.postgresql.org/) - The World's Most Advanced Open Source Relational Database
* [API]() - The sources of search in our porject

### Help
* We would have a FAQ page listing potential question and answers that a user may have
* A contact page would be available if the FAQ does not satisfy the user's need
  * Questions received from user's may potentially be placed into the FAQ, to aid future users.

