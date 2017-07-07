<?php

namespace Realshadow\Redtube\Entities;

use Illuminate\Support\Collection;
use JMS\Serializer\Annotation as JMS;


/**
 * Embed Video
 *
 * @package Realshadow\Redtube\Entities
 * @author Lukáš Homza <lhomza@webland.company>
 *
 * @JMS\XmlRoot("embed")
 */
class EmbedVideo
{

    /**
     * @var string $code
     *
     * @JMS\XmlElement()
     * @JMS\Type("string")
     * @JMS\SerializedName("code")
     */
    protected $code;

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

}
