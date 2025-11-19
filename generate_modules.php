<?php
/**
 * Module Generator Script
 * Generate Water Management, Waste Management, and Education & Research modules
 * 
 * Usage: php generate_modules.php
 */

// Module configurations
$modules = [
    'water_management' => [
        'name' => 'Water Management',
        'class' => 'WaterManagement',
        'url' => 'water-management',
        'icon' => 'fa-tint',
        'fields' => [
            'total_konsumsi_air' => ['type' => 'decimal', 'label' => 'Total Konsumsi Air (m³)'],
            'air_daur_ulang' => ['type' => 'decimal', 'label' => 'Air Daur Ulang (m³)'],
            'persentase_air_daur_ulang' => ['type' => 'decimal', 'label' => 'Persentase Air Daur Ulang', 'auto' => true],
            'konsumsi_air_per_orang' => ['type' => 'decimal', 'label' => 'Konsumsi Air per Orang', 'auto' => true],
            'program_konservasi_air' => ['type' => 'boolean', 'label' => 'Program Konservasi Air'],
            'sistem_daur_ulang_air' => ['type' => 'boolean', 'label' => 'Sistem Daur Ulang Air'],
            'teknologi_hemat_air' => ['type' => 'boolean', 'label' => 'Teknologi Hemat Air'],
            'program_edukasi_air' => ['type' => 'boolean', 'label' => 'Program Edukasi Air'],
        ],
        'calculation' => '
            $persentase = ($data["air_daur_ulang"] / $data["total_konsumsi_air"]) * 100;
            $data["persentase_air_daur_ulang"] = round($persentase, 2);
            
            $capaian = ($persentase * 0.4) + 
                       ($data["program_konservasi_air"] ? 20 : 0) +
                       ($data["sistem_daur_ulang_air"] ? 20 : 0) +
                       ($data["teknologi_hemat_air"] ? 10 : 0) +
                       ($data["program_edukasi_air"] ? 10 : 0);
            $data["capaian_persen"] = round($capaian, 2);
        '
    ],
    'waste_management' => [
        'name' => 'Waste Management',
        'class' => 'WasteManagement',
        'url' => 'waste-management',
        'icon' => 'fa-recycle',
        'fields' => [
            'total_sampah' => ['type' => 'decimal', 'label' => 'Total Sampah (kg)'],
            'sampah_didaur_ulang' => ['type' => 'decimal', 'label' => 'Sampah Didaur Ulang (kg)'],
            'persentase_daur_ulang' => ['type' => 'decimal', 'label' => 'Persentase Daur Ulang', 'auto' => true],
            'volume_limbah_per_orang' => ['type' => 'decimal', 'label' => 'Volume Limbah per Orang', 'auto' => true],
            'program_3r' => ['type' => 'boolean', 'label' => 'Program 3R'],
            'pengurangan_kertas_plastik' => ['type' => 'boolean', 'label' => 'Pengurangan Kertas & Plastik'],
            'pengolahan_organik' => ['type' => 'boolean', 'label' => 'Pengolahan Organik'],
            'pengolahan_anorganik' => ['type' => 'boolean', 'label' => 'Pengolahan Anorganik'],
            'pengolahan_beracun' => ['type' => 'boolean', 'label' => 'Pengolahan Beracun'],
            'sistem_pembuangan' => ['type' => 'boolean', 'label' => 'Sistem Pembuangan'],
        ],
        'calculation' => '
            $persentase = ($data["sampah_didaur_ulang"] / $data["total_sampah"]) * 100;
            $data["persentase_daur_ulang"] = round($persentase, 2);
            
            $capaian = ($persentase * 0.4) + 
                       ($data["program_3r"] ? 20 : 0) +
                       ($data["pengurangan_kertas_plastik"] ? 15 : 0) +
                       ($data["pengolahan_organik"] ? 10 : 0) +
                       ($data["pengolahan_anorganik"] ? 10 : 0) +
                       ($data["sistem_pembuangan"] ? 5 : 0);
            $data["capaian_persen"] = round($capaian, 2);
        '
    ],
    'education_research' => [
        'name' => 'Education & Research',
        'class' => 'EducationResearch',
        'url' => 'education-research',
        'icon' => 'fa-graduation-cap',
        'fields' => [
            'jumlah_mk_keberlanjutan' => ['type' => 'integer', 'label' => 'Jumlah MK Keberlanjutan'],
            'total_mk' => ['type' => 'integer', 'label' => 'Total Mata Kuliah'],
            'rasio_mk_keberlanjutan' => ['type' => 'decimal', 'label' => 'Rasio MK Keberlanjutan', 'auto' => true],
            'pendanaan_penelitian_berkelanjutan' => ['type' => 'decimal', 'label' => 'Pendanaan Penelitian Berkelanjutan'],
            'total_pendanaan_penelitian' => ['type' => 'decimal', 'label' => 'Total Pendanaan Penelitian'],
            'rasio_pendanaan' => ['type' => 'decimal', 'label' => 'Rasio Pendanaan', 'auto' => true],
            'jumlah_publikasi' => ['type' => 'integer', 'label' => 'Jumlah Publikasi'],
            'jumlah_kegiatan_berkelanjutan' => ['type' => 'integer', 'label' => 'Jumlah Kegiatan Berkelanjutan'],
            'kegiatan_mahasiswa' => ['type' => 'boolean', 'label' => 'Kegiatan Mahasiswa'],
            'website_berkelanjutan' => ['type' => 'boolean', 'label' => 'Website Berkelanjutan'],
            'laporan_berkelanjutan' => ['type' => 'boolean', 'label' => 'Laporan Berkelanjutan'],
            'kegiatan_budaya' => ['type' => 'boolean', 'label' => 'Kegiatan Budaya'],
            'kerjasama_internasional' => ['type' => 'boolean', 'label' => 'Kerjasama Internasional'],
            'pengabdian_masyarakat' => ['type' => 'boolean', 'label' => 'Pengabdian Masyarakat'],
            'startup_berkelanjutan' => ['type' => 'boolean', 'label' => 'Startup Berkelanjutan'],
        ],
        'calculation' => '
            $rasio_mk = ($data["jumlah_mk_keberlanjutan"] / $data["total_mk"]) * 100;
            $data["rasio_mk_keberlanjutan"] = round($rasio_mk, 2);
            
            $rasio_pendanaan = ($data["pendanaan_penelitian_berkelanjutan"] / $data["total_pendanaan_penelitian"]) * 100;
            $data["rasio_pendanaan"] = round($rasio_pendanaan, 2);
            
            $capaian = ($rasio_mk * 0.3) + 
                       ($rasio_pendanaan * 0.3) +
                       ($data["jumlah_publikasi"] * 0.1) +
                       ($data["website_berkelanjutan"] ? 10 : 0) +
                       ($data["laporan_berkelanjutan"] ? 10 : 0) +
                       ($data["kerjasama_internasional"] ? 10 : 0);
            $data["capaian_persen"] = round($capaian, 2);
        '
    ]
];

echo "===========================================\n";
echo "MODULE GENERATOR FOR UI GREENMETRIC SYSTEM\n";
echo "===========================================\n\n";

echo "This script will generate files for:\n";
echo "1. Water Management\n";
echo "2. Waste Management\n";
echo "3. Education & Research\n\n";

echo "Files to be generated per module:\n";
echo "- 2 Migrations (main + revisions)\n";
echo "- 2 Models (main + revisions)\n";
echo "- 1 Controller (16 methods)\n";
echo "- 8 Views (index, create, edit, verify, etc.)\n";
echo "- Routes configuration\n";
echo "- Upload folder\n\n";

echo "Total: ~40 files will be created\n\n";

echo "⚠️  IMPORTANT:\n";
echo "This is a TEMPLATE script. To actually generate files:\n";
echo "1. Copy structure from Energy Climate module\n";
echo "2. Use Find & Replace for each module\n";
echo "3. Update field names and calculations\n\n";

echo "📋 MANUAL STEPS:\n\n";

foreach ($modules as $key => $config) {
    echo "=== {$config['name']} ===\n";
    echo "1. Copy Energy Climate files:\n";
    echo "   cp -r app/Views/kriteria/energy_climate app/Views/kriteria/{$key}\n";
    echo "   cp app/Controllers/EnergyClimateController.php app/Controllers/{$config['class']}Controller.php\n";
    echo "   cp app/Models/EnergyClimateModel.php app/Models/{$config['class']}Model.php\n";
    echo "   cp app/Models/EnergyClimateRevisionModel.php app/Models/{$config['class']}RevisionModel.php\n\n";
    
    echo "2. Find & Replace in all files:\n";
    echo "   energy_climate → {$key}\n";
    echo "   EnergyClimate → {$config['class']}\n";
    echo "   energy-climate → {$config['url']}\n";
    echo "   Energy & Climate Change → {$config['name']}\n\n";
    
    echo "3. Update fields in Model \$allowedFields:\n";
    foreach ($config['fields'] as $field => $info) {
        echo "   - {$field}\n";
    }
    echo "\n";
    
    echo "4. Create upload folder:\n";
    echo "   mkdir writable/uploads/{$key}\n\n";
    
    echo "5. Add routes in app/Config/Routes.php\n\n";
    
    echo "---\n\n";
}

echo "✅ After completing all steps, run:\n";
echo "   php spark migrate\n\n";

echo "📚 For detailed instructions, see: CONTINUE_IMPLEMENTATION.md\n\n";
