<?php
class ConfigEditAppController extends AppController {
	
	public function beforeFilter(){
		
		//Define the layout for edit and display functions
		$this->layout = 'default';
		
		//Auth as you will, eg:
		/*
		if($this->request['controller'] == 'configfiles'){
			if( AuthComponent::user('role') != 'admin' ){
				$this->Session->setFlash(__('Access denied'),'error');
				$this->redirect('/');
			}
		}
		*/
	}
	
}
?>