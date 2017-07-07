<?php

namespace Realshadow\Redtube\Entities;

use JMS\Serializer\Annotation as JMS;


/**
 * Star
 *
 * @package Realshadow\Redtube\Entities
 * @author Lukáš Homza <lhomza@webland.company>
 */
class Star
{

    /**
     * @var string $url
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     */
    private $url;

    /**
     * @var string $thumb
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     */
    private $thumb;

    /**
     * @var string $name
     *
     * @JMS\XmlValue(cdata=true)
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
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getThumb()
    {
        return $this->thumb;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

}
