<?php

namespace Realshadow\Redtube\Enumerators;

use MyCLabs\Enum\Enum;


/**
 * OrderBy Enumerator
 *
 * @package Realshadow\Redtube\Enumerators
 * @author Lukáš Homza <lhomza@webland.company>
 */
final class OrderBy extends Enum
{

    const NEWEST = 'newest';
    const MOST_VIEWED = 'mostviewed';
    const RATING = 'rating';

}
