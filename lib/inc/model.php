<?php

	class Model {
	
		public $addr;
		public $model;
		public $view;
		
		
		public function minify($model,$view) {
		
			ob_start();
			extract($GLOBALS, EXTR_REFS | EXTR_SKIP);
			
			include($model);
			include($view);
			
			$view = ob_get_contents();
			ob_end_clean();
			
			$view = preg_replace('/\s\s+/', ' ', $view);
			$view = str_replace(array("\n", "\r"), "", $view);
			return $view;
		 
		}
      
		public function getPage($addr) {
			
			$model = "lib/inc/model/".$addr.".php";
			$view = "lib/tpl/".$addr.".tpl";
		
			if ((!file_exists($model)) || (!file_exists($view))) {
				if ($addr != "404") {
					header("Location: /404/");
				}
			} else {
				return $this->minify($model,$view);
			}
			
		}
		
	}
	
?>