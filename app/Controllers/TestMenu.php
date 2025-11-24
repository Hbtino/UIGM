<?php

namespace App\Controllers;

use App\Models\MenuModel;

class TestMenu extends BaseController
{
    public function index()
    {
        $menuModel = new MenuModel();
        $menus = $menuModel->findAll();
        
        echo "<h2>Test Menu Data</h2>";
        echo "<table border='1' cellpadding='5'>";
        echo "<tr><th>ID</th><th>Title</th><th>Type</th><th>Roles</th><th>Can Edit?</th></tr>";
        
        foreach ($menus as $m) {
            $type = $m['menu_type'] ?? 'dashboard';
            $roles = json_decode($m['roles'] ?? '[]', true);
            $canEdit = in_array('admin', $roles) ? 'YES' : 'NO';
            
            echo "<tr>";
            echo "<td>{$m['id']}</td>";
            echo "<td>{$m['title']}</td>";
            echo "<td><strong>{$type}</strong></td>";
            echo "<td>" . implode(', ', $roles) . "</td>";
            echo "<td style='color:" . ($canEdit == 'YES' ? 'green' : 'red') . "'><strong>{$canEdit}</strong></td>";
            echo "</tr>";
        }
        
        echo "</table>";
        
        echo "<hr>";
        echo "<h3>Session Info</h3>";
        echo "Role: " . session()->get('role') . "<br>";
        echo "User ID: " . session()->get('id') . "<br>";
    }
}
