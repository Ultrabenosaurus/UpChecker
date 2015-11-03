<?php

class UpChecker
{

    private $DEFAULTS = array(
        'cache_path' => "cache/.cache",
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
        if( file_exists( $this->CONFIG['cache_path'] ) )
            $this->CACHE = json_decode( file_get_contents( $this->CONFIG['cache_path'] ), true );
    }

    private function writeCache()
    {
        file_put_contents( $this->CONFIG['cache_path'], json_encode( $this->CACHE ) );
    }

    /**
     * Make sure the directory we're logging to exists.
     *
     * @param string $_path The path we want to log to.
     */
    private function checkDirs( $_path )
    {
        if( !is_dir( $_path ) )
        {
            $dirs = explode( "/", $_path );
            if( "" == trim( $dirs[ 0 ] ) ) array_shift( $dirs );
            if( "" == trim( $dirs[ ( count( $dirs ) - 1 ) ] ) ) array_pop( $dirs );
            $path = $dirs[ 0 ];
            $c = count( $dirs );
            for( $i = 1; $i <= $c; $i++ )
            {
                if( !file_exists( $path ) )
                    mkdir( $path );
                if( $i < $c )
                    $path .= "/" . $dirs[ $i ];
            }
            unset( $dirs );
            unset( $path );
            unset( $c );
        }
    }

    /**
     * Check if the given string is a valid URL
     *
     * This is just a pattern-match to see if it fits the format of a URL, there
     * is no verification as to whether or not the URL exists.
     *
     * @param string $_url The string to test for URL validity
     *
     * @return boolean
     */
    private function isUrl( $_url )
    {
        if( is_string( $_url ) && preg_match( "/^http[s]?:\/\/[a-zA-Z\-]*[\.a-zA-Z\-]+\.[a-zA-Z]{2,3}[\.a-zA-Z]*[\/]?.*$/", $_url ) > 0 )
        {
            return true;
        }
        return false;
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