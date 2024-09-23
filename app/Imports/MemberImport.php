<?php

namespace App\Imports;

use App\Models\Member;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class MemberImport implements ToCollection, WithBatchInserts, WithChunkReading, SkipsEmptyRows, WithHeadingRow
{
    use RemembersRowNumber;
    private $userId = null;
    private $counts = [
        "success" => 0,
        "failed" => 0,
        "message" => ""
    ];

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @param array $row
     *
     * @return Member|null
     */
    public function collection(Collection $rows)
    {        
        foreach ($rows as $row) 
        {
            $msg = "";
            $email = ($row && !empty($row['email'])) ? $row['email'] : "";
            if(!empty($email)){
                $msg .= $email; 
                print_r([
                    "email" => $email,
                    "user_id" => $this->userId
                ]);
                $data = Member::where([
                    "email" => $email,
                    "user_id" => $this->userId
                ])->get();

                if($data->count() > 0) {
                    $msg .= " - Request already sent";
                    $this->counts["failed"] = $this->counts["failed"] + 1;
                } else {
                    $dataDetail = new Member;
                    $dataDetail->email = $email;
                    $dataDetail->user_id = $this->userId;
                    $user = User::whereEmail($email)->first();
                    if($user){
                        $msg .= " - Request sent"; 
                        $dataDetail->member_id = $user->id;
                        $data = [
                            'message_tag' => 'msg.new_member_request',
                            'user_id' => $user->id,
                            'user_id2' => $this->userId,
                        ];
                        Notification::create($data);
                        $this->counts["success"] = $this->counts["success"] + 1;
                    } else {
                        if( $row && !empty($row['create_new']) && $row['create_new'] == '1'){
                            if(!empty($row['first_name']) && !empty($row['last_name'])) {
                                $data = [
                                    'name' => $row['first_name']." ".$row['last_name'], 
                                    'first_name' => $row['first_name'], 
                                    'last_name' => $row['last_name'], 
                                    'email' => $email, 
                                    'login_type' => 'SL',
                                    'profile' => 'default.png',
                                    'password' => \Hash::make(rand(100000, 999999))
                                ];
                                $user = User::create($data);
                                if(isset($user->id)){
                                    $msg .= " - New user created"; 
                                    $dataDetail->member_id = $user->id;
                                    $dataDetail->first_name = $row['first_name'];
                                    $dataDetail->last_name = $row['last_name'];
                                    $dataDetail->create_new = '1';
                                    if( $row && !empty($row['directly_accept_request']) && $row['directly_accept_request'] == '1'){
                                        $msg .= " - Accepted directly"; 
                                        $dataDetail->status = 1;
                                        $dataDetail->directly_accepted = '1';
                                    }
                                    $msg .= " - ".$user->id; 
                                    $data = [
                                        'message_tag' => 'msg.new_member_request',
                                        'user_id' => $user->id,
                                        'user_id2' => $this->userId,
                                    ];
                                    Notification::create($data);
                                    $dataDetail->save();
                                    $this->counts["success"] = $this->counts["success"] + 1;
                                } else {
                                    $msg .= " - Unknown issue";
                                    $this->counts["failed"] = $this->counts["failed"] + 1;    
                                }
                            } else {
                                $msg .= " - Firstname or lastname missing";    
                            }
                        } else {
                            $msg .= " - No user created";
                            $this->counts["failed"] = $this->counts["failed"] + 1;
                        }
                    }
                }
            } else {
                $msg .= "No email found"; 
                $this->counts["failed"] = $this->counts["failed"] + 1;
            }
            $this->counts["message"] .= $msg."\n";
        }
    }

    // For large size record to insert. Interface WithBatchInserts
    public function batchSize(): int
    {
        return 500;
    }

    // For large size file. Interface WithChunkReading
    public function chunkSize(): int
    {
        return 500;
    }

    public function getCounts()
    {
        return $this->counts;
    }

    public function headingRow(): int
    {
        return 1;
    }
}
