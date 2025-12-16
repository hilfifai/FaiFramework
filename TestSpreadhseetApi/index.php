<?php
require_once __DIR__ . '/../vendor/autoload.php';

function updateGoogleSheet($spreadsheetId, $range, $values) {
    try {
        // Path ke file credentials
        $credentialsPath = __DIR__ . '/stone-plating-481319-q1-da396b1468ee.json';
        
        if (!file_exists($credentialsPath)) {
            throw new Exception("Credentials file not found: " . $credentialsPath);
        }
        
        // Load credentials langsung
        $credentials = json_decode(file_get_contents($credentialsPath), true);
        
        $client = new Google_Client();
        $client->setAuthConfig($credentials);
        $client->addScope(Google_Service_Sheets::SPREADSHEETS);
        
        $service = new Google_Service_Sheets($client);
        
        $body = new Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);
        
        $params = [
            'valueInputOption' => 'USER_ENTERED'
        ];
        
        // Update existing range
        $result = $service->spreadsheets_values->update(
            $spreadsheetId,
            $range,
            $body,
            $params
        );
        
        return $result;
    } catch (Exception $e) {
        throw new Exception("Gagal update Google Sheet: " . $e->getMessage());
    }
}

// Debug info untuk memastikan path benar
echo "Current directory: " . __DIR__ . "<br>";
echo "Credentials file should be at: " . __DIR__ . '/stone-plating-481319-q1-da396b1468ee.json<br>';

// Contoh penggunaan
try {
    $spreadsheetId = '1zKKY0USU5p2lj-OjFyZNJXuPV6G0BsoLRT9aBddb53E';
    $range = 'Sheet1!A1:C3';
    $values = [
        ['Nama', 'Email', 'Tanggal'],
        ['John Doe', 'john@example.com', date('Y-m-d')],
        ['Jane Doe', 'jane@example.com', date('Y-m-d H:i:s')]
    ];
    
    $result = updateGoogleSheet($spreadsheetId, $range, $values);
    echo "<br>Success! Berhasil update Google Sheet.";
    
} catch (Exception $e) {
    echo "<br>Error: " . $e->getMessage();
}
?>