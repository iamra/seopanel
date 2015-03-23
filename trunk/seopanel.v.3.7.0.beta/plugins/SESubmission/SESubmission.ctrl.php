<?php
class SESubmission extends SeoPluginsController{
	
	function index() {
		$userId = isLoggedIn();
		
		$this->set('sectionHead', 'Seach Engine Submissions');		
		$this->set('onChange', pluginPOSTMethod('search_form', 'subcontent', 'action=show'));
		
		$this->pluginRender('index');
	}
	
	function show($info, $error=false) {	
		$userId = isLoggedIn();
		$this->set('url', $info['url']);
		$this->set('email', $info['email']);	
		$this->pluginRender('showsiteinfo');
	}	
	
	function submit($info, $error=false) {	
		$userId = isLoggedIn();
		$this->set('url', $info['url']);
		$this->set('email', $info['email']);
		$this->set('selected_engines', $info['selected_engines']);					
		$this->pluginRender('submitprogress');
	}
}