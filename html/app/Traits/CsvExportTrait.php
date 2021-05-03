<?php

namespace App\Traits;

trait CsvExportTrait 
{
    /**
     * Create a CSV file out from an array
     * 
     * @param string $name,
     * @param array $data
     * @return CSV
     */
    public function exportToCsv (string $name, string $location, array $data)
    {
        // Gets the column headers name
        $keys[0] = array_keys($data[0]);

        // Create directory in Storage, clear if there are any files inside
        $directory = storage_path('app/public' . $location);
        ( !\File::exists( $directory ) ) ? \File::makeDirectory( $directory, 0777, true ) : \File::cleanDirectory( $directory );

        // Define file name
        $fileName = $name . '.csv';

        // Open file a new empty file
        $fp = fopen( $directory . '/' . $fileName , 'w');

        // Write column headers name
        foreach ($keys as $key ) {
            fputcsv($fp, $key);
        }

        // Write values
        foreach ($data as $field) {
            fputcsv($fp, $field);
        }

        // Close file
        fclose($fp);

        return response()->download($directory . '/' . $fileName);
    }
}