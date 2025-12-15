<?php

/**
 * Chart Display Component
 * Komponen untuk menampilkan chart di dashboard dan landing page
 */
?>

<div class="chart-container" id="chart-container-<?= $chart['id'] ?>">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="fas fa-chart-<?= $chart['chart_type'] === 'line' ? 'line' : ($chart['chart_type'] === 'bar' ? 'bar' : 'pie') ?> mr-2"></i>
                <?= $chart['title'] ?>
            </h5>
            <?php if (!empty($chart['description'])): ?>
                <p class="card-text text-muted small mb-0"><?= $chart['description'] ?></p>
            <?php endif; ?>
        </div>
        <div class="card-body">
            <div class="chart-wrapper" style="position: relative; height: 300px;">
                <canvas id="chart-<?= $chart['id'] ?>"
                    data-chart-type="<?= $chart['chart_type'] ?>"
                    data-chart-data='<?= $chart['chart_data'] ?>'
                    data-chart-config='<?= $chart['chart_config'] ?>'
                    style="max-height: 300px;">
                </canvas>
            </div>

            <?php if ($chart['sync_with_statistics']): ?>
                <div class="mt-2">
                    <small class="text-success">
                        <i class="fas fa-sync-alt"></i>
                        Data otomatis tersinkronisasi dengan database
                    </small>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const canvas = document.getElementById('chart-<?= $chart['id'] ?>');
        if (canvas) {
            const ctx = canvas.getContext('2d');
            const chartType = canvas.dataset.chartType;
            const chartData = JSON.parse(canvas.dataset.chartData || '{}');
            const chartConfig = JSON.parse(canvas.dataset.chartConfig || '{}');

            // Default config
            const defaultConfig = {
                type: chartType,
                data: chartData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: false
                        }
                    }
                }
            };

            // Merge dengan custom config
            const finalConfig = mergeDeep(defaultConfig, {
                options: chartConfig
            });

            // Create chart
            new Chart(ctx, finalConfig);
        }
    });

    // Helper function untuk merge object
    function mergeDeep(target, source) {
        const output = Object.assign({}, target);
        if (isObject(target) && isObject(source)) {
            Object.keys(source).forEach(key => {
                if (isObject(source[key])) {
                    if (!(key in target))
                        Object.assign(output, {
                            [key]: source[key]
                        });
                    else
                        output[key] = mergeDeep(target[key], source[key]);
                } else {
                    Object.assign(output, {
                        [key]: source[key]
                    });
                }
            });
        }
        return output;
    }

    function isObject(item) {
        return (item && typeof item === "object" && !Array.isArray(item));
    }
</script>