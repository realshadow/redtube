<?php

namespace Realshadow\Redtube\Entities;

use Illuminate\Support\Collection;
use JMS\Serializer\Annotation as JMS;


/**
 * Stars
 *
 * @package Realshadow\Redtube\Entities
 * @author Lukáš Homza <lhomza@webland.company>
 *
 * @JMS\XmlRoot("stars")
 */
class Stars
{

    /**
     * @var Collection $items
     *
     * @JMS\XmlList(entry="star", inline=true)
     * @JMS\Type("Illuminate\Support\Collection<Realshadow\Redtube\Entities\Star>")
     */
    protected $items;

    /**
     * @return Collection
     */
    public function flatten()
    {
        return $this->items;
    }

}
