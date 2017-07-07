<?php

namespace Realshadow\Redtube\Entities;

use JMS\Serializer\Annotation as JMS;


/**
 * Tag
 *
 * @package Realshadow\Redtube\Entities
 * @author Lukáš Homza <lhomza@webland.company>
 */
class Tag
{

    /**
     * @var string $name
     *
     * @JMS\XmlValue()
     * @JMS\Type("string")
     */
    private $name;

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

}
