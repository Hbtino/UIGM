<!DOCTYPE html>
<html>
<head>
    <title>Test Routes</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        .test { margin: 20px 0; padding: 15px; border: 1px solid #ddd; border-radius: 5px; }
        button { padding: 10px 20px; margin: 5px; cursor: pointer; }
        .get { background: #28a745; color: white; border: none; }
        .post { background: #dc3545; color: white; border: none; }
    </style>
</head>
<body>
    <h1>Test Laporan Routes</h1>
    
    <div class="test">
        <h3>Test Edit Dosen (GET)</h3>
        <a href="/laporan/edit-dosen/6"><button class="get">Test Edit Dosen ID 6</button></a>
    </div>
    
    <div class="test">
        <h3>Test Delete Dosen (POST)</h3>
        <form method="POST" action="/laporan/delete-dosen/6" onsubmit="return confirm('Test delete?')">
            <button type="submit" class="post">Test Delete Dosen ID 6</button>
        </form>
    </div>
    
    <div class="test">
        <h3>Test Edit Kaprodi (GET)</h3>
        <a href="/laporan/edit-kaprodi/1"><button class="get">Test Edit Kaprodi ID 1</button></a>
    </div>
    
    <div class="test">
        <h3>Test Delete Kaprodi (POST)</h3>
        <form method="POST" action="/laporan/delete-kaprodi/1" onsubmit="return confirm('Test delete?')">
            <button type="submit" class="post">Test Delete Kaprodi ID 1</button>
        </form>
    </div>
    
    <hr>
    <p><a href="/laporan/riwayat-dosen">Back to Riwayat Dosen</a></p>
</body>
</html>
