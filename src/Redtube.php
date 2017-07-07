<?php

namespace Realshadow\Redtube;

use Doctrine\Common\Annotations\AnnotationRegistry;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use JMS\Serializer\Context;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\Handler\HandlerRegistry;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\VisitorInterface;
use Realshadow\Redtube\Endpoints\CategoryEndpoint;
use Realshadow\Redtube\Endpoints\StarEndpoint;
use Realshadow\Redtube\Endpoints\TagEndpoint;
use Realshadow\Redtube\Endpoints\VideoEndpoint;
use Realshadow\Redtube\Entities\Video;
use Realshadow\Redtube\Entities\Videos;


/**
 * Redtube API client
 *
 * @package Realshadow\Redtube
 * @author Lukáš Homza <lhomza@webland.company>
 */
class Redtube
{

    /**
     * Category endpoint
     *
     * @var CategoryEndpoint $categories
     */
    public $categories;

    /**
     * Video endpoint
     *
     * @var VideoEndpoint $videos
     */
    public $videos;

    /**
     * Star endpoint
     *
     * @var StarEndpoint $stars
     */
    public $stars;

    /**
     * Tag endpoint
     *
     * @var TagEndpoint $tags
     */
    public $tags;

    /**
     * Prepare serializer
     *
     * @return \JMS\Serializer\Serializer
     */
    private function prepareSerializer()
    {
        AnnotationRegistry::registerLoader('class_exists');

        $serializer = SerializerBuilder::create()
            ->setDebug(false)
            ->addDefaultHandlers()
            ->addDefaultListeners()
            ->configureHandlers(function (HandlerRegistry $registry) {
                $registry->registerHandler(
                    GraphNavigator::DIRECTION_DESERIALIZATION,
                    Collection::class,
                    'xml',
                    function (VisitorInterface $visitor, $data, array $type, Context $context) {
                        $data = $visitor->visitArray($data, $type, $context);

                        return new Collection($data);
                    }
                );
            });

        return $serializer->build();
    }

    /**
     * Create new Redtube API client
     *
     * @param string $host
     */
    public function __construct($host = 'https://api.redtube.com')
    {
        $client = new Client([
            'base_uri' => $host
        ]);

        $serializer = $this->prepareSerializer();

        $this->categories = new CategoryEndpoint($client, $serializer);
        $this->stars = new StarEndpoint($client, $serializer);
        $this->tags = new TagEndpoint($client, $serializer);
        $this->videos = new VideoEndpoint($client, $serializer);
    }

}
