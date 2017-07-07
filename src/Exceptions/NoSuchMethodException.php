<?php

namespace Realshadow\Redtube\Exceptions;

/**
 * NoSuchMethod Exception
 *
 * @package Realshadow\Redtube\Exceptions
 * @author Lukáš Homza <lhomza@webland.company>
 */
class NoSuchMethodException extends \Exception
{

    /**
     * Redtubes original error code
     *
     * @var int $innerCode
     */
    protected $code = 1001;

}
