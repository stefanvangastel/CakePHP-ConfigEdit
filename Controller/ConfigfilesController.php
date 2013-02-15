<?php
class ConfigfilesController extends ConfigEditAppController {
	
	public $helpers = array('Form','Session','Html');

	public function beforeRender(){
		parent::beforeRender();
	}
	
		
	/**
	 * Index function, show all config files
	 */
	public function index(){

		//Find all config files (.ini) in app/Config
		$configdir = APP.'Config'.DS;

		$configfiles = array();

		foreach (glob("$configdir*.ini") as $filename) {
		   
		   	$file = array();
			$file['filename'] 		= str_replace($configdir, '', $filename);
			$file['path'] 			= $filename;
		    $file['modified'] 		= filemtime($filename);
		    $file['syntaxcheck']	= parse_ini_file($filename,true);

		    $configfiles[] = $file;
		}

		//Find all pages
		$this->set('configfiles',$configfiles);
	}
	
	/**
	 * Edit function, also serves as index function (create, edit and delete from this page
	 */
	public function edit($path = null) {
		
		//Decode the path
		$path = base64_decode($path);

		//Prep var
		$configfile = array();

		if ($this->request->is('post') || $this->request->is('put')){
		
			//Syntax checken en saven
			if( isset( $this->request->data['Configfileholder']['contents'] ) ){

				//Check the content with the ini reader
				App::uses('String', 'Utility'); //Use the string util
				$fileid = String::uuid(); //Generate random code

				//Write to tmp file
				if( file_put_contents(APP.'tmp'.DS.$fileid, $this->request->data['Configfileholder']['contents']) ){

					//Check the syntax:
					if( @parse_ini_file(APP.'tmp'.DS.$fileid) ){ //Ignore errors. Give true or false!

						//Remove tmp file
						unlink(APP.'tmp'.DS.$fileid);

						//Save the file
						if( file_put_contents($path, $this->request->data['Configfileholder']['contents']) ){

							//DONE! Redirect to index
							$this->Session->setFlash(__('Configfile saved'),'success');
							$this->redirect('index');

						}else{
							//Cant write file
							$this->Session->setFlash(__('Can\'t write config file'),'error');
						}

					}else{

						//Set for return
						$configfile['syntaxcheck']	= false;

						//Remove tmp file
						unlink(APP.'tmp'.DS.$fileid);

						//Cant write file
						$this->Session->setFlash(__('File syntax is incorrect. Please fix it.'),'error');
					}

				}else{
					//Cant write file
					$this->Session->setFlash(__('Can\'t write temp file to check syntax'),'error');
				}

			}else{
				//No content found
				$this->Session->setFlash(__('No file content submitted'),'error');
			}

			//Set data

		}

		//Get file
		if( ! file_exists($path) OR $path == null){
			$this->Session->setFlash(__('Error reading file: %s',$path),'error');
			$this->redirect($this->referer());
		}

		//Prepare var to give to view
		$configfile['modified'] 	= filemtime($path);
		$configfile['filename']		= str_replace(APP.'Config'.DS, '', $path);
		
		//Set syntax status if not set
		if( ! isset($configfile['syntaxcheck']) ){
			$configfile['syntaxcheck']	= parse_ini_file($path,true);
		}

		//Content depends on action
		if ($this->request->is('post') || $this->request->is('put')){
			$configfile['contents'] 	= $this->request->data['Configfileholder']['contents'];
		}else{
			//Not submitted
			$configfile['contents'] 	= file_get_contents($path);
		}
		

		//Check file length and max chars in line
		$configfile['cols'] = 50; //default
		
		//Explode on linebreaks
		$lines = explode("\n", $configfile['contents']);
		
		//Loop
		foreach($lines as $line){
			if(strlen($line) > $configfile['cols']){
				$configfile['cols'] = strlen($line);
			}
		}
		$this->set('configfile',$configfile);
	}
		
	/*
	 * Function to display the contents of a configfile
	 */
	public function view($path = null) {
		
		$path = base64_decode($path);

		if( ! file_exists($path) OR $path == null){
			$this->Session->setFlash(__('Error reading file: %s',$path),'error');
			$this->redirect($this->referer());
		}

		$configfile = array();
		$configfile['contents'] 	= file_get_contents($path);
		$configfile['modified'] 	= filemtime($path);
		$configfile['filename']		= str_replace(APP.'Config'.DS, '', $path);
		$configfile['syntaxcheck']	= parse_ini_file($path,true);

		$this->set('configfile',$configfile);
	}
}
?>