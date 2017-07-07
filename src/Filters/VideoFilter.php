<?php

namespace Realshadow\Redtube\Filters;

use Realshadow\Redtube\Enumerators\Thumbsize;
use Realshadow\Redtube\Enumerators\OrderBy;
use Realshadow\Redtube\Enumerators\Period;


/**
 * Video Filter
 *
 * @package Realshadow\Redtube\Filters
 * @author Lukáš Homza <lhomza@webland.company>
 */
class VideoFilter implements Filterable
{

    /**
     * Page that should be pulled
     *
     * @var int $page
     */
    private $page = 1;

    /**
     * Query string that should be searched for
     *
     * @var string $search
     */
    private $search;

    /**
     * Category the videos should belong to
     *
     * @var string $category
     */
    private $category;

    /**
     * List of tags
     *
     * @var array $tags
     */
    private $tags = [];

    /**
     * List of stars
     *
     * @var array $stars
     */
    private $stars = [];

    /**
     * Thumbsize
     *
     * @var string $thumbsize
     */
    private $thumbsize;

    /**
     * Order by
     *
     * @var string $orderBy
     */
    private $orderBy = OrderBy::NEWEST;

    /**
     * Period of creation
     *
     * @var string $period
     */
    private $period = Period::ALL_TIME;

    /**
     * Create new filter instance
     *
     * @return static
     */
    public static function create()
    {
        return new static;
    }

    /**
     * Search by provided string
     *
     * @param $search
     *
     * @return $this
     */
    public function search($search)
    {
        $this->search = $search;

        return $this;
    }

    /**
     * Filter results by provided page (works like limit)
     *
     * @param $page
     *
     * @return $this
     */
    public function page($page)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get requested page
     *
     * Used mostly internally
     *
     * @return int
     */
    public function getRequestedPage()
    {
        return $this->page;
    }

    /**
     * Category the videos should belong to
     *
     * @param $category
     *
     * @return $this
     */
    public function category($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Filter by provided list of tags
     *
     * @param array $tags
     *
     * @return $this
     */
    public function tags(array $tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Filter by provided list of stars
     *
     * @param array $stars
     *
     * @return $this
     */
    public function stars(array $stars)
    {
        $this->stars = $stars;

        return $this;
    }

    /**
     * Get only provided thumbsizes
     *
     * @param $thumbsize
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function thumbsize($thumbsize)
    {
        if ( ! Thumbsize::isValid($thumbsize)) {
            throw new \InvalidArgumentException('Unsupported thumbsize value "' . $thumbsize . '".');
        }

        $this->thumbsize = $thumbsize;

        return $this;
    }

    /**
     * Order result by
     *
     * @param $orderBy
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function orderBy($orderBy)
    {
        if ( ! OrderBy::isValid($orderBy)) {
            throw new \InvalidArgumentException('Unsupported orderBy value "' . $orderBy . '".');
        }

        $this->orderBy = $orderBy;

        return $this;
    }

    /**
     * Get only vidoes created during provided period
     *
     * @param $period
     *
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function period($period)
    {
        if ( ! Period::isValid($period)) {
            throw new \InvalidArgumentException('Unsupported period value "' . $period . '".');
        }

        $this->period = $period;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function compile()
    {
        return http_build_query(get_object_vars($this));
    }

}
