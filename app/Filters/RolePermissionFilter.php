<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RolePermissionFilter implements FilterInterface
{
    /**
     * Permission matrix untuk setiap role
     */
    private $permissions = [
        'admin' => [
            'modules' => ['*'], // Akses semua modul
            'actions' => ['create', 'read', 'update', 'delete', 'approve', 'finalize']
        ],
        'admin_unit' => [
            'modules' => ['kategori_unit'], // Hanya kategori sesuai unit
            'actions' => ['create', 'read', 'update'] // Tidak boleh delete, approve, finalize
        ],
        'kaprodi' => [
            'modules' => ['review_dosen', 'laporan_prodi', 'statistik_prodi'],
            'actions' => ['read', 'approve'] // Hanya read dan approve
        ],
        'dosen' => [
            'modules' => ['education_research'], // Hanya kategori ED
            'actions' => ['create', 'read', 'update'] // Tidak boleh delete
        ]
    ];

    /**
     * Mapping unit ke kategori
     */
    private $unitCategories = [
        'sarpras' => ['setting_infrastructure', 'energy_climate', 'water_management', 'transportation'],
        'lppm' => ['education_research'],
        'umum' => ['waste_management']
    ];

    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // Cek apakah user sudah login
        if (!$session->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu');
        }

        $userRole = $session->get('role');
        $userUnit = $session->get('unit'); // Untuk admin unit
        $userId = $session->get('user_id');

        // Get current route info
        $router = service('router');
        $controller = $router->controllerName();
        $method = $router->methodName();

        // Check permission berdasarkan route
        if (!$this->hasPermission($userRole, $userUnit, $userId, $controller, $method, $request)) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke halaman ini');
        }

        return $request;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action needed after request
    }

    /**
     * Check apakah user memiliki permission untuk akses tertentu
     */
    private function hasPermission($role, $unit, $userId, $controller, $method, $request)
    {
        // Admin pusat memiliki akses penuh
        if ($role === 'admin') {
            return true;
        }

        // Get module dan action dari controller dan method
        $module = $this->getModuleFromController($controller);
        $action = $this->getActionFromMethod($method);

        // Check permission berdasarkan role
        switch ($role) {
            case 'admin_unit':
                return $this->checkAdminUnitPermission($unit, $module, $action);

            case 'kaprodi':
                return $this->checkKaprodiPermission($module, $action, $userId);

            case 'dosen':
                return $this->checkDosenPermission($module, $action, $userId, $request);

            default:
                return false;
        }
    }

    /**
     * Check permission untuk Admin Unit
     */
    private function checkAdminUnitPermission($unit, $module, $action)
    {
        // Cek apakah unit memiliki akses ke modul ini
        if (!isset($this->unitCategories[$unit])) {
            return false;
        }

        $allowedModules = $this->unitCategories[$unit];

        // Cek apakah modul termasuk dalam kategori unit
        if (!in_array($module, $allowedModules)) {
            return false;
        }

        // Cek apakah action diizinkan (tidak boleh delete, approve, finalize)
        $allowedActions = ['create', 'read', 'update'];
        return in_array($action, $allowedActions);
    }

    /**
     * Check permission untuk Kaprodi
     */
    private function checkKaprodiPermission($module, $action, $userId)
    {
        // Kaprodi hanya boleh akses modul tertentu
        $allowedModules = ['review_dosen', 'laporan_prodi', 'statistik_prodi'];

        if (!in_array($module, $allowedModules)) {
            return false;
        }

        // Kaprodi hanya boleh read dan approve
        $allowedActions = ['read', 'approve'];
        return in_array($action, $allowedActions);
    }

    /**
     * Check permission untuk Dosen
     */
    private function checkDosenPermission($module, $action, $userId, $request)
    {
        // Dosen hanya boleh akses Education & Research
        if ($module !== 'education_research') {
            return false;
        }

        // Dosen hanya boleh create, read, update (tidak delete)
        $allowedActions = ['create', 'read', 'update'];
        if (!in_array($action, $allowedActions)) {
            return false;
        }

        // Untuk read dan update, pastikan data milik dosen sendiri
        if (in_array($action, ['read', 'update'])) {
            $dataId = $request->getVar('id') ?? $request->uri->getSegment(3);
            if ($dataId) {
                return $this->isDataOwnedByUser($dataId, $userId, 'education_research');
            }
        }

        return true;
    }

    /**
     * Get module name dari controller
     */
    private function getModuleFromController($controller)
    {
        $controllerMap = [
            'SettingInfrastructureController' => 'setting_infrastructure',
            'EnergyClimateController' => 'energy_climate',
            'WaterManagementController' => 'water_management',
            'WasteManagementController' => 'waste_management',
            'TransportationController' => 'transportation',
            'EducationResearchController' => 'education_research',
            'UserController' => 'user_management',
            'StatisticsController' => 'statistics',
            'LaporanController' => 'laporan'
        ];

        return $controllerMap[$controller] ?? 'unknown';
    }

    /**
     * Get action dari method name
     */
    private function getActionFromMethod($method)
    {
        $actionMap = [
            'index' => 'read',
            'show' => 'read',
            'create' => 'create',
            'store' => 'create',
            'edit' => 'update',
            'update' => 'update',
            'delete' => 'delete',
            'destroy' => 'delete',
            'approve' => 'approve',
            'finalize' => 'finalize'
        ];

        return $actionMap[$method] ?? 'read';
    }

    /**
     * Check apakah data dimiliki oleh user
     */
    private function isDataOwnedByUser($dataId, $userId, $module)
    {
        $db = \Config\Database::connect();

        // Mapping tabel berdasarkan modul
        $tableMap = [
            'education_research' => 'education_research',
            'setting_infrastructure' => 'setting_infrastructure',
            'energy_climate' => 'energy_climate',
            'water_management' => 'water_management',
            'waste_management' => 'waste_management',
            'transportation' => 'transportation'
        ];

        if (!isset($tableMap[$module])) {
            return false;
        }

        $table = $tableMap[$module];

        $query = $db->table($table)
            ->where('id', $dataId)
            ->where('user_id', $userId)
            ->get();

        return $query->getNumRows() > 0;
    }
}
