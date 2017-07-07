<?php

namespace Realshadow\Redtube\Entities;

use Illuminate\Support\Collection;
use JMS\Serializer\Annotation as JMS;


/**
 * Categories
 *
 * @package Realshadow\Redtube\Entities
 * @author Lukáš Homza <lhomza@webland.company>
 *
 * @JMS\XmlRoot("categories")
 */
class Categories
{

    /**
     * @var Collection $items
     *
     * @JMS\XmlList(entry="category", inline=true)
     * @JMS\Type("Illuminate\Support\Collection<Realshadow\Redtube\Entities\Category>")
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
