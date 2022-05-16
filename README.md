## README ##

The Self-Health web application offers a tool where users can register and report on various aspects on their health on a daily basis.
The application accommodates two types of users: (1) Self registered patient users and (2) administrative users.

The following steps are necessary to get the application up and running:

Application Software:
- Apache Web server 2.4
- PostgreSQL database server - version 11 or greater
- PHP - version 7 or greater
- Smarty Templating Engine - version 3.1.34 or greater
- ImageMagick - version 7 or greater


## How to set up ##

# Web server installation #
    - Install Apache web server and PHP (PHP should be configured to run PHP scripts).
    - Apache needs to have mod_rewrite enabled. 

# PHP needs to support the following: #
    - PostgreSQL support.
    - freetype.
    - cURL
    - imagick (ImageMagick needs to be installed previously). This is used for image manipulation.
    - All other dependencies are managed via composer (getcomposer.org). Composer can be downloaded at getcomposer.org/download 
      [Installation and use of composer is documented from the web site].
        * Install and run composer.phar from the directory of composer.json

# Database configuration #
  - PostgreSQL database is to be used.
  - Database files (with schema and table definitions) are included in the sql directory.
    - Files should be executed in the following order:
      1. app_schema.sql
      2. app_data.sql
      3. permissions.sql
  - Database connection details for the application are included in the DbMapperUtility.php file (in the src direction within the Neptune subfolder).

# Deployment instructions #
  - the content of the html folder needs to be placed into the web server root.
  - All other content is placed in one directory above that.
  - Configuration changes:
    - Config.php (in the src/Neptune directory):
        * $SMARTY_DIR_PREFIX: This is the full path to the directory which contains the web root directory (not the web root directory).
    - health.properties (in the src directory):
        * change property show.error.message.content=false
        * go through the list of properties and change them according to your systems settings.
    - .htacess (in html directory):
        * Modify according to the instructions contained within if you are using http or https.



## Who to talk to ##:

* Randal Neptune
* randalneptune@gmail.com