<?php

namespace App\Controllers;

class SimpleStatistics extends BaseController
{
    public function index()
    {
        $session = session();

        // Simple session check
        $isLoggedIn = $session->get('isLoggedIn') || $session->get('logged_in');
        $userRole = $session->get('role');

        if (!$isLoggedIn) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        if ($userRole !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak. Hanya admin yang dapat mengakses halaman ini.');
        }

        // Simple test page
        $html = '
        <!DOCTYPE html>
        <html>
        <head>
            <title>Manajemen Statistik & Chart</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        </head>
        <body>
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3>🎉 Manajemen Statistik & Chart</h3>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-success">
                                    <h5>✅ Sistem berhasil diakses!</h5>
                                    <p>Selamat datang di sistem CRUD lengkap untuk statistik dan chart.</p>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card border-primary">
                                            <div class="card-body text-center">
                                                <i class="fas fa-home fa-3x text-primary mb-3"></i>
                                                <h5>Landing Page Statistics</h5>
                                                <p>Kelola statistik yang ditampilkan di homepage</p>
                                                <a href="' . base_url('statistics/landing') . '" class="btn btn-primary">Kelola</a>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="card border-success">
                                            <div class="card-body text-center">
                                                <i class="fas fa-tachometer-alt fa-3x text-success mb-3"></i>
                                                <h5>Dashboard Statistics</h5>
                                                <p>Kelola statistik yang ditampilkan di dashboard</p>
                                                <button class="btn btn-success" onclick="alert(\'Coming soon!\')">Kelola</button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="card border-info">
                                            <div class="card-body text-center">
                                                <i class="fas fa-chart-line fa-3x text-info mb-3"></i>
                                                <h5>Charts & Indicators</h5>
                                                <p>Kelola chart interaktif untuk dashboard dan landing</p>
                                                <button class="btn btn-info" onclick="alert(\'Coming soon!\')">Kelola</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <hr>
                                
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <h5>Session Info:</h5>
                                        <ul>
                                            <li>User: ' . ($session->get('name') ?? 'Unknown') . '</li>
                                            <li>Role: ' . ($session->get('role') ?? 'Unknown') . '</li>
                                            <li>Email: ' . ($session->get('email') ?? 'Unknown') . '</li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class="mt-3">
                                    <a href="' . base_url('dashboard') . '" class="btn btn-secondary">← Kembali ke Dashboard</a>
                                    <a href="' . base_url('debug-session') . '" class="btn btn-outline-info">Debug Session</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        </body>
        </html>';

        return $html;
    }
}
