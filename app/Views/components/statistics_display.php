<?php

/**
 * Statistics Display Component
 * Komponen untuk menampilkan statistik di dashboard dan landing page
 */

$location = $location ?? 'dashboard'; // default location
$section = $section ?? 'default'; // default section
?>

<div class="statistics-container" data-location="<?= $location ?>" data-section="<?= $section ?>">
    <?php if (!empty($statistics)): ?>
        <div class="row">
            <?php foreach ($statistics as $stat): ?>
                <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
                    <div class="card stat-card h-100" style="<?= !empty($stat['color']) ? 'border-left: 4px solid ' . $stat['color'] : '' ?>">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-title text-muted mb-1"><?= $stat['label'] ?></h6>
                                    <h3 class="mb-0 font-weight-bold" style="<?= !empty($stat['color']) ? 'color: ' . $stat['color'] : '' ?>">
                                        <?= is_numeric($stat['value']) ? number_format($stat['value']) : $stat['value'] ?>
                                    </h3>
                                </div>
                                <?php if (!empty($stat['icon'])): ?>
                                    <div class="stat-icon">
                                        <i class="<?= $stat['icon'] ?> fa-2x" style="<?= !empty($stat['color']) ? 'color: ' . $stat['color'] . '30' : 'color: #6c757d30' ?>"></i>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i>
            Belum ada data statistik untuk section ini.
        </div>
    <?php endif; ?>
</div>

<style>
    .stat-card {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        border: 1px solid #e3e6f0;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .stat-icon {
        opacity: 0.7;
    }

    .statistics-container .card-title {
        font-size: 0.875rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .statistics-container h3 {
        font-size: 1.75rem;
    }

    @media (max-width: 768px) {
        .statistics-container h3 {
            font-size: 1.5rem;
        }

        .stat-icon i {
            font-size: 1.5rem !important;
        }
    }
</style>