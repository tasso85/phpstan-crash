<?php
abstract class Loader {
	private function _register($prepend) {
		return spl_autoload_register([$this, 'load'], true, $prepend);
	}

	public function registerFirst() {
		return $this->_register(true);
	}

	public function register() {
		return $this->_register(false);
	}
	
	abstract protected function load($class);
}

class ClassMap_Loader extends Loader {
	protected function load($class) {
		if($class === 'Autoloaded_Class') {
			require_once __DIR__."/phpstan_class.php";
		}
	}
}

$loader = new ClassMap_Loader();
$loader->register();
