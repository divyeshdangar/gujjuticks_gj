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
            $email = ($row && !empty($row['email'])) ? $row['email'] : "";
            if(!empty($email)){

                $data = Member::where([
                    "email" => $email,
                    "user_id" => $this->userId
                ])->get();

                if($data->count() > 0) {
                    // Request already sent
                } else {
                    $dataDetail = new Member;
                    $dataDetail->email = $email;
                    $dataDetail->user_id = $this->userId;
                    $user = User::whereEmail($email)->first();
                    if($user){
                        $dataDetail->member_id = $user->id;
                        $data = [
                            'message_tag' => 'msg.new_member_request',
                            'user_id' => $user->id,
                            'user_id2' => $this->userId,
                        ];
                        Notification::create($data);
                    } else {
                        if( $row && !empty($row['create_new']) && $row['create_new'] == '1'){
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
                                $dataDetail->member_id = $user->id;
                                if( $row && !empty($row['directly_accept_request']) && $row['directly_accept_request'] == '1'){
                                    $dataDetail->status = 1;
                                }
                                $data = [
                                    'message_tag' => 'msg.new_member_request',
                                    'user_id' => $user->id,
                                    'user_id2' => $this->userId,
                                ];
                                Notification::create($data);
                            }
                        }
                    }
                    $dataDetail->save();
                }
                // [no] => 2
                // [email] => sample@email.com1
                // [first_name] => Sample
                // [last_name] => One
                // [create_new] => 0
                // [create_new] => 0
                // [directly_accept_request] => 0

                $data = [
                    'user_id' => $this->userId,
                    'member_id' => '',
                    'email' => $email,
                    'total_request' => '1',
                    'status' => '0'
                ];                
            }
            print_r($data);
        }
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

    public function headingRow(): int
    {
        return 1;
    }
}
