# Instructions to run the files

1. Install and setup WAMP Server
2. Create MySQL Account with username "root" and password "phpiscool"
3. Create a database named "pastebin"
4. Type the following MySQL commands:
```
CREATE TABLE `snippet` (
  `id` int(11) PRIMARY NOT NULL,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `public` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `anonymous` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiry` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filename` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `users` (
  `id` int(11) PRIMARY NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(100) UNIQUE COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```
5. Put the .htaccess file from this repo in the www directory
6. Create a folder called deltatask inside www directory
7. Put all other php and css files from this repo into this deltatask directory
