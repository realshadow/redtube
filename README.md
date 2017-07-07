# Redtube API

PHP based API wrapper for [Redtube HTTP API](http://api.redtube.com/docs) .

All methods except `getStarDetailedList` are supported. This method at the time of writing always ends with an *There are no stars!* error.

## Installation

```
composer require realshadow/redtube-api
```

## Usage

Every method returns either a concrete object representing the response or collection of objects. Methods used for filtering videos return a `Paginator` object
which contains all videos and basic informating about paging (current page, total count, last page, etc.).

```
// Create new API client (default host points to https://api.redtube.com)
$redtube = new \Realshadow\Redtube\Redtube;

/**
 * Get all categories
 *
 * @return Collection<Category>
 */
$redtube->categories->all();

/**
 * Get all stars
 *
 * @return Collection<Star>
 */
$redtube->stars->getAll();

/**
 * Get all tags
 *
 * @return Collection<Tag>
 */
$redtube->tags->getAll();

/**
 * Find videos
 *
 * @return Paginator
 */
$redtube->videos->findBy($filter);

/**
 * Find video by its ID
 *
 * @return Video
 */
$redtube->videos->findById($id);

/**
 * Find out if a video is active
 *
 * @return bool
 */
$redtube->videos->isActive($id);

/**
 * Get embed code of a video
 *
 * @return string
 */
$redtube->videos->getEmbedCode(2258659);

/**
 * Find deleted videos
 *
 * @return Paginator
 */
$redtube->videos->findDeletedBy($filter);
```

### Video filter

Videos can be filtered by using the `VideoFilter` class which provides fluent interface. You can use one of three enumerators to ease filtering - `Period`, `OrderBy`, `Thumbsize`.

**Note:** Redtube does not use traditional *limit/offset* queries but filtering by **page**. Each page contains 20 results.

For example

```
$filter = VideoFilter::create()
    ->page(1)
    ->search('lesbian')
    ->tags(['blonde'])
    ->stars(['Jenna Jameson'])
    ->thumbsize(Thumbsize::BIG)
    ->period(Period::ALL_TIME)
    ->orderBy(OrderBy::RATING);

$videos = $redtube->videos->findBy($filter);
```

### Get all active / deleted videos

If you want to retrieve more than one page (more than 20 videos) at once you can use these methods

```
/**
 * Find all videos up to 10th page
 *
 * @return Generator
 */
$redtube->videos->findAllBy($filter, 10);

/**
 * Find deleted videos up to the 10th page
 *
 * @return Generator
 */
$redtube->videos->findAllDeletedBy($filter, 10);
```

Both methods return a [generator](http://php.net/manual/en/language.generators.overview.php) after each page is requested to ease memory allocation.
So the full usage example would be

```
foreach ($redtube->videos->findAllBy($filter, 10) as $videos) {
    /** @var Illuminate\Support\Collection $videos */

    $videos->each(function (Video $video) {
        // rest of the code
    });
}
```

### Exceptions

All of the error codes listed in documentation are transformed into PHP exceptions by using this mapping

 - error code *1001* => `NoSuchMethodException`
 - error code *1002* => `NoSuchDataProviderException`
 - error code *1003* => `NoInputParametersSpecifiedException`
 - rest of the error codes will use `NotFoundException` with appropiate message

For example

```
try {
    $videos = $redtube->videos->findBy($filter);
} catch (NotFoundException $e) {

}
```
