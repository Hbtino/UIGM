<?php

namespace App\Models;

use CodeIgniter\Model;

class LandingContentModel extends Model
{
    protected $table = 'landing_contents';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'section',
        'title',
        'subtitle',
        'content',
        'image',
        'button_text',
        'button_url',
        'order',
        'is_active',
        'created_at',
        'updated_at'
    ];
    
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    
    /**
     * Get content by section
     */
    public function getBySection($section)
    {
        return $this->where('section', $section)
                    ->where('is_active', 1)
                    ->first();
    }
    
    /**
     * Get all active contents
     */
    public function getActiveContents()
    {
        return $this->where('is_active', 1)
                    ->orderBy('order', 'ASC')
                    ->findAll();
    }
    
    /**
     * Update or create content by section
     */
    public function updateBySection($section, $data)
    {
        $existing = $this->where('section', $section)->first();
        
        if ($existing) {
            return $this->update($existing['id'], $data);
        } else {
            $data['section'] = $section;
            return $this->insert($data);
        }
    }
}
