<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Flowchart Test' ?></title>
    <script src="https://cdn.jsdelivr.net/npm/mermaid@<?= $mermaid_version ?? '10.6.1' ?>/dist/mermaid.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@<?= $bootstrap_version ?? '5.3.0' ?>/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .debug-info {
            background: #e9ecef;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-family: monospace;
        }

        .mermaid {
            background: white;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #dee2e6;
            margin: 20px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>🧪 Flowchart Test & Debug</h1>

        <div class="debug-info">
            <strong>Debug Info:</strong><br>
            Mermaid Version: <?= $mermaid_version ?? 'Unknown' ?><br>
            Bootstrap Version: <?= $bootstrap_version ?? 'Unknown' ?><br>
            Current Time: <?= date('Y-m-d H:i:s') ?><br>
            Base URL: <?= base_url() ?>
        </div>

        <div class="alert alert-info">
            <strong>Status:</strong> Testing Mermaid.js rendering...
        </div>

        <div id="chart-container">
            <div class="mermaid">
                flowchart TD
                A[Start] --> B{Test?}
                B -->|Yes| C[Success!]
                B -->|No| D[Error]
                C --> E[End]
                D --> E
            </div>
        </div>

        <div class="mt-4">
            <a href="<?= base_url('flowchart') ?>" class="btn btn-primary">Full Flowchart</a>
            <a href="<?= base_url('flowchart-simple.html') ?>" class="btn btn-secondary">Simple Version</a>
            <a href="<?= base_url('dashboard') ?>" class="btn btn-success">Dashboard</a>
        </div>
    </div>

    <script>
        console.log('Starting Mermaid test...');

        // Initialize Mermaid
        mermaid.initialize({
            startOnLoad: true,
            theme: 'default',
            securityLevel: 'loose'
        });

        // Test if Mermaid loaded
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded, Mermaid version:', mermaid.version || 'Unknown');

            setTimeout(() => {
                const mermaidElements = document.querySelectorAll('.mermaid');
                console.log('Found mermaid elements:', mermaidElements.length);

                mermaidElements.forEach((element, index) => {
                    console.log(`Element ${index}:`, element.innerHTML.trim());
                });
            }, 1000);
        });
    </script>
</body>

</html>