<?php

namespace App\Models\Listings;

use App\Models\User;
use App\Modules\Status\Status;
use App\Modules\Status\StatusOptions;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use \Rinvex\Attributes\Traits\Attributable;
use App\Modules\FileManager\Files;

/**
 * Class Listing
 * @property integer $user_id
 * @property integer $category_id
 * @property integer $status
 * @property string $title
 * @property string $slug
 * @property User $user
 * @property ListingCategory $category
 * @package App
 */
class Listing extends Model
{
    use Attributable;
    use Sluggable;
    use Status;
    use Files;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * @return StatusOptions
     */
    public function getStatusOptions(): StatusOptions
    {
        return new StatusOptions('status');
    }

    /**
     * @var string
     */
    protected $table = 'listing';

    /**
     * @var array
     */
    protected $fillable = ['title', 'category_id', 'user_id', 'status'];

    /**
     * @var array
     */
    protected $with = ['eav'];

    protected $attributes = [
        'status' => 1
    ];

    /**
     * @return string
     */
    public function getFilesDirectory(): string
    {
        return $this->user->getFilesDirectory();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function category()
    {
        return $this->hasOne(ListingCategory::class, 'id', 'category_id');
    }

    public function rooms()
    {
        return $this->hasMany(Room::class, 'listing_id', 'id');
    }

    /**
     * @return string
     */
    public function getPoster()
    {
        $url = asset('/images/post-0.jpg');
        $files = $this->files();
        if ($files && $file = $files->first()) {
            $url = asset(sprintf('%s%s', '/storage/', $file->url));
        }

        return $url;
    }

    /**
     * @return int
     */
    public function getPrice()
    {
        return 20;
    }

    /**
     * @return float
     */
    public function getRating()
    {
        return 4.7;
    }

    /**
     * @return int
     * @throws \Exception
     */
    public function getCountComments()
    {
        return random_int(0, 1000);
    }

}
