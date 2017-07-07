<?php

namespace Realshadow\Redtube\Entities;

use Illuminate\Support\Collection;
use JMS\Serializer\Annotation as JMS;


/**
 * Class Category
 *
 * @package Realshadow\Redtube\Entities
 * @author Lukáš Homza <lhomza@webland.company>
 *
 * @JMS\XmlRoot("tags")
 */
class Tags
{

    /**
     * @var Collection $items
     *
     * @JMS\XmlList(entry="tag", inline=true)
     * @JMS\Type("Illuminate\Support\Collection<Realshadow\Redtube\Entities\Tag>")
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
