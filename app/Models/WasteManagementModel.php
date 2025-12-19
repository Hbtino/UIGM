<?php

namespace App\Models;

use CodeIgniter\Model;

class WasteManagementModel extends Model
{
    protected $table            = 'waste_management';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'tahun',
        'jenis_sampah',
        'total_sampah_anorganik_bersih',
        'total_sampah_anorganik_kotor',
        'total_sampah_organik',
        'total_limbah_air',
        'total_limbah_b3',
        'total_sampah_keseluruhan',
        'program_reduce',
        'program_reuse',
        'program_recycle',
        'tempat_sampah_terpilah',
        'kompos_organik',
        'daur_ulang_persentase',
        'zero_waste_program',
        'bank_sampah',
        'capaian_persen',
        'keterangan',
        'status_verifikasi',
        'catatan_verifikasi',
        'bukti_pendukung',
        'verified_by',
        'verified_at',
        'created_by',
        'updated_by',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'tahun'                      => 'required|integer|is_unique[waste_management.tahun,id,{id}]',
        'total_konsumsi_listrik'     => 'required|decimal|greater_than[0]',
        'konsumsi_energi_terbarukan' => 'required|decimal',
        'peralatan_hemat_energi'     => 'required|integer',
        'bangunan_cerdas'            => 'required|integer',
        'jumlah_energi_terbarukan'   => 'required|integer',
        'total_listrik_per_orang'    => 'required|decimal',
        'bangunan_ramah_lingkungan'  => 'required|integer',
        'jejak_karbon_per_orang'     => 'required|decimal',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['calculatePercentages'];
    protected $afterInsert    = [];
    protected $beforeUpdate   = ['calculatePercentages'];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Auto-calculate percentages before insert/update
     */
    protected function calculatePercentages(array $data)
    {
        if (isset($data['data'])) {
            // Calculate persentase_energi_terbarukan
            if (isset($data['data']['total_konsumsi_listrik']) && isset($data['data']['konsumsi_energi_terbarukan'])) {
                $total = floatval($data['data']['total_konsumsi_listrik']);
                $terbarukan = floatval($data['data']['konsumsi_energi_terbarukan']);

                if ($total > 0) {
                    $data['data']['persentase_energi_terbarukan'] = round(($terbarukan / $total) * 100, 2);
                } else {
                    $data['data']['persentase_energi_terbarukan'] = 0;
                }
            }

            // Calculate capaian_persen (weighted)
            $persentase = isset($data['data']['persentase_energi_terbarukan']) ? floatval($data['data']['persentase_energi_terbarukan']) : 0;
            $program_emisi = isset($data['data']['program_pengurangan_emisi']) ? intval($data['data']['program_pengurangan_emisi']) : 0;
            $program_inovatif = isset($data['data']['program_inovatif_energi']) ? intval($data['data']['program_inovatif_energi']) : 0;
            $program_iklim = isset($data['data']['program_dampak_iklim']) ? intval($data['data']['program_dampak_iklim']) : 0;

            $capaian = ($persentase * 0.5) +
                ($program_emisi ? 20 : 0) +
                ($program_inovatif ? 15 : 0) +
                ($program_iklim ? 15 : 0);

            $data['data']['capaian_persen'] = round($capaian, 2);
        }

        return $data;
    }

    /**
     * Get all data with user information
     */
    public function getAllWithUsers()
    {
        return $this->select('waste_management.*, 
                             creator.name as created_by_name,
                             verifier.name as verified_by_name')
            ->join('users as creator', 'creator.id = waste_management.created_by', 'left')
            ->join('users as verifier', 'verifier.id = waste_management.verified_by', 'left')
            ->orderBy('waste_management.tahun', 'DESC')
            ->findAll();
    }

    /**
     * Get data by ID with user information
     */
    public function getWithUsers($id)
    {
        return $this->select('waste_management.*, 
                             creator.name as created_by_name,
                             verifier.name as verified_by_name')
            ->join('users as creator', 'creator.id = waste_management.created_by', 'left')
            ->join('users as verifier', 'verifier.id = waste_management.verified_by', 'left')
            ->where('waste_management.id', $id)
            ->first();
    }

    /**
     * Insert data input dari user
     */
    public function insertUserInput($data)
    {
        // Buat tabel sementara untuk input user jika belum ada
        $db = \Config\Database::connect();

        // Cek apakah tabel user_waste_inputs sudah ada
        if (!$db->tableExists('user_waste_inputs')) {
            $forge = \Config\Database::forge();

            $fields = [
                'id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => true,
                    'auto_increment' => true
                ],
                'tanggal_input' => [
                    'type' => 'DATE',
                    'null' => false
                ],
                'jenis_sampah' => [
                    'type' => 'ENUM',
                    'constraint' => ['sampah_anorganik_bersih', 'sampah_anorganik_kotor', 'sampah_organik', 'limbah_air', 'limbah_b3'],
                    'null' => false
                ],
                'jumlah' => [
                    'type' => 'DECIMAL',
                    'constraint' => '10,2',
                    'null' => false
                ],
                'satuan' => [
                    'type' => 'ENUM',
                    'constraint' => ['kg', 'liter'],
                    'null' => false
                ],
                'gedung' => [
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                    'null' => false
                ],
                'status_verifikasi' => [
                    'type' => 'ENUM',
                    'constraint' => ['pending', 'approved', 'rejected'],
                    'default' => 'pending'
                ],
                'created_by' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => true,
                    'null' => false
                ],
                'created_at' => [
                    'type' => 'DATETIME',
                    'null' => true
                ],
                'updated_at' => [
                    'type' => 'DATETIME',
                    'null' => true
                ]
            ];

            $forge->addField($fields);
            $forge->addKey('id', true);
            $forge->addForeignKey('created_by', 'users', 'id', 'CASCADE', 'CASCADE');
            $forge->createTable('user_waste_inputs');
        }

        // Insert data ke tabel user_waste_inputs
        return $db->table('user_waste_inputs')->insert($data);
    }
}
