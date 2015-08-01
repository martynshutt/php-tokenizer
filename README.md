# tokenizer V1.0.0

##Basic usage

```php
include 'tokenizer.php';

$tokenizer = new Tokenizer();

$tokenizer->add("NUMBER", "/^[0-9]+/");
$tokenizer->add("VARIABLE", "/^%[a-zA-Z]+/");
$tokenizer->add("EQUALS", "/^=/");
$tokenizer->add("NAME", "/^[a-zA-Z]+/");

$input = '%var mynum = 99';

while($result = $tokenizer->tokenize($input)){
    
    echo $result."<br />";
    
}
echo "<pre>";
print_r($tokenizer->tokens);
echo "</pre>";
```