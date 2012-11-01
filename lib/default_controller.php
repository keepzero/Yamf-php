<?php

class Default_Controller {

    var $model;
    
    /**
     * class constructor
     *
     * @access public
     */
    function __construct() {
        app::instance($this, 'controller');
        $this->load = new Loader();
    }
    
    function GET() { }
    
}
