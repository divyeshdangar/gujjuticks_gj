<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Imports\MemberImport;
use Maatwebsite\Excel\Facades\Excel;

class ProcessMemberImport implements ShouldQueue
{
    use Queueable;
    protected $importMember;
    protected $userId;

    /**
     * Create a new job instance.
     */
    public function __construct($importMember, $userId)
    {
        $this->importMember = $importMember;
        $this->userId = $userId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $import = new MemberImport($this->userId);
            Excel::import($import, base_path().'\public\import\member\\'.$this->importMember->file);
            $count = $import->getCounts();
            
            $this->importMember->notes = $count["message"];
            $this->importMember->success_count = $count["success"];
            $this->importMember->failed_count = $count["failed"];
            $this->importMember->status = '1';
            $this->importMember->update();
        } catch (\Throwable $th) {
            print_r($th->getMessage());
        }
    }
}
