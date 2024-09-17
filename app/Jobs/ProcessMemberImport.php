<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Imports\MemberImport;
use App\Imports\Member;
use Illuminate\Container\Attributes\Auth;
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
            Excel::import(new MemberImport($this->userId), base_path().'\public\import\member\\'.$this->importMember->file);
        } catch (\Throwable $th) {
            print_r($th->getMessage());
        }
    }
}
