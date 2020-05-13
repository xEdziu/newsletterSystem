# newsletterSystem

An example of newsletter system for your website.

It is written in objective PHP which uses MySQLi instead of PDO.

newsletterSystem is using a PHPMailer-5.2-stable version, documentation here: [PHPMailer](https://github.com/PHPMailer/PHPMailer/tree/5.2-stable).

Some files contains a ready PHPMailer function which is prepared to send email.

Files in newsletterSystem are predicted to use AJAX or jQuery.

It can be easily used and some files are using [sweetAlert2](https://sweetalert2.github.io/) library for fancy alerts.

Remeber that it's only backend (server site).

Feel free to use it :)

## Files

newsletterSystem files are divided into four categories:

#### Global

* ```config.php```

#### User

* ```newsletter_signup.php```

* ```newsletter_signout.php```

#### Server\Admin

* ```index.php```
  + ```login_admin.html```
  + ```login_admin.php```

* ```logs_newsletter.php```

* ```send_mass.php```
  + ```send_massXO.php```

#### Database

* ```admin_users.sql```

* ```news_messeages.sql```

* ```news_subscribe.sql```

## Relations between files

Most of the files are strictly connected to each other while others work independetly.

* ```config.php``` is used in every file.

* ```index.php``` is a file that redirects user to ```login_admin.html```. It's preventing site from crashing eg. while typing ```example.com/admin``` instead of ```example.com/admin/login_admin.html```.

* ```login_admin.html``` is the one and only html, which uses ```login_admin.php``` to log in.

* ```newsletter_signup.php``` and ```newsletter_signup.php``` are individual files for signing in and out from your newsletter.

* ```logs_newsletter.php``` is a file that displays all messeages that you've sent.

* ```send_mass.php``` is a file with form to send emails to all your subscribers. It is maintained by ```send_massXO.php```.

## Setting up ```config.php```

This file contains:

```php
<?php
  $dbserver = "";
  $dbuser = "";
  $dbpass = "";
  $dbname = "";

  $link = new mysqli($dbserver, $dbuser, $dbpass, $dbname);
  if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
  }

$serwer_smtp = "";
$port_smtp = 465;

$smtplog = '';
$smtppass = '';

?>
```
* To connect to your database you must fill 4 first lines with suitable data.

* ```$serwer_smtp``` - (SMTP Server/Host) and ```$port_smtp``` are used in PHPMailer. Fulfill with suitable data.

* ```$smtplog``` - (email) and ```$smtppass``` are used to connect to sender email.

## Database

To make newsletter work, you will need to create 3 tables in your database.

**1. ```admin_users```**

  * This table is responsible for keeping admin's logins and passwords.
  
  ```sql
  CREATE TABLE `admin_users` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `login` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

  ALTER TABLE `admin_users`
    ADD PRIMARY KEY (`id`);
  COMMIT;
  ```

**2. ```news_messeages```**

  * This table is responsible for keeping all messeages that have been sent.

  ```sql
  CREATE TABLE `news_messeages` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(2000) NOT NULL,
  `body` varchar(2000) NOT NULL,
  `date` date NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;


  ALTER TABLE `news_messeages`
    ADD PRIMARY KEY (`id`);
  COMMIT;
  ```

**3. ```news_subscribe```**

  * This table is responsible for keeping emails of users which are signed into your newsletter.

  ```sql
  CREATE TABLE `news_subscribe` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

  ALTER TABLE `news_subscribe`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `unique` (`email`);
  COMMIT;
  ```

## Vulnerabilities

There is no security in the admin login page. You have to set up your own password hashing and adapt it.

## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## Contact

You can contact me via email: 
<adrian.goral@gmail.com>

## License
[MIT](https://choosealicense.com/licenses/mit/)


