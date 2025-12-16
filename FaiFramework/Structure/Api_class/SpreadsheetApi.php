<?php

class SpreadsheetApi
{
    private $client;
    private $service;
    private $spreadsheetId;
    
    /**
     * Constructor
     * 
     * @param string $credentialsPath Path ke file credentials JSON
     * @param string|null $spreadsheetId ID spreadsheet (opsional, bisa di-set nanti)
     */
    public function __construct($credentialsPath, $spreadsheetId = null)
    {
        $this->initializeClient($credentialsPath);
        $this->spreadsheetId = $spreadsheetId;
    }
    
    /**
     * Initialize Google Client
     */
    private function initializeClient($credentialsPath)
    {
        if (!file_exists($credentialsPath)) {
            throw new Exception("Credentials file not found: " . $credentialsPath);
        }
        
        $credentials = json_decode(file_get_contents($credentialsPath), true);
        
        $this->client = new Google_Client();
        $this->client->setAuthConfig($credentials);
        $this->client->addScope(Google_Service_Sheets::SPREADSHEETS);
        
        $this->service = new Google_Service_Sheets($this->client);
    }
    
    /**
     * Set Spreadsheet ID
     */
    public function setSpreadsheetId($spreadsheetId)
    {
        $this->spreadsheetId = $spreadsheetId;
        return $this;
    }
    
    /**
     * Get Spreadsheet ID
     */
    public function getSpreadsheetId()
    {
        return $this->spreadsheetId;
    }
    
    /**
     * Update data di range tertentu
     */
    public function update($range, $values, $valueInputOption = 'USER_ENTERED')
    {
        $this->validateSpreadsheetId();
        
        $body = new Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);
        
        $params = [
            'valueInputOption' => $valueInputOption
        ];
        
        return $this->service->spreadsheets_values->update(
            $this->spreadsheetId,
            $range,
            $body,
            $params
        );
    }
    
    /**
     * Append data (menambahkan baris baru)
     */
    public function append($range, $values, $valueInputOption = 'USER_ENTERED')
    {
        $this->validateSpreadsheetId();
        
        $body = new Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);
        
        $params = [
            'valueInputOption' => $valueInputOption,
            'insertDataOption' => 'INSERT_ROWS'
        ];
        
        return $this->service->spreadsheets_values->append(
            $this->spreadsheetId,
            $range,
            $body,
            $params
        );
    }
    
    /**
     * Read data dari range tertentu
     */
    public function read($range, $majorDimension = 'ROWS')
    {
        $this->validateSpreadsheetId();
        
        $response = $this->service->spreadsheets_values->get(
            $this->spreadsheetId,
            $range,
            ['majorDimension' => $majorDimension]
        );
        
        return $response->getValues();
    }
    
    /**
     * Clear data di range tertentu
     */
    public function clear($range)
    {
        $this->validateSpreadsheetId();
        
        $body = new Google_Service_Sheets_ClearValuesRequest();
        
        return $this->service->spreadsheets_values->clear(
            $this->spreadsheetId,
            $range,
            $body
        );
    }
    
    /**
     * Batch update multiple ranges sekaligus
     */
    public function batchUpdate($data)
    {
        $this->validateSpreadsheetId();
        
        $batchUpdateRequest = new Google_Service_Sheets_BatchUpdateValuesRequest([
            'valueInputOption' => 'USER_ENTERED',
            'data' => $data
        ]);
        
        return $this->service->spreadsheets_values->batchUpdate(
            $this->spreadsheetId,
            $batchUpdateRequest
        );
    }
    
    /**
     * Get spreadsheet metadata
     */
    public function getSpreadsheetInfo()
    {
        $this->validateSpreadsheetId();
        
        return $this->service->spreadsheets->get($this->spreadsheetId);
    }
    
    /**
     * Get list of sheets dalam spreadsheet
     */
    public function getSheets()
    {
        $spreadsheet = $this->getSpreadsheetInfo();
        return $spreadsheet->getSheets();
    }
    
    /**
     * Get sheet names
     */
    public function getSheetNames()
    {
        $sheets = $this->getSheets();
        $names = [];
        
        foreach ($sheets as $sheet) {
            $names[] = $sheet->getProperties()->getTitle();
        }
        
        return $names;
    }
    
    /**
     * Create new sheet
     */
    public function createSheet($title)
    {
        $this->validateSpreadsheetId();
        
        $requests = [
            new Google_Service_Sheets_Request([
                'addSheet' => [
                    'properties' => [
                        'title' => $title
                    ]
                ]
            ])
        ];
        
        $batchUpdateRequest = new Google_Service_Sheets_BatchUpdateSpreadsheetRequest([
            'requests' => $requests
        ]);
        
        return $this->service->spreadsheets->batchUpdate(
            $this->spreadsheetId,
            $batchUpdateRequest
        );
    }
    
    /**
     * Format cells
     */
    public function formatCells($range, $format)
    {
        $this->validateSpreadsheetId();
        
        $requests = [
            new Google_Service_Sheets_Request([
                'repeatCell' => [
                    'range' => $this->parseRange($range),
                    'cell' => ['userEnteredFormat' => $format],
                    'fields' => 'userEnteredFormat'
                ]
            ])
        ];
        
        $batchUpdateRequest = new Google_Service_Sheets_BatchUpdateSpreadsheetRequest([
            'requests' => $requests
        ]);
        
        return $this->service->spreadsheets->batchUpdate(
            $this->spreadsheetId,
            $batchUpdateRequest
        );
    }
    
    /**
     * Parse range string ke format Google Sheets
     */
    private function parseRange($range)
    {
        // Format sederhana: "Sheet1!A1:B10"
        if (strpos($range, '!') !== false) {
            list($sheetName, $cellRange) = explode('!', $range);
            
            $matches = [];
            preg_match('/([A-Z]+)(\d+):([A-Z]+)(\d+)/', $cellRange, $matches);
            
            if (count($matches) >= 5) {
                return [
                    'sheetId' => $this->getSheetIdByName($sheetName),
                    'startRowIndex' => (int)$matches[2] - 1,
                    'endRowIndex' => (int)$matches[4],
                    'startColumnIndex' => $this->columnLetterToIndex($matches[1]),
                    'endColumnIndex' => $this->columnLetterToIndex($matches[3]) + 1
                ];
            }
        }
        
        return ['sheetId' => 0];
    }
    
    /**
     * Convert column letter to index (A=0, B=1, ...)
     */
    private function columnLetterToIndex($letter)
    {
        $index = 0;
        $length = strlen($letter);
        
        for ($i = 0; $i < $length; $i++) {
            $index = $index * 26 + (ord($letter[$i]) - ord('A') + 1);
        }
        
        return $index - 1;
    }
    
    /**
     * Get sheet ID by name
     */
    private function getSheetIdByName($sheetName)
    {
        $sheets = $this->getSheets();
        
        foreach ($sheets as $sheet) {
            if ($sheet->getProperties()->getTitle() === $sheetName) {
                return $sheet->getProperties()->getSheetId();
            }
        }
        
        return 0; // Default sheet
    }
    
    /**
     * Validate spreadsheet ID
     */
    private function validateSpreadsheetId()
    {
        if (empty($this->spreadsheetId)) {
            throw new Exception("Spreadsheet ID belum di-set. Gunakan setSpreadsheetId() terlebih dahulu.");
        }
    }
    
    /**
     * Check connection
     */
    public function testConnection()
    {
        try {
            $this->client->getAccessToken();
            return ['success' => true, 'message' => 'Connected successfully'];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}

