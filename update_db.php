<?php
// Load CodeIgniter's database configuration
include('application/config/database.php');

// Get database configuration
$db = $db['default'];

try {
    // Create PDO connection
    $pdo = new PDO(
        "mysql:host={$db['hostname']};dbname={$db['database']}",
        $db['username'],
        $db['password']
    );
    
    // Set PDO to throw exceptions
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL to add status_seragam column if it doesn't exist
    $sql = "
    ALTER TABLE daftar_ulang 
    ADD COLUMN IF NOT EXISTS status_seragam enum('pending','selesai') DEFAULT 'pending' AFTER seragam_olahraga;
    ";

    // Execute the query
    $pdo->exec($sql);
    echo "Database updated successfully!\n";

} catch(PDOException $e) {
    if ($e->getCode() == '42S02') { // Table doesn't exist
        try {
            // Create the table
            $sql = "
            CREATE TABLE daftar_ulang (
                id int(11) NOT NULL AUTO_INCREMENT,
                pendaftaran_id int(11) NOT NULL,
                no_daftar_ulang varchar(20) NOT NULL,
                kk_asli tinyint(1) DEFAULT 0,
                skl tinyint(1) DEFAULT 0,
                piagam tinyint(1) DEFAULT 0,
                sktm tinyint(1) DEFAULT 0,
                bayar_daftar_ulang tinyint(1) DEFAULT 0,
                nominal_daftar_ulang decimal(10,2) DEFAULT 0.00,
                ukuran_seragam varchar(20) DEFAULT NULL,
                seragam_osis tinyint(1) DEFAULT 0,
                seragam_pramuka tinyint(1) DEFAULT 0,
                seragam_batik tinyint(1) DEFAULT 0,
                seragam_olahraga tinyint(1) DEFAULT 0,
                status_seragam enum('pending','selesai') DEFAULT 'pending',
                created_at timestamp NULL DEFAULT current_timestamp(),
                updated_at timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
                PRIMARY KEY (id),
                KEY pendaftaran_id (pendaftaran_id),
                CONSTRAINT daftar_ulang_ibfk_1 FOREIGN KEY (pendaftaran_id) REFERENCES pendaftaran (id) ON DELETE CASCADE ON UPDATE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
            ";
            $pdo->exec($sql);
            echo "Table created successfully!\n";
        } catch(PDOException $e2) {
            echo "Error creating table: " . $e2->getMessage() . "\n";
        }
    } else {
        echo "Error: " . $e->getMessage() . "\n";
    }
}
?> 