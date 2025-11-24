<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table = 'menus';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'parent_id',
        'title',
        'url',
        'icon',
        'order',
        'is_active',
        'roles',
        'menu_type',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps = false;

    public function getActiveMenus($menuType = null)
    {
        $builder = $this->where('is_active', 1);
        
        if ($menuType) {
            $builder->where('menu_type', $menuType);
        }
        
        return $builder->orderBy('order', 'ASC')->findAll();
    }

    public function getMenuTree($menuType = null)
    {
        $menus = $this->getActiveMenus($menuType);
        $tree = [];

        foreach ($menus as $menu) {
            if ($menu['parent_id'] === null) {
                $menu['children'] = $this->getChildren($menu['id'], $menus);
                $tree[] = $menu;
            }
        }

        return $tree;
    }
    
    private function getChildren($parentId, $allMenus)
    {
        $children = [];
        foreach ($allMenus as $menu) {
            if ($menu['parent_id'] == $parentId) {
                $children[] = $menu;
            }
        }
        return $children;
    }
    
    public function getDashboardMenus()
    {
        return $this->getMenuTree('dashboard');
    }
    
    public function getLandingMenus()
    {
        return $this->getMenuTree('landing');
    }
}
