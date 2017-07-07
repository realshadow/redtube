<?php

namespace Realshadow\Redtube\Endpoints;

use GuzzleHttp\Client;
use JMS\Serializer\Serializer;
use Realshadow\Redtube\Entities\Error;
use Realshadow\Redtube\Filters\Filterable;


/**
 * Base endpoint
 *
 * @package Realshadow\Redtube\Endpoints
 * @author Lukáš Homza <lhomza@webland.company>
 */
abstract class AbstractEndpoint
{

    /**
     * Output format (json or xml)
     */
    const OUTPUT_FORMAT = 'xml';

    /**
     * Guzzle client
     *
     * @var Client $client
     */
    private $client;

    /**
     * Serializer instance
     *
     * @var Serializer $serializer
     */
    protected $serializer;

    /**
     * @param Client $client
     * @param Serializer $serializer
     */
    public function __construct(Client $client, Serializer $serializer)
    {
        $this->client = $client;
        $this->serializer = $serializer;
    }

    /**
     * Calls Redtubes API and process the response
     *
     * @param $method
     * @param Filterable|null $filter
     * @param string $format
     *
     * @return string
     * @throws \RuntimeException
     */
    protected function call($method, Filterable $filter = null, $format = self::OUTPUT_FORMAT)
    {
        $query = sprintf('?data=redtube.%s&output=%s', $method, $format);

        # -- this will allows us to expand the method by appending additional query string, e.g. video detail
        if ($filter) {
            $query .= '&' . $filter->compile();
        }

        $response = $this->client->get($query);

        # -- since Redtube always returns HTTP OK we have to check for errors manually
        $body = $response->getBody()->getContents();
        if ($response->getStatusCode() === 200 && strpos($body, 'error')) {
            $error = $this->serializer
                ->deserialize($body, Error::class, self::OUTPUT_FORMAT);

            throw $error->getException();
        }

        return $body;
    }

}
