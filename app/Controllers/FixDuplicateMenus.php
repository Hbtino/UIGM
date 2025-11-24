<?php

namespace App\Controllers;

use App\Models\MenuModel;

class FixDuplicateMenus extends BaseController
{
    public function index()
    {
        $menuModel = new MenuModel();
        $db = \Config\Database::connect();
        
        echo "<h2>Fix Duplicate Landing Page Menus</h2>";
        
        // 1. Cek duplikat
        echo "<h3>1. Menu Duplikat yang Ditemukan:</h3>";
        $duplicates = $db->query("
            SELECT title, menu_type, COUNT(*) as jumlah
            FROM menus
            WHERE menu_type = 'landing'
            GROUP BY title, menu_type
            HAVING COUNT(*) > 1
        ")->getResultArray();
        
        if (empty($duplicates)) {
            echo "<p style='color: green;'>✅ Tidak ada menu duplikat!</p>";
        } else {
            echo "<table border='1' cellpadding='5'>";
            echo "<tr><th>Title</th><th>Type</th><th>Jumlah</th></tr>";
            foreach ($duplicates as $d) {
                echo "<tr>";
                echo "<td>{$d['title']}</td>";
                echo "<td>{$d['menu_type']}</td>";
                echo "<td style='color: red;'><strong>{$d['jumlah']}</strong></td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        
        // 2. Detail semua menu landing
        echo "<h3>2. Detail Semua Menu Landing:</h3>";
        $landingMenus = $db->query("
            SELECT id, title, url, menu_type, `order`, created_at
            FROM menus
            WHERE menu_type = 'landing'
            ORDER BY title, id
        ")->getResultArray();
        
        echo "<table border='1' cellpadding='5'>";
        echo "<tr><th>ID</th><th>Title</th><th>URL</th><th>Order</th><th>Created At</th><th>Action</th></tr>";
        
        $prevTitle = '';
        foreach ($landingMenus as $m) {
            $isDuplicate = ($m['title'] === $prevTitle);
            $rowColor = $isDuplicate ? 'background-color: #ffcccc;' : '';
            
            echo "<tr style='{$rowColor}'>";
            echo "<td>{$m['id']}</td>";
            echo "<td><strong>{$m['title']}</strong></td>";
            echo "<td>{$m['url']}</td>";
            echo "<td>{$m['order']}</td>";
            echo "<td>{$m['created_at']}</td>";
            
            if ($isDuplicate) {
                echo "<td><a href='" . base_url('fix-duplicate-menus/delete/' . $m['id']) . "' 
                      onclick='return confirm(\"Hapus menu ID {$m['id']}?\")' 
                      style='color: red; font-weight: bold;'>❌ HAPUS DUPLIKAT</a></td>";
            } else {
                echo "<td style='color: green;'>✅ Keep</td>";
            }
            echo "</tr>";
            
            $prevTitle = $m['title'];
        }
        echo "</table>";
        
        // 3. Tombol auto fix
        if (!empty($duplicates)) {
            echo "<hr>";
            echo "<h3>3. Auto Fix (Hapus Semua Duplikat)</h3>";
            echo "<p>Ini akan menghapus menu duplikat dan hanya menyimpan yang ID paling kecil.</p>";
            echo "<a href='" . base_url('fix-duplicate-menus/auto-fix') . "' 
                  onclick='return confirm(\"Yakin ingin menghapus semua menu duplikat?\")' 
                  style='display: inline-block; padding: 10px 20px; background: red; color: white; text-decoration: none; border-radius: 5px;'>
                  🔧 AUTO FIX SEKARANG
                  </a>";
        }
        
        echo "<hr>";
        echo "<p><a href='" . base_url('menus') . "'>← Kembali ke Manajemen Menu</a></p>";
    }
    
    public function delete($id)
    {
        $menuModel = new MenuModel();
        $menu = $menuModel->find($id);
        
        if ($menu) {
            $menuModel->delete($id);
            return redirect()->to('/fix-duplicate-menus')->with('success', "Menu ID {$id} ({$menu['title']}) berhasil dihapus.");
        }
        
        return redirect()->to('/fix-duplicate-menus')->with('error', 'Menu tidak ditemukan.');
    }
    
    public function autoFix()
    {
        $db = \Config\Database::connect();
        
        // Hapus duplikat, keep yang ID lebih kecil
        $result = $db->query("
            DELETE m1 FROM menus m1
            INNER JOIN menus m2 
            WHERE m1.id > m2.id 
              AND m1.title = m2.title 
              AND m1.menu_type = m2.menu_type
              AND m1.menu_type = 'landing'
        ");
        
        $affectedRows = $db->affectedRows();
        
        return redirect()->to('/fix-duplicate-menus')->with('success', "✅ Berhasil menghapus {$affectedRows} menu duplikat!");
    }
}
