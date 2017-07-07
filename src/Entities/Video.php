<?php

namespace Realshadow\Redtube\Entities;

use Illuminate\Support\Collection;
use JMS\Serializer\Annotation as JMS;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\JsonDeserializationVisitor;


/**
 * Video
 *
 * @package Realshadow\Redtube\Entities
 * @author Lukáš Homza <lhomza@webland.company>
 *
 * @JMS\XmlRoot("video")
 */
class Video
{

    /**
     * @var int $id
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("integer")
     * @JMS\SerializedName("video_id")
     */
    private $id;

    /**
     * @var string $duration
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("duration")
     */
    private $duration;

    /**
     * @var int $views
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("integer")
     * @JMS\SerializedName("views")
     */
    private $views;

    /**
     * @var int $rating
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("double")
     * @JMS\SerializedName("rating")
     */
    private $rating;

    /**
     * @var int $ratings
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("integer")
     * @JMS\SerializedName("ratings")
     */
    private $ratings;

    /**
     * @var string $url
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("url")
     */
    private $url;

    /**
     * @var string $embedUrl
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("embed_url")
     */
    private $embedUrl;

    /**
     * @var null|\DateTimeImmutable $publishDate
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("publish_date")
     */
    private $publishDate;

    /**
     * @var string $title
     *
     * @JMS\XmlElement(cdata=true)
     * @JMS\Type("string")
     * @JMS\SerializedName("title")
     */
    private $title;

    /**
     * @var string $thumb
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("thumb")
     */
    private $thumb;

    /**
     * @var string $defaultThumb
     *
     * @JMS\XmlAttribute()
     * @JMS\Type("string")
     * @JMS\SerializedName("default_thumb")
     */
    private $defaultThumb;

    /**
     * @var Collection $tags
     *
     * @JMS\Type("Realshadow\Redtube\Entities\Tags")
     * @JMS\SerializedName("tags")
     */
    private $tags;

    /**
     * @var Collection $stars
     *
     * @JMS\Type("Realshadow\Redtube\Entities\Stars")
     * @JMS\SerializedName("stars")
     */
    private $stars;

    /**
     * @var Collection $thumbnails
     *
     * @JMS\Type("Realshadow\Redtube\Entities\Thumbnails")
     * @JMS\SerializedName("thumbs")
     */
    private $thumbnails;

    /**
     * Normalizes nested data
     *
     * @JMS\PostDeserialize()
     */
    public function onPostDeserialize()
    {
        $this->publishDate = $this->publishDate !== '' ? new \DateTime($this->publishDate) : null;
        $this->tags = $this->tags ? $this->tags->flatten() : new Collection;
        $this->stars = $this->stars ? $this->stars->flatten() : new Collection;
        $this->thumbnails = $this->thumbnails ? $this->thumbnails->flatten() : new Collection;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @return int
     */
    public function getViews()
    {
        return $this->views;
    }

    /**
     * @return int
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @return int
     */
    public function getRatings()
    {
        return $this->ratings;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getEmbedUrl()
    {
        return $this->embedUrl;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getPublishDate()
    {
        return $this->publishDate;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getThumb()
    {
        return $this->thumb;
    }

    /**
     * @return string
     */
    public function getDefaultThumb()
    {
        return $this->defaultThumb;
    }

    /**
     * @return Collection
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @return Collection
     */
    public function getStars()
    {
        return $this->stars;
    }

    /**
     * @return Collection
     */
    public function getThumbnails()
    {
        return $this->thumbnails;
    }

}
