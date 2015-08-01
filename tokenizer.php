<?php

class Tokenizer
{
    private $_patterns = array();
    private $_length = 0;
    private $_tokens = array();
    private $_delimeter = '';
    private $_last_error = '';
    
    public function __construct($delimeter = "#")
    {
        $this->_delimeter = $delimeter;
    }
    /** 
    * Add a regular expression to the Tokenizer
    *
    * @param string $name name of the token
    * @param string $pattern the regular expression to match
    */
    public function add($name, $pattern)
    {
        $this->_patterns[$this->_length]['name'] = $name;
        $this->_patterns[$this->_length]['regex'] = $pattern;
        $this->_length++;
    }
    /** 
    * Tokenizes a reference to an input string, 
    * removing matches from the beginning of the string
     * 
    * @param string &$input the input string to tokenize
     * 
     *@return boolean|string returns the matched token on success, boolean false on failure
    */
    public function tokenize(&$input)
    {
        for($i = 0; $i < $this->_length; $i++)
        {
            if(@preg_match($this->_patterns[$i]['regex'], $input, $matches))
            {
                
   
                $this->_tokens[] = array('name' => $this->_patterns[$i]['name'],
                                         'token' => $matches[0]);
                
                //remove last found token from the $input string
                //we use preg_quote to escape any regular expression characters in the matched input
                $input = trim(preg_replace($this->_delimeter."^".preg_quote($matches[0], $this->_delimeter).$this->_delimeter, "", $input));
                return $matches[0];
            }
            elseif(preg_match($this->_patterns[$i]['regex'], $input, $matches) === false)
            {
                    $this->_last_error = 'Error occured at $_patterns['.$i.']';
                    return false;
            }
        }
        return false;
    }
    public function __get($item)
    {
        switch($item){
            case 'tokens':
                return $this->_tokens;
            case 'last_error':
                return $this->_last_error;
        }
    }
} 




