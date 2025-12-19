<?php

/**
 * Permission Helper Functions
 * Fungsi-fungsi untuk checking permission di view dan controller
 */

if (!function_exists('hasPermission')) {
    /**
     * Check apakah user memiliki permission untuk action tertentu
     * 
     * @param string $module
     * @param string $action (create, read, update, delete, approve, finalize)
     * @param int|null $dataId (untuk check ownership)
     * @return bool
     */
    function hasPermission($module, $action, $dataId = null)
    {
        $session = session();
        $role = $session->get('role');
        $unit = $session->get('unit');
        $userId = $session->get('user_id');

        if (!$role) {
            return false;
        }

        // Admin pusat memiliki akses penuh
        if ($role === 'admin') {
            return true;
        }

        // Permission matrix berdasarkan role
        $permissions = [
            'admin_unit' => [
                'modules' => getUnitModules($unit),
                'actions' => ['create', 'read', 'update']
            ],
            'kaprodi' => [
                'modules' => ['review_dosen', 'laporan_prodi', 'statistik_prodi'],
                'actions' => ['read', 'approve']
            ],
            'dosen' => [
                'modules' => ['education_research'],
                'actions' => ['create', 'read', 'update']
            ]
        ];

        if (!isset($permissions[$role])) {
            return false;
        }

        $rolePermissions = $permissions[$role];

        // Check module access
        if (!in_array($module, $rolePermissions['modules'])) {
            return false;
        }

        // Check action access
        if (!in_array($action, $rolePermissions['actions'])) {
            return false;
        }

        // Check data ownership untuk dosen
        if ($role === 'dosen' && $dataId && in_array($action, ['read', 'update'])) {
            return isDataOwnedByUser($dataId, $userId, $module);
        }

        return true;
    }
}

if (!function_exists('getUnitModules')) {
    /**
     * Get modules yang bisa diakses oleh unit tertentu
     * 
     * @param string $unit
     * @return array
     */
    function getUnitModules($unit)
    {
        $unitCategories = [
            'sarpras' => ['setting_infrastructure', 'energy_climate', 'water_management', 'transportation'],
            'lppm' => ['education_research'],
            'umum' => ['waste_management']
        ];

        return $unitCategories[$unit] ?? [];
    }
}

if (!function_exists('canCreateData')) {
    /**
     * Check apakah user bisa create data di module tertentu
     */
    function canCreateData($module)
    {
        return hasPermission($module, 'create');
    }
}

if (!function_exists('canEditData')) {
    /**
     * Check apakah user bisa edit data tertentu
     */
    function canEditData($module, $dataId = null)
    {
        return hasPermission($module, 'update', $dataId);
    }
}

if (!function_exists('canDeleteData')) {
    /**
     * Check apakah user bisa delete data tertentu
     */
    function canDeleteData($module, $dataId = null)
    {
        return hasPermission($module, 'delete', $dataId);
    }
}

if (!function_exists('canApproveData')) {
    /**
     * Check apakah user bisa approve data
     */
    function canApproveData($module)
    {
        return hasPermission($module, 'approve');
    }
}

if (!function_exists('canFinalizeData')) {
    /**
     * Check apakah user bisa finalize data
     */
    function canFinalizeData($module)
    {
        return hasPermission($module, 'finalize');
    }
}

if (!function_exists('isDataOwnedByUser')) {
    /**
     * Check apakah data dimiliki oleh user tertentu
     */
    function isDataOwnedByUser($dataId, $userId, $module)
    {
        $db = \Config\Database::connect();

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

if (!function_exists('getVisibleMenus')) {
    /**
     * Get menu yang visible untuk role tertentu
     */
    function getVisibleMenus($role, $unit = null)
    {
        $menus = [
            'admin' => [
                'dashboard',
                'setting_infrastructure',
                'energy_climate',
                'water_management',
                'waste_management',
                'transportation',
                'education_research',
                'user_management',
                'statistics',
                'laporan_global',
                'pengaturan'
            ],
            'admin_unit' => [
                'dashboard',
                'upload_bukti',
                'status_data',
                'laporan_unit'
            ],
            'kaprodi' => [
                'dashboard',
                'review_dosen',
                'laporan_prodi',
                'statistik_prodi'
            ],
            'dosen' => [
                'dashboard',
                'education_research',
                'status_pengajuan',
                'riwayat_data'
            ]
        ];

        $baseMenus = $menus[$role] ?? [];

        // Untuk admin unit, tambahkan kategori sesuai unit
        if ($role === 'admin_unit' && $unit) {
            $unitModules = getUnitModules($unit);
            $baseMenus = array_merge($baseMenus, $unitModules);
        }

        return $baseMenus;
    }
}

if (!function_exists('isUIGMPeriodOpen')) {
    /**
     * Check apakah periode UIGM sedang terbuka untuk input
     */
    function isUIGMPeriodOpen()
    {
        $db = \Config\Database::connect();

        $query = $db->table('uigm_periods')
            ->where('is_active', 1)
            ->where('status', 'OPEN')
            ->get();

        return $query->getNumRows() > 0;
    }
}

if (!function_exists('getCurrentUIGMYear')) {
    /**
     * Get tahun UIGM yang sedang aktif
     */
    function getCurrentUIGMYear()
    {
        $db = \Config\Database::connect();

        $query = $db->table('uigm_periods')
            ->where('is_active', 1)
            ->get();

        $result = $query->getRowArray();
        return $result ? $result['year'] : date('Y');
    }
}

if (!function_exists('logUserActivity')) {
    /**
     * Log aktivitas user untuk audit trail
     */
    function logUserActivity($action, $module, $dataId = null, $description = null)
    {
        $session = session();
        $userId = $session->get('user_id');
        $userName = $session->get('name');

        if (!$userId) {
            return false;
        }

        $db = \Config\Database::connect();

        $data = [
            'user_id' => $userId,
            'user_name' => $userName,
            'action' => $action,
            'module' => $module,
            'data_id' => $dataId,
            'description' => $description,
            'ip_address' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown',
            'created_at' => date('Y-m-d H:i:s')
        ];

        return $db->table('user_activity_logs')->insert($data);
    }
}
