<?php

namespace Realshadow\Redtube\Entities;

use Illuminate\Support\Collection;
use JMS\Serializer\Annotation as JMS;


/**
 * Active Video
 *
 * @package Realshadow\Redtube\Entities
 * @author Lukáš Homza <lhomza@webland.company>
 *
 * @JMS\XmlRoot("active")
 */
class ActiveVideo
{

    /**
     * @var string $id
     *
     * @JMS\XmlElement()
     * @JMS\Type("integer")
     * @JMS\SerializedName("video_id")
     */
    protected $id;

    /**
     * @var boolean $active
     *
     * @JMS\XmlElement()
     * @JMS\Type("boolean")
     * @JMS\SerializedName("is_active")
     */
    protected $active;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->active;
    }

}
