<?php
require 'vendor/autoload.php';

$db = \Config\Database::connect();
$fields = $db->getFieldData('users');

echo "Struktur tabel users:\n";
foreach ($fields as $field) {
    echo "- {$field->name} ({$field->type})\n";
}
