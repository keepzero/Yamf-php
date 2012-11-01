<?php

class app {
  
    var $config = null;
    var $urls = null;
    var $controller = null;
    var $action = null;
    
    /**
     * class constructor
     *
     * @access  public
     */    
    public function __construct($urls, $id = 'default') {
        self::instance($this, $id);
        $this->config = 'default';
        $this->urls = $urls;
    }
    
    /**
     * run
     *
     * @param none
     */
    public function run() {
    
        $this->stick($this->urls);
    }
    
    /**
     * stick
     *
     * the main static function of the glue class.
     *
     * @param   array    	$urls  	    The regex-based url to class mapping
     * @throws  Exception               Thrown if corresponding class is not found
     * @throws  Exception               Thrown if no match is found
     * @throws  BadMethodCallException  Thrown if a corresponding GET,POST is not found
     *
     */
    function stick ($urls) {

        $method = strtoupper($_SERVER['REQUEST_METHOD']);
        $path = $_SERVER['REQUEST_URI'];
            
        if(strpos($path, "/index.php") == 0){
            $path = substr($path, 10);
            if(strlen($path) == 0){
                $path = "/";
            }
        }
            
        $found = false;

        krsort($urls);

        foreach ($urls as $regex => $class) {
            $regex = str_replace('/', '\/', $regex);
            $regex = '^' . $regex . '\/?$';
            if (preg_match("/$regex/i", $path, $matches)) {
                $found = true;
                    
                include_once(ROOT_PATH . DS . APP_DIR . DS . "controllers" . DS . $class . "_controller.php");
                    
                if (class_exists($class)) {
                    $obj = new $class;
                    if (method_exists($obj, $method)) {
                        $obj->$method($matches);
                    } else {
                        throw new BadMethodCallException("Method, $method, not supported.");
                    }
                } else {
                    throw new Exception("Class, $class, not found.");
                }
                break;
            }
        }
        if (!$found) {
            throw new Exception("URL, $path, not found.");
        }
    }
    
    /**
     * instance
     *
     * get/set the app object instance(s)
     *
     * @access    public
     * @param   object $new_instance reference to new object instance
     * @param   string $id object instance id
     * @return  object $instance reference to object instance
     */    
    public static function &instance($new_instance=null, $id='default') {
        static $instance = array();
        if(isset($new_instance) && is_object($new_instance))
            $instance[$id] = $new_instance;
        return $instance[$id];
    }
   
}

?>
