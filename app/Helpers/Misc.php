<?php

namespace App\Helpers;

class Misc
{
    /**
     * Compares the page name of a specified one.
     * If they're the same, return ' active'.
     * If not, return blank.
     * Order does not technically matter. The end result is the same.
     *
     * @param  String  $currentPage The current page
     * @param  String  $compareTo   The page name to compare to.
     * @return boolean
     */
    public static function isActive($currentPage, $compareTo)
    {
        if ($currentPage === $compareTo) {
            return 'active';
        }

        return '';
    }
}
