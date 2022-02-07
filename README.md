# Code Compiler

Build your own code compiler from scratch using PHP.

Languages supported currently:-

- Java
- Python3
- C
- C++

Using the JDoodle API to compile code, and php composer to install dependencies required.

The core of the application is just a simple web server which need PHP to run locall, without needing any package dependencies.
The composer is used just to make it deployable environment to a server without exposing your secret keys to the public (atleast not in this repo).

In case you use composer to run the project, the composer.json file is used to install the dependencies.
Needed dependencies are:-

- vlucas/phpdotenv

Use >> composer require vlucas/phpdotenv << to install the dependency.

Loads environment variables from .env to getenv(), $\_ENV and $\_SERVER automagically.

After installing dependency, Add a .env file in the root of your project, as shown in .env.example file.
Then run your index.php file in your browser, there you GO!

In case you dont want to use composer (or don't have composer installed in your machine), you can simply ignore all composer related files to run the project.
Directly add your client_id and client_secret in the index.php file.
