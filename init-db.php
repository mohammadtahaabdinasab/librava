<?php
/**
 * Initialize SQLite database with schema and sample data
 * Run once: php init-db.php
 */

$dbPath = __DIR__ . '/storage/librava.db';

try {
    // Create or open database
    $pdo = new PDO('sqlite:' . $dbPath);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Read and execute schema
    $schema = file_get_contents(__DIR__ . '/database/librava.sql');
    $pdo->exec($schema);
    
    echo "✓ SQLite database initialized at: $dbPath\n";
    echo "✓ Schema created and sample data inserted.\n";
    
    // Verify
    $stmt = $pdo->query('SELECT COUNT(*) as count FROM books');
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "✓ Books table contains " . $row['count'] . " sample records.\n";
    
} catch (Exception $e) {
    die("Error: " . $e->getMessage() . "\n");
}
