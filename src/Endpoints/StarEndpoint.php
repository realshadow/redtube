<?php

namespace Realshadow\Redtube\Endpoints;

use Illuminate\Support\Collection;
use Realshadow\Redtube\Entities\Stars;


/**
 * Star Endpoint
 *
 * @package Realshadow\Redtube\Endpoints
 * @author Lukáš Homza <lhomza@webland.company>
 */
class StarEndpoint extends AbstractEndpoint
{

    /**
     * Get all stars
     *
     * @return Collection
     * @throws \RuntimeException
     */
    public function getAll()
    {
        $response = $this->call('Stars.getStarList');

        return $this->serializer
            ->deserialize($response, Stars::class, static::OUTPUT_FORMAT)
            ->flatten();
    }

    /**
     * At the time of writing this (07.07.2017) this method always ends with "There are no stars!" error
     *
     * @throws \BadMethodCallException
     */
    public function getAllDetailed()
    {
        throw new \BadMethodCallException('This method is not yet implemented.');
    }

}
