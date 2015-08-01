#tokenizer V1.0.0

This is a simple class that allows you to extract tokens from a string using regular expressions.
Define your patterns using the add() method, and then extract the tokens with tokenize().
The tokenizer class also generates an array of tokens, identifying the name and value of each token.
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

This creates the following output;

```
%var
mynum
=
99

Array
(
    [0] => Array
        (
            [name] => VARIABLE
            [token] => %var
        )

    [1] => Array
        (
            [name] => NAME
            [token] => mynum
        )

    [2] => Array
        (
            [name] => EQUALS
            [token] => =
        )

    [3] => Array
        (
            [name] => NUMBER
            [token] => 99
        )

)
```