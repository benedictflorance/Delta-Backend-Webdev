# Task Statement

## Normal Mode :

Create a website with the following features :

The website is for sharing code snippets. A snippet is a small file with code that someone might want to share.

Let users register for your website with a form, and have a login. Your forms must not allow SQL Injection.

Once logged in, a user can create new snippets. Have a form for pasting code and creating a new snippet. The user need not upload their file, they can just copy and paste it into an input.

Each snippet should be accessible by some short unique URL that everyone can access. For example, if I make a new snippet, then that would have a associated URL like /2k3nan5. Anyone who visits yourwebsite.com/2k4nan5 should see that snippet. The snippets should be anonymous - you shouldn't see see who posted the snippet with just that URL.

Note: If you're unable to use a route like yourwebsite.com/1n69ak2, you can use a query string parameter, like yourwebsite.com/snippet.php?id=1n69ak2. If you still want to do it the first way in PHP, look into modrewrite.

## Hacker Mode :

Add some more functionality to your website :

Be able to create Public or Private snippets. When the user creates a new one, they can set set whether others can view that snippet (Public) or if it's just for their own reference (Private). If it's a Private snippet, you can't see it unless you are logged in as that user.

Instead of just pasting code, users can also upload code files directly through an upload button.

Have an option to set an expiry date for each post. For example, when you create a new snippet and set the expiry time to tomorrow afternoon, anyone who visits the URL after that shouldn't be able to see the snippet at all.

Include an option to set the syntax language of the new snippet you create. If you upload a new JavaScript file and set the syntax language to JavaScript, one who view's should see the code with syntax highlighting with colors. (There are libraries that do this already, you just have to properly integrate one)

Improve your registration form. Have your username input display whether the new username you're typing is available or take. This must be continuously checked as the user types. Use JavaScript AJAX requests to do this. Additionally, add a Captcha to stop spammers and attackers. You can use a service like Google reCAPTCHA.

Give the user the option to make each snippet anonymous or non-anonymous. If the snippet is not anonymous, people can see the name of the person who created it when they visit that snippet's URL.
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
