# Project3

Add an API layer on top of the authentication code from Project #2.  No longer will we use the PHP/HTML forms for
capturing user input.  This project has two main components.  First, re-create the login form using JavaScript/HTML/CSS only. The login form page should only take
a username and password as user input.  Second, re-factor the PHP code into a REST API only endpoint.  Below is a simple list of more requirements:

* You can *only* use jQuery
* You can use PHP Slim micro-framework for the REST API
* You can 3rd party plugins or libraries via Composer and Bower (**10**)
* All page styling has to be done with JavaScript/CSS/HTML (**20**)
* Ensure you code this project loosely-coupled
* Must authenticate using an AJAX call to your newly coded API (**20**)
* PHP API must be a REST compliant web service (**20**)
* This is a team project, collaborations within the team, no collaborations outside the team. All team members but be committing to GitHub. (**10**)
* **EXTRA CREDIT**: Create a user registration form in JavaScript and a corresponding web service endpoint for
registration. (**20**)
* **80** points possible

# Composer
run 
```
php composer.phar install
```