<?php
namespace Class\Trait;
trait Debug{
    public function dump(...$values)
    {
        $style =
        "background-color; black;
        color: white;
        width: fit-content;
        padding: 1rem;
        border: 1px solid green;
        margin: 1rem, auto;";
        foreach($values as $v)
        {
            echo "<pre style='$style'>". print_r($v,1)."</pre>";
        }
    }
    public function dd(...$values)
    {
        $this ->dump($values);
        die;
    }
}

?>