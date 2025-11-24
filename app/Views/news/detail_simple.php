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
    </style>
</head>
<body>
    <a href="<?= base_url('/') ?>" class="back">← Kembali ke Beranda</a>
    
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
