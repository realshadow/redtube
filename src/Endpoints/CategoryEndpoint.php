<?php

namespace Realshadow\Redtube\Endpoints;

use Illuminate\Support\Collection;
use Realshadow\Redtube\Entities\Categories;


/**
 * Category Endpoint
 *
 * @package Realshadow\Redtube\Endpoints
 * @author Lukáš Homza <lhomza@webland.company>
 */
class CategoryEndpoint extends AbstractEndpoint
{

    /**
     * Get all categories
     *
     * @return Collection
     * @throws \RuntimeException
     */
    public function getAll()
    {
        $response = $this->call('Categories.getCategoriesList');

        return $this->serializer
            ->deserialize($response, Categories::class, static::OUTPUT_FORMAT)
            ->flatten();
    }
    
}
