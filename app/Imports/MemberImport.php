<?php

namespace App\Imports;

use App\Models\ImportRecord;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class MemberImport implements ToModel, WithBatchInserts, WithChunkReading, SkipsEmptyRows //, WithHeadingRow, ShouldQueue, 
{
    use RemembersRowNumber;
    private $rowDigit = 0;

    /**
     * @param array $row
     *
     * @return ImportRecord|null
     */
    public function model(array $row)
    {
        echo "<pre>";
        print_r($row);
        die;
        
        if(!empty($row[0])){
            $latLong = explode(",", $row[5]);
            $data = [
                'name' => $row[0],
                'image' => ($row && !empty($row[1])) ? $row[1] : "",
                'description' => ($row && !empty($row[2])) ? $row[2] : "",
                'latitude' => ($latLong && !empty($latLong[0])) ? trim($latLong[0]) : "",
                'longitude' => ($latLong && !empty($latLong[1])) ? trim($latLong[1]) : "",
            ];
            
            print_r($data);            
            //return new Location($data);
        }

        $this->rowDigit++;
        die;
    }

    // For large size record to insert. Interface WithBatchInserts
    public function batchSize(): int
    {
        return 1000;
    }

    // For large size file. Interface WithChunkReading
    public function chunkSize(): int
    {
        return 1000;
    }

    // public function headingRow(): int
    // {
    //     return 1;
    // }
}
