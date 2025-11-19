<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Change Requests - Admin</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }
        
        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }
        
        .page-header {
            background: white;
            padding: 25px 30px;
            border-radius: 15px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .page-header h2 {
            margin: 0;
            color: #1e3c72;
            font-size: 26px;
            font-weight: 700;
        }
        
        .btn-back {
            background: #6c757d;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .btn-back:hover {
            background: #5a6268;
            transform: translateY(-2px);
        }
        
        .requests-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            overflow: hidden;
        }
        
        .request-card {
            padding: 25px;
            border-bottom: 2px solid #f0f0f0;
        }
        
        .request-card:last-child {
            border-bottom: none;
        }
        
        .request-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 15px;
        }
        
        .user-info h4 {
            margin: 0;
            color: #1e3c72;
            font-size: 18px;
            font-weight: 700;
        }
        
        .user-info p {
            margin: 5px 0 0;
            color: #666;
            font-size: 14px;
        }
        
        .request-time {
            text-align: right;
            color: #999;
            font-size: 13px;
        }
        
        .request-actions {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }
        
        .btn-approve {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-approve:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.4);
        }
        
        .btn-reject {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-reject:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.4);
        }
        
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #999;
        }
        
        .empty-state i {
            font-size: 64px;
            margin-bottom: 20px;
            opacity: 0.3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="page-header">
            <h2><i class="fas fa-key"></i> Password Change Requests</h2>
            <a href="<?= base_url('dashboard') ?>" class="btn-back">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        
        <div class="requests-container">
            <?php if(empty($requests)): ?>
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <h4>Tidak ada request</h4>
                <p>Belum ada request ganti password yang perlu diproses</p>
            </div>
            <?php else: ?>
            <?php foreach($requests as $request): ?>
            <div class="request-card" id="request-<?= $request['id'] ?>">
                <div class="request-header">
                    <div class="user-info">
                        <h4><?= esc($request['name']) ?></h4>
                        <p>
                            <i class="fas fa-envelope"></i> <?= esc($request['email']) ?> | 
                            <i class="fas fa-user-tag"></i> <?= esc($request['role']) ?>
                        </p>
                    </div>
                    <div class="request-time">
                        <i class="fas fa-clock"></i> 
                        <?= date('d M Y, H:i', strtotime($request['requested_at'])) ?>
                    </div>
                </div>
                
                <div class="request-actions">
                    <button class="btn-approve" onclick="processRequest(<?= $request['id'] ?>, 'approve')">
                        <i class="fas fa-check"></i> Setujui
                    </button>
                    <button class="btn-reject" onclick="processRequest(<?= $request['id'] ?>, 'reject')">
                        <i class="fas fa-times"></i> Tolak
                    </button>
                </div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function processRequest(requestId, action) {
            if(!confirm(`Apakah Anda yakin ingin ${action === 'approve' ? 'menyetujui' : 'menolak'} request ini?`)) {
                return;
            }
            
            const formData = new FormData();
            formData.append('action', action);
            
            fetch(`<?= base_url('settings/process-password-request/') ?>${requestId}`, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    alert(data.message);
                    document.getElementById(`request-${requestId}`).remove();
                    
                    // Check if no more requests
                    if(document.querySelectorAll('.request-card').length === 0) {
                        location.reload();
                    }
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan sistem');
            });
        }
    </script>
</body>
</html>
