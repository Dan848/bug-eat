<?php

    function strCutter ($string, $length)
    {
        $cuttedString = strlen($string) > $length ? substr($string, 0, $length) . '...' : $string;
        return $cuttedString;
    };
