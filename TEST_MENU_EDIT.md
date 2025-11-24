# Test Menu Edit - Troubleshooting Guide

## Langkah Testing

### 1. Cek Session Role

Buka browser console atau tambahkan di view untuk debug:

```php
<?php
echo "Role: " . session()->get('role');
echo "<br>User ID: " . session()->get('id');
?>
```

### 2. Test URL Langsung

Coba akses langsung di browser:

```
http://localhost:8080/menus/edit/1
http://localhost:8080/menus/edit/2
http://localhost:8080/menus/edit/10
```

### 3. Cek Error Log

Lihat file log CodeIgniter:

```
writable/logs/log-[tanggal].log
```

### 4. Kemungkinan Masalah

#### A. Session Role Bukan Admin

**Gejala**: Redirect ke dashboard dengan pesan "Akses ditolak"

**Solusi**:

- Login ulang sebagai admin
- Cek database tabel `users` kolom `role`
- Pastikan role = 'admin' (lowercase)

#### B. Menu Tidak Ditemukan

**Gejala**: Redirect ke /menus dengan pesan "Menu tidak ditemukan"

**Solusi**:

- Cek ID menu yang diklik
- Cek database tabel `menus` apakah ID tersebut ada

#### C. Error di Query Parent Menus

**Gejala**: Halaman blank atau error 500

**Solusi**: Sudah diperbaiki di controller dengan query yang lebih aman

#### D. Layout Error

**Gejala**: Error "View not found" atau layout rusak

**Solusi**:

- Pastikan file `app/Views/layouts/main.php` ada
- Cek apakah ada error di layout

### 5. Quick Fix - Tambah Debug di Controller

Edit `app/Controllers/CmsController.php` method `editMenu`:

```php
public function editMenu($id)
{
    // DEBUG
    log_message('debug', 'Edit Menu ID: ' . $id);
    log_message('debug', 'User Role: ' . session()->get('role'));

    if (session()->get('role') !== 'admin') {
        log_message('debug', 'Access denied - not admin');
        return redirect()->to('/dashboard')->with('error', 'Akses ditolak. Role: ' . session()->get('role'));
    }

    $menu = $this->menuModel->find($id);
    log_message('debug', 'Menu found: ' . ($menu ? 'Yes' : 'No'));

    if (!$menu) {
        return redirect()->to('/menus')->with('error', 'Menu ID ' . $id . ' tidak ditemukan.');
    }

    $parent_menus = $this->menuModel
        ->where('id !=', $id)
        ->where('parent_id IS NULL')
        ->findAll();

    log_message('debug', 'Parent menus count: ' . count($parent_menus));

    $data = [
        'title' => 'Edit Menu',
        'menu' => $menu,
        'parent_menus' => $parent_menus
    ];

    return view('cms/menus/edit', $data);
}
```

### 6. Test Manual Query

Buka phpMyAdmin dan jalankan:

```sql
-- Cek menu yang ada
SELECT id, title, parent_id FROM menus ORDER BY id;

-- Cek parent menus (untuk edit menu ID 1)
SELECT * FROM menus WHERE id != 1 AND parent_id IS NULL;
```

### 7. Alternative Fix - Simplify Parent Query

Jika masih error, coba query yang lebih sederhana:

```php
// Di controller editMenu
$parent_menus = $this->menuModel
    ->whereIn('id', function($builder) use ($id) {
        return $builder->select('id')
            ->from('menus')
            ->where('id !=', $id)
            ->where('parent_id', null);
    })
    ->findAll();

// Atau lebih sederhana lagi:
$all_menus = $this->menuModel->findAll();
$parent_menus = array_filter($all_menus, function($m) use ($id) {
    return $m['id'] != $id && $m['parent_id'] == null;
});
```

## Hasil yang Diharapkan

Ketika klik tombol edit di `/menus`:

1. ✅ Redirect ke `/menus/edit/{id}`
2. ✅ Halaman form edit muncul
3. ✅ Data menu ter-load di form
4. ✅ Dropdown parent menu terisi
5. ✅ Bisa submit update

## Jika Masih Bermasalah

Tolong berikan informasi:

1. Screenshot error yang muncul
2. URL yang diakses
3. Pesan error (jika ada)
4. Isi file log: `writable/logs/log-[tanggal].log`
5. Role user yang login (admin/reviewer/dosen/kaprodi)
