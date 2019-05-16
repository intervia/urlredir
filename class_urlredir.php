<?php

/**
 * 
 * @name Old URL Redir class (Extracted from WEBvivo framework)
 * @version 1.0.1 (2019-05-16)
 * @author Juan cimadevilla
 * @license MIT
 * @copyright Intervia IT (intervia.com)
 * 
 */


class urlredir
{
    
    /**
     * Class contructor
     */
    public function __construct()
    {
        $this->uri = filter_var(getenv('REQUEST_URI'),FILTER_SANITIZE_STRING);
    }
    
    
    
    
    
    
    /**
     * Search the array for a matching origin 
     * to redirect old pages with a 301 code
     * This clase should be used before sending any headers
     * 
     * @param array $redir Array with (origin page, destination page)
     * @return string Redirected page alias
     */
    public function redirect($redir='',$code='')
    {
        //Redir must be an array
        if (empty($redir) || !is_array($redir)) {
            return false;
        }
        
        $key = $this->lcut($this->uri,"/");
        if (array_key_exists($key,$redir)) {
            $this->redir($redir[$key],$code);
        }
    }
    
    
    
    
    
    
    /**
     * 
     * Redirect to a given URI and type or redirect.
     * This clase should be used before sending any headers
     * 301 permanent, allowing to change from POST to GET (default)
     * 302 temporal, allowing to change from POST to GET
     * 303 Versión current del 302, redirige a otra URI usando GET
     * 308 permanent, NOT allowing to change from POST to GET
     * 307 temporal, NOT allowing to change from POST to GET
     * 
     * @param string $redir var with destination page
     * @return string Redirected page alias
     */
    public function redir($redir="",$code="")
    {
        //Headers already sent
        if (headers_sent()) {
            return "Error: Headers already sent";
        }
        
        //Redir must be supplied
        if (empty($redir)) {
            return "ERROR: You must supply a redir URL";
        }
        
        //Redirect 301 by default
        if (empty($code) ||
           ($code != '301' && 
            $code != '302' && 
            $code != '303' && 
            $code != '307' && 
            $code != '308' )) {
            $code = "301";
        }
        
        //Array of redirect types
        $type['301'] = "301 Moved Permanently";
        $type['302'] = "302 Found";
        $type['303'] = "303 See Other";
        $type['307'] = "307 Temporary Redirect";
        $type['308'] = "308 Permanent Redirect";
        
        //generate http headers
        header("HTTP/1.1 ".$type[$code]);
        header("Location: $redir");
        die();
    }
    
    
    
    
    
    /**
     * 
     * Delete on the left of a string the part 
     * that matches literally with another one.
     * 
     * @param string $str String to cut if there is a match with $cut
     * @param string $cutstr literal string to be cut on the left of the $str
     * @return string result of cutting the matching 
     *                string to the left of $str, with $cut
     */
    public function lcut($str,$cutstr)
    {
        $cut = preg_quote($cutstr, '/');
        return preg_replace("/^$cut/",'',$str);
    }
}