<?php

class AssocArr
{
    private $arr = [];
    // check if key starts with get/set/has/uns
    // https://stackoverflow.com/questions/2790899/how-to-check-if-a-string-starts-with-a-specified-string/20419264
    public function __call($key, $values)
    {   $startsWith = substr($key, 0, 3);
        $key = substr($key, 3);
        $values = implode(',', $values);

        if ($startsWith == "set") {
            $this->arr[$key] = $values;
        }
        elseif ($startsWith == "get") {
            return $this->arr[$key];
        }
        // https://www.php.net/manual/en/function.array-key-exists.php
        elseif ($startsWith == "has") {
            return array_key_exists($key, $this->arr) ? 'true' : 'false';
        }
        // https://www.php.net/manual/en/function.unset.php
        elseif ($startsWith == "uns") {
            unset( $this->arr[$key]);
        } else {
            throw new Exception('Ooops please try again');
        }

    }
}

$a = new AssocArr();

try {
    $a->setName('name', 'Irena');
    // var_dump($a);
    echo $a->getName();
    echo '<br/>';
    echo $a->hasName();
    echo '<br/>';
    echo $a->unsName();
    //  $a->test();
} catch ( Exception $e )
{
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}







