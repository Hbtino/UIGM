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