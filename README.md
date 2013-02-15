# ConfigEdit
- - -

# Intro

Plugin that makes it possible to edit and save .ini config files in the app/Config dir of your application. 
Has syntax check.

# Installation and Setup


(1) Check out a copy of the ConfigEdit CakePHP plugin from the repository using Git :

	git clone http://github.com/stefanvangastel/CakePHP-ConfigEdit.git

or download the archive from Github: 

	https://github.com/stefanvangastel/CakePHP-ConfigEdit/archive/master.zip

You must place the ConfigEdit CakePHP plugin within your CakePHP 2.x app/Plugin directory.

(2) Load the plugin in app/Config/bootstrap.php

	// Load ConfigEdit plugin, with loading routes for short urls
	CakePlugin::load('ConfigEdit');

(3) Optional configuration

(3.1)  Change the Auth settings for the edit and create functions of the plugin.

You can do this in 
	/ConfigEdit/Controller/ConfigEditAppController.php

(5) Visit http://YOUR_URL/config_edit/configfiles/