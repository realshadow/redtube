<?php

namespace Realshadow\Redtube\Entities;

use JMS\Serializer\Annotation as JMS;


/**
 * Thumbnail
 *
 * @package Realshadow\Redtube\Entities
 * @author Lukáš Homza <lhomza@webland.company>
 */
class Thumbnail
{

    /**
     * @var string $size
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     */
    private $size;

    /**
     * @var int $width
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("integer")
     */
    private $width;

    /**
     * @var int $height
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("integer")
     */
    private $height;

    /**
     * @var string $src
     *
     * @JMS\XmlValue()
     * @JMS\Type("string")
     */
    private $src;

    /**
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @return string
     */
    public function getSrc()
    {
        return $this->src;
    }

}
