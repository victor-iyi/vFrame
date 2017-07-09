# vFrame
### PHP MVC Framework.

*vFrame* is a PHP MVC Framework built to make your life as a developer a lot fun and stress free.

### Getting Started
+ Clone this repository `git clone https://github.com/victor-iyiola/vFrame.git` or download zip into your web server directory (e.g. _htdocs_)
+ Change directory into your project folder `cd path/to/project`
+ Open up the `config.ini` file located at `vFrame/app/libs/config.ini`
+ Change the `project_path` as appropriate and the database configurations.
+ Open up your favorite web browser _(hopefully Google Chrome)_ :) and enter the url `localhost/vFrame/` (depending on your server set up, you might need to change that as appropriate)
+ Voila! Enjoy development

### About MVC Frameworks
*VFrame* is an MVC Framework, meaning the views are seprated from your models and they both go through the controller to pass information back and forth.
MVC (or Model View Controller) is one of the design patterns created by _the Gang of four_.

### Creating Controllers
+ Create a new PHP Class in `vFrame/app/controllers`
+ Naming convention is really important here.
+ It is important your start with UpperCase and every other word starts with an uppercase. All of your controllers must end with the word `Controller` e.g `HomeController`, `AboutController`, `FrequentlyAskedQuestionController`
+ All controllers must extend the super class `Controller` located @ `vFrame/app/core/Controller.php`
+ After extending the `App\Libs\Controller`, you must override the abstract method `index()`