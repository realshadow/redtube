<?php

namespace Realshadow\Redtube\Exceptions;

/**
 * NoSuchDataProvider Exception
 *
 * @package Realshadow\Redtube\Exceptions
 * @author Lukáš Homza <lhomza@webland.company>
 */
class NoSuchDataProviderException extends \Exception
{

    /**
     * Redtubes original error code
     *
     * @var int $innerCode
     */
    protected $code = 1002;

}
