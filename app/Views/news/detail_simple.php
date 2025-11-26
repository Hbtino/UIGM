<!DOCTYPE html>
<html>
<head>
    <title>Detail Berita</title>
    <style>
        body { font-family: Arial; padding: 20px; max-width: 800px; margin: 0 auto; }
        h1 { color: #149823ff; }
        .meta { color: #666; margin: 20px 0; }
        .content { line-height: 1.8; }
        .back { display: inline-block; margin-bottom: 20px; padding: 10px 20px; background: #149823ff; color: white; text-decoration: none; border-radius: 5px; }
        .news-image { margin: 20px 0; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .news-image img { width: 100%; height: auto; display: block; }
    </style>
</head>
<body>
    <a href="<?= base_url('/') ?>" class="back">← Kembali ke Beranda</a>
    
    <?php if (!empty($news['image'])): ?>
    <div class="news-image">
        <img src="<?= base_url('uploads/news/' . $news['image']) ?>" alt="<?= esc($news['title']) ?>">
    </div>
    <?php endif; ?>
    
    <h1><?= esc($news['title']) ?></h1>
    
    <div class="meta">
        Tanggal: <?= date('d F Y', strtotime($news['published_at'] ?? $news['created_at'])) ?> | 
        Views: <?= $news['views'] ?>
    </div>
    
    <div class="content">
        <?= $news['content'] ?>
    </div>
</body>
</html>
