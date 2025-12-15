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
        'address',
        'phone',
        'email',
        'map_embed',
        'map_latitude',
        'map_longitude',
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
        // Hapus semua data lama dengan section yang sama
        $this->where('section', $section)->delete();

        // Insert data baru
        $data['section'] = $section;
        $data['is_active'] = 1;

        return $this->insert($data);
    }

    /**
     * Update content by section (alternative method)
     */
    public function updateBySectionSafe($section, $data)
    {
        $existing = $this->where('section', $section)
            ->orderBy('id', 'DESC')
            ->first();

        if ($existing) {
            // Update data yang ada
            $result = $this->update($existing['id'], $data);

            // Hapus duplikat lainnya
            $this->where('section', $section)
                ->where('id !=', $existing['id'])
                ->delete();

            return $result;
        } else {
            // Insert data baru
            $data['section'] = $section;
            return $this->insert($data);
        }
    }
}
