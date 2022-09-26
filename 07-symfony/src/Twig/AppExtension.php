<?php
namespace App\Twig;

use phpDocumentor\Reflection\Types\AbstractList;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function getFilters():array
    {
        return[
            new TwigFilter("price", [$this,"formatPrice"], [
                "is_safe"=>["html"]  
              ])
        ];
    }
    public function getFunctions()
    {
        return[
            new TwigFunction("area", [$this,"calculateArea"])
        ];
    }
    public function calculateArea( int $width,int $lenght): int{
        return $width*$lenght;
    }
    public function formatPrice(
        float| int $number,
        string $sign = "€",
        bool $before = true,
        string $decPoint = ",",
        string $thousandsSep = " ",
        int $decimals = 0
    ): string
    {
        $price = number_format($number, $decimals, $decPoint, $thousandsSep);
        if($before)$price = "<sup>$sign</Sup>" . $price;
        else $price .= "<sup>$sign</Sup>";
        return $price;
    }
}
?>