# Setup Berita Publik (Tanpa Login)

## ✅ Yang Sudah Dibuat

1. ✅ **Controller**: `app/Controllers/News.php`
2. ✅ **Routes**: `/news` dan `/news/{slug}` (tanpa auth)
3. ✅ **Home Controller**: Sudah ambil 3 berita terbaru

## 📋 Yang Perlu Dibuat Manual

### 1. Buat Folder
```
app/Views/news/
```

### 2. File: `app/Views/news/index.php`

```php
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?> - GreenMetric Polban</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .header { background: linear-gradient(135deg, #149823ff, #0b5804ff); padding: 20px 0; color: white; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .news-card { transition: transform 0.3s, box-shadow 0.3s; border: none; border-radius: 10px; overflow: hidden; height: 100%; }
        .news-card:hover { transform: translateY(-5px); box-shadow: 0 10px 30px rgba(0,0,0,0.15); }
        .news-img { height: 200px; object-fit: cover; width: 100%; }
        .news-category { background: #149823ff; color: white; padding: 5px 15px; border-radius: 20px; font-size: 12px; display: inline-block; }
        .card-title { color: #2c3e50; font-weight: 600; }
        .card-text { color: #7f8c8d; }
    </style>
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0"><i class="fas fa-newspaper"></i> <?= esc($title) ?></h2>
                <a href="<?= base_url('/') ?>" class="btn btn-light"><i class="fas fa-home"></i> Beranda</a>
            </div>
        </div>
    </header>

    <div class="container my-5">
        <?php if (!empty($news)): ?>
            <div class="row g-4">
                <?php foreach ($news as $item): ?>
                    <div class="col-md-4">
                        <a href="<?= base_url('news/' . $item['slug']) ?>" class="text-decoration-none">
                            <div class="card news-card shadow-sm">
                                <?php if (!empty($item['image'])): ?>
                                    <img src="<?= base_url('uploads/news/' . $item['image']) ?>" 
                                         class="news-img" alt="<?= esc($item['title']) ?>">
                                <?php else: ?>
                                    <div class="news-img bg-secondary d-flex align-items-center justify-content-center">
                                        <i class="fas fa-newspaper fa-3x text-white"></i>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="card-body">
                                    <h5 class="card-title"><?= esc($item['title']) ?></h5>
                                    <p class="card-text small">
                                        <?= esc(substr(strip_tags($item['excerpt'] ?? $item['content']), 0, 100)) ?>...
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <small class="text-muted">
                                            <i class="fas fa-calendar"></i>
                                            <?= date('d M Y', strtotime($item['published_at'] ?? $item['created_at'])) ?>
                                        </small>
                                        <span class="news-category"><?= esc($item['category'] ?? 'Berita') ?></span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Pagination -->
            <div class="mt-5 d-flex justify-content-center">
                <?= $pager->links() ?>
            </div>
        <?php else: ?>
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle fa-2x mb-3"></i>
                <h5>Belum ada berita yang dipublikasikan</h5>
                <p>Silakan kembali lagi nanti</p>
            </div>
        <?php endif; ?>
    </div>

    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container text-center">
            <p class="mb-0">© 2024 GreenMetric Polban. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
```

### 3. File: `app/Views/news/detail.php`

```php
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($news['title']) ?> - GreenMetric Polban</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.8; }
        .header { background: linear-gradient(135deg, #149823ff, #0b5804ff); padding: 20px 0; color: white; }
        .news-meta { color: #7f8c8d; font-size: 14px; margin-bottom: 30px; }
        .news-content { font-size: 16px; color: #2c3e50; }
        .news-content img { max-width: 100%; height: auto; margin: 20px 0; }
        .related-card { transition: transform 0.3s; }
        .related-card:hover { transform: translateY(-5px); }
    </style>
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="d-flex gap-2">
                <a href="<?= base_url('/') ?>" class="btn btn-light btn-sm"><i class="fas fa-home"></i> Beranda</a>
                <a href="<?= base_url('news') ?>" class="btn btn-light btn-sm"><i class="fas fa-newspaper"></i> Semua Berita</a>
            </div>
        </div>
    </header>

    <div class="container my-5">
        <article>
            <!-- Category Badge -->
            <span class="badge bg-success mb-3"><?= esc($news['category'] ?? 'Berita') ?></span>
            
            <!-- Title -->
            <h1 class="mb-3"><?= esc($news['title']) ?></h1>
            
            <!-- Meta Info -->
            <div class="news-meta mb-4">
                <i class="fas fa-calendar"></i> <?= date('d F Y', strtotime($news['published_at'] ?? $news['created_at'])) ?> | 
                <i class="fas fa-eye"></i> <?= number_format($news['views']) ?> views
            </div>

            <!-- Featured Image -->
            <?php if (!empty($news['image'])): ?>
                <img src="<?= base_url('uploads/news/' . $news['image']) ?>" 
                     class="img-fluid rounded shadow-sm mb-4" 
                     alt="<?= esc($news['title']) ?>">
            <?php endif; ?>

            <!-- Content -->
            <div class="news-content">
                <?= $news['content'] ?>
            </div>
        </article>

        <!-- Related News -->
        <?php if (!empty($relatedNews)): ?>
            <hr class="my-5">
            <h3 class="mb-4">Berita Terkait</h3>
            <div class="row g-4">
                <?php foreach ($relatedNews as $related): ?>
                    <div class="col-md-4">
                        <a href="<?= base_url('news/' . $related['slug']) ?>" class="text-decoration-none">
                            <div class="card related-card shadow-sm">
                                <?php if (!empty($related['image'])): ?>
                                    <img src="<?= base_url('uploads/news/' . $related['image']) ?>" 
                                         class="card-img-top" style="height: 150px; object-fit: cover;" 
                                         alt="<?= esc($related['title']) ?>">
                                <?php endif; ?>
                                <div class="card-body">
                                    <h6 class="card-title text-dark"><?= esc($related['title']) ?></h6>
                                    <small class="text-muted">
                                        <?= date('d M Y', strtotime($related['published_at'] ?? $related['created_at'])) ?>
                                    </small>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container text-center">
            <p class="mb-0">© 2024 GreenMetric Polban. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
```

### 4. Update `app/Views/home.php`

Cari section berita dan update card agar bisa diklik:

```php
<!-- Wrap card dengan link -->
<a href="<?= base_url('news/' . $item['slug']) ?>" class="text-decoration-none">
    <div class="card h-100 shadow-sm" style="transition: transform 0.3s; cursor: pointer;">
        <!-- isi card -->
    </div>
</a>

<!-- Tambah tombol "Lihat Semua" setelah loop -->
<div class="text-center mt-4">
    <a href="<?= base_url('news') ?>" class="btn btn-lg" style="background: linear-gradient(135deg, #149823ff, #0b5804ff); color: white;">
        <i class="fas fa-newspaper"></i> Lihat Semua Berita
    </a>
</div>
```

## 🎯 Cara Kerja

1. **Landing Page** (`/`) - Tampil 3 berita terbaru
2. **Klik berita** → Redirect ke `/news/{slug}` (detail berita)
3. **Klik "Lihat Semua"** → Redirect ke `/news` (list semua berita)
4. **Semua orang bisa akses** - Tidak perlu login!

## ✨ Fitur

- ✅ List berita dengan pagination
- ✅ Detail berita dengan view counter
- ✅ Berita terkait (same category)
- ✅ Responsive design
- ✅ Public access (no auth)
- ✅ Reviewer, dosen, semua bisa baca

## 🚀 Test

1. Buat folder `app/Views/news/`
2. Copy paste kode di atas ke `index.php` dan `detail.php`
3. Update `home.php` untuk tambah link
4. Test:
   - `/` - Landing page dengan 3 berita
   - `/news` - List semua berita
   - `/news/slug-berita` - Detail berita

Selesai! 🎉
