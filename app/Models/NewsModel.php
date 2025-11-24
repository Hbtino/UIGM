<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsModel extends Model
{
    protected $table = 'news';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'title',
        'slug',
        'excerpt',
        'content',
        'image',
        'category',
        'is_published',
        'published_at',
        'views',
        'created_by',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps = false;

    public function getPublishedNews($limit = null)
    {
        $builder = $this->where('is_published', 1)
                        ->orderBy('published_at', 'DESC');
        
        if ($limit) {
            $builder->limit($limit);
        }
        
        return $builder->findAll();
    }

    public function getNewsBySlug($slug)
    {
        return $this->where('slug', $slug)->first();
    }

    public function incrementViews($id)
    {
        $this->set('views', 'views+1', false)
             ->where('id', $id)
             ->update();
    }
}
