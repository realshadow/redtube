<?php

namespace Realshadow\Redtube\Enumerators;

use MyCLabs\Enum\Enum;


/**
 * Period Enumerator
 *
 * @package Realshadow\Redtube\Enumerators
 * @author Lukáš Homza <lhomza@webland.company>
 */
final class Period extends Enum
{

    const WEEKLY = 'weekly';
    const MONTHLY = 'monthly';
    const ALL_TIME = 'alltime';

}
