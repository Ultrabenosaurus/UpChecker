<?php

class UpChecker
{

    private $DEFAULTS = array(
        'cache_path' => "./cache/",
        'poll_count' => 5
    );
    private $CONFIG;
    private $CACHE;

    public function __construct( $_options = false )
    {
        $conf = $_options;
        if( false === $conf )
            $this->CONFIG = $this->getDefaults();
        else
            $this->CONFIG = $this->extend( $this->getDefaults(), $conf );

        $this->checkDirs();
        $this->readCache();
    }

    public function poll( $_url = false )
    {
        //
    }

    public function status( $_url )
    {
        //
    }

    public function getDefaults()
    {
        return $this->DEFAULTS;
    }

    public function getConfig()
    {
        return $this->CONFIG;
    }

    private function readCache()
    {
        //
    }

    private function writeCache()
    {
        //
    }

    private function checkDirs( $_path )
    {
        //
    }

    private function isUrl( $_url )
    {
        //
    }

    /**
     * jquery style extend, merges arrays (without errors if the passed values are not arrays)
     * source: http://snipplr.com/view/13913/
     *
     * @return array $extended
     **/
    private function extend() {
        $args = func_get_args();
        $extended = array();
        if(is_array($args) && count($args)) {
            foreach($args as $array) {
                if(is_array($array)) {
                    $extended = array_merge($extended, $array);
                }
            }
        }
        return $extended;
    }

}