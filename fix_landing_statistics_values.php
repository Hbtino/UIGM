<?php

require_once 'vendor/autoload.php';

// Load CodeIgniter
$app = \Config\Services::codeigniter();
$app->initialize();

// Get database connection
$db = \Config\Database::connect();

echo "Fixing landing_statistics values...\n\n";

// Get all records
$query = $db->query("SELECT * FROM landing_statistics ORDER BY id");
$results = $query->getResultArray();

foreach ($results as $row) {
    $id = $row['id'];
    $section = $row['section'];
    $key_name = $row['key_name'];
    $label = $row['label'];
    $value = $row['value'];

    echo "ID: {$id} | Section: {$section} | Key: {$key_name} | Label: {$label} | Value: {$value}\n";

    // Check if value contains non-numeric characters that should be numeric
    if ($section == 'profil_kampus' || $section == 'fasilitas') {
        // These sections should have numeric values
        $numericValue = preg_replace('/[^0-9]/', '', $value);
        if ($numericValue !== $value && is_numeric($numericValue)) {
            echo "  -> Updating to: {$numericValue}\n";
            $db->query("UPDATE landing_statistics SET value = ? WHERE id = ?", [$numericValue, $id]);
        }
    }

    echo "\n";
}

echo "Done!\n";
