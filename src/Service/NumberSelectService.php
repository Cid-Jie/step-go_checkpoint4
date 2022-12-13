<?php

namespace App\Service;

class NumberSelectService
{
    public static function getChoiceNumber($max) {
        $choices = [];
        for($i = 0; $i <= $max; $i++) {
            $index = $i < 10 ? "0" . $i : $i;
            $choices["{$index}"] = $i;
        }
        return $choices;
    }

}