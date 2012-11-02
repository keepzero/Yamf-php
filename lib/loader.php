<?php

class Loader {

    /**
     * class constructor
     *
     * @access  public
     */
    function __construct() { }
    
    /**
     * model
     *
     * load a model object
     *
     * @access  public
     * @param   string $model_name the name of the model class
     * @param   string $model_alias the property name alias
     * @param   string $filename the filename
     * @param   string $pool_name the database pool name to use
     * @return  boolean
     */    
    public function model($model_name,$model_alias=null,$filename=null,$pool_name=null) {

        /* if no alias, use the model name */
        if(!isset($model_alias))
            $model_alias = $model_name;
            
        if(empty($model_alias))  
            throw new Exception("Model name cannot be empty");
    
        if(!preg_match('!^[a-zA-Z][a-zA-Z0-9_]+$!',$model_alias))
            throw new Exception("Model name '{$model_alias}' is an invalid syntax");
      
        if(method_exists($this,$model_alias))
            throw new Exception("Model name '{$model_alias}' is an invalid (reserved) name");

        /* if no filename, use the lower-case model name */
        if(!isset($filename)) {
            $filename = strtolower($model_name) . '.php';
        }
        include(MOD_PATH . DS . $filename);
        
        /* get instance of controller object */
        $controller = app::instance(null,'controller');
    
        /* model already loaded? silently skip */
        if(isset($controller->$model_alias))
            return true;
    
        /* instantiate the object as a property */
        $controller->$model_alias = new $model_name();
    
        return true;
      
    }
}

?>
