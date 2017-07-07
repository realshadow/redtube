<?php

namespace Realshadow\Redtube\Exceptions;

/**
 * NoInputParametersSpecified Exception
 *
 * @package Realshadow\Redtube\Exceptions
 * @author Lukáš Homza <lhomza@webland.company>
 */
class NoInputParametersSpecifiedException extends \Exception
{

    /**
     * Redtubes original error code
     *
     * @var int $innerCode
     */
    protected $code = 1003;

}
