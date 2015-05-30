# Ghost

Ghost is a lightweight MVC framework, designed to support the usual needs for web applications. With the Bootstrap
and FontAwesome implementations You can easily create a responsive design for your application. Bootstrap and
FontAwesome docs at [bootstrap](http://getbootstrap.com/) / [fontawesome](http://fortawesome.github.io/Font-Awesome/)

# Getting started

The framework follows the MVC architectural pattern. The MVC files are located within the mvc folder. Each layer has an own
subfolder. The framework contains example files for every layer.

#Controllers:

For structural informations see the example controller file. **Every controller class needs a public Index() function**, it
acts as a constructor. You have access to the basic controller subclasses: load, request, response and user(see below);

LOAD: You can load models using the framework's loader class, using: `$this->load->model('model_name');`
The function will return the requested model class. (Work in progress: It will create a class variable eg.: loading the 
'example' model will create the example_model variable, until then, you have to manually do that).

REQUEST AND RESPONSE: Within the controller class, You have access to the response and request subclasses. The request variable
responsible for handling the GET, POST and SESSION global variables. The response is responsible for creating
the output. You can set the output destination, the headers, or trigger a redirect.

RESPONSE/OUTPUT: `$this->response->SetOutput('output_file.tpl');` this will load the file from the view subdirectory. 
RESPONSE/REDIRECT: `$this->response->redirect('/redirect_destination');`
  
DATA arrays: The data array's elements will be extracted, and You will be able to access them from the View layer.
eg: `$this->data['foo'] = 'bar';` will be accessible in the View layer as $foo;

USER: the user subclass has some predefined functions, such as login and logout, however the subclass will be removed.

#Models:

For structural informations see the example controller file. From the model layer You have access to the
db subclass.

DB: This class is responsible for the safe database connection. The subclass now has two main functions:
`$this->db->Out("SELECT * FROM example");` The Out() function will return either an array containing the result of the query
or false.
`$this->db->In("TRUNCATE TABLE foo");` The In() function is simply runs the query and either return true or false
depending on the query's result;
You can escape variables with the escape(). The $this->db->last_id contains the last inserted row's id value;
The db subclass now runs on mysqli, wich will later be replaced with PDO.

#Views

The framework doesn't has any custom templating language at the moment. You can use both HTML and You have access to
the data variables from the control layers, **apart from that, usage of PHP is not recommended within the View layer**.

**If you have any recommendations please email me at jozsefklemasz@gmail.com. Thank you!**
