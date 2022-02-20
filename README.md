# BSP - Code Compiler

#### Checkout here: http://bspcode.rf.gd

#### Description:

Build your own code compiler from scratch using PHP.

![Demo](./snapshots/ezgif-2-c3d9cd43db.gif)

Languages supported currently:-

- Java
- Python3
- C
- C++

Using the JDoodle API to compile and execute Programs, and php composer to install env-supported dependency (optional to run locally).

The core of the application is just a simple web server (apache) which need PHP to run locally, without needing any package dependencies.
The composer is used just to make it suitable for deployable environment to a server without exposing your secret keys to the public (atleast not in this repo).

- **Step 1**: Get your JDoodle API key from [here.](https://www.jdoodle.com/compiler-api/)

- **Step 2**: In case you use composer to run the project, the `composer.json` file is used to install the dependencies.
  Needed dependencies are:-

  `$ composer require vlucas/phpdotenv`

- **Step 3**: Use above command to install the dependency locally. It is used to load the environment variables from .env to our files using:-

  > getenv() or `$_ENV['clientID']` automatically.

- **Step 4**: After installing dependency, Add a .env file in the root of your project, as shown in .env.example file.
  Then run your index.php file in your browser, there you GO!

In case you don't want to use composer (or don't have composer installed in your machine), you can simply ignore all composer related files to run the project. Directly add your client*id and client_secret in the index.php file by assigning those values to variable data array*.
