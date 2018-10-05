<?php

include 'tokenizer.php';

$tokenizer = new Tokenizer();

//nowdoc syntax so we don't have to escape quote marks, forwardslashes or forwardreferences
$strings = <<<'SCRIPT'
/^("|')(\\?.)*?\1/     
SCRIPT
;

$comment = <<<'SCRIPT'
/^\/\*.*\*\//     
SCRIPT
;

$tokenizer->add("NUMBER", "/^[0-9]+/");
$tokenizer->add("STRING", $strings);
$tokenizer->add("VARIABLE", "/^%[a-zA-Z]+/");
$tokenizer->add("EQUALS", "/^=/");
$tokenizer->add("LOGIC", "/^(==|&&|\|\|)/");
$tokenizer->add("OPEN BLOCK", "/^{/");
$tokenizer->add("CLOSE BLOCK", "/^}/");
$tokenizer->add("OPEN BRACKET", "/^\(/");
$tokenizer->add("CLOSE BRACKET", "/^\)/");
$tokenizer->add("CONTROL-FLOW STATEMENT", "/^(IF|ELSE|WHERE|FOR)/");
$tokenizer->add("COMMENT", $comment);
$tokenizer->add("NAME", "/^[a-zA-Z]+/");

$input = '%var string = "I am a string" %var Num = 99'
        . 'if(string || num){ /*I am a comment...*/ }';

while(($result = $tokenizer->tokenize($input)) !== false){
    
    echo $result."<br />";
    
}
echo $tokenizer->last_error;

echo "<pre>";
print_r($tokenizer->tokens);
echo "</pre>";
