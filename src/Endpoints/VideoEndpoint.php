<?php

namespace Realshadow\Redtube\Endpoints;

use Realshadow\Redtube\Entities\ActiveVideo;
use Realshadow\Redtube\Entities\EmbedVideo;
use Realshadow\Redtube\Entities\Paginator;
use Realshadow\Redtube\Entities\Video;
use Realshadow\Redtube\Filters\VideoFilter;


/**
 * Video Endpoint
 *
 * @package Realshadow\Redtube\Endpoints
 * @author Lukáš Homza <lhomza@webland.company>
 */
class VideoEndpoint extends AbstractEndpoint
{

    /**
     * Deserialize API response into paginator object
     *
     * @param string $response
     * @param VideoFilter $filter
     *
     * @return Paginator
     */
    private function getPaginator($response, VideoFilter $filter)
    {
        /** @var Paginator $paginator */
        $paginator = $this->serializer->deserialize($response, Paginator::class, static::OUTPUT_FORMAT);
        $paginator->setPage($filter->getRequestedPage());

        return $paginator;
    }

    /**
     * Find videos by providing a video filter
     *
     * @param VideoFilter $filter
     *
     * @return Paginator
     * @throws \RuntimeException
     */
    public function findBy(VideoFilter $filter)
    {
        $response = $this->call('Videos.searchVideos', $filter);

        return $this->getPaginator($response, $filter);
    }

    /**
     * Allows to specify how many pages of videos should be called at once
     *
     * It will run in a loop calling page after page until the provided number of pages is met
     *
     * @param VideoFilter $filter
     * @param $pages
     *
     * @return \Generator
     * @throws \RuntimeException
     */
    public function findAllBy(VideoFilter $filter, $pages)
    {
        $currentPage = 1;
        while ($currentPage <= $pages) {
            $paginator = $this->findBy($filter);
            $paginator->setPage($currentPage);

            yield $paginator->items();

            $currentPage++;
        }
    }

    /**
     * Get detail of a video
     *
     * @param $id
     *
     * @return Video
     * @throws \RuntimeException
     */
    public function findById($id)
    {
        $response = $this->call('Videos.getVideoById&video_id=' . $id);

        /** @var Video $video */
        $video = $this->serializer->deserialize($response, Video::class, static::OUTPUT_FORMAT);

        return $video;
    }

    /**
     * Finds out if the video is valid
     *
     * @param $id
     *
     * @return bool
     * @throws \RuntimeException
     */
    public function isActive($id)
    {
        $response = $this->call('Videos.isVideoActive&video_id=' . $id);

        /** @var ActiveVideo $activeVideo */
        $activeVideo = $this->serializer->deserialize($response, ActiveVideo::class, static::OUTPUT_FORMAT);

        return $activeVideo->isActive();
    }

    /**
     * Get the embed code of a video
     *
     * @param $id
     *
     * @return string
     * @throws \RuntimeException
     */
    public function getEmbedCode($id)
    {
        $response = $this->call('Videos.getVideoEmbedCode&video_id=' . $id);

        /** @var EmbedVideo $embedVideo */
        $embedVideo = $this->serializer->deserialize($response, EmbedVideo::class, static::OUTPUT_FORMAT);

        return $embedVideo->getCode();
    }

    /**
     * Find all deleted videos by providing a video filter
     *
     * @param VideoFilter $filter
     *
     * @return Paginator
     * @throws \RuntimeException
     */
    public function findDeletedBy(VideoFilter $filter)
    {
        $response = $this->call('Videos.getDeletedVideos', $filter);

        return $this->getPaginator($response, $filter);
    }

    /**
     * Allows to specify how many pages of deleted videos should be called at once
     *
     * It will run in a loop calling page after page until the provided number of pages is met
     *
     * @param VideoFilter $filter
     * @param $pages
     *
     * @return \Generator
     * @throws \RuntimeException
     */
    public function findAllDeletedBy(VideoFilter $filter, $pages)
    {
        $currentPage = 1;
        while ($currentPage <= $pages) {
            $paginator = $this->findDeletedBy($filter);
            $paginator->setPage($currentPage);

            yield $paginator->items();

            $currentPage++;
        }
    }

}
