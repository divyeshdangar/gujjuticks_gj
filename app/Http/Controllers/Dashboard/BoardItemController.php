<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\WorkItem;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

class BoardItemController extends Controller
{
    public function updateItem(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item_id' => 'required|exists:work_items,id',
            'board_id' => 'required|exists:boards,id',
            'category_id' => 'required|exists:work_item_categories,id',
        ]);

        if ($validator->fails()) {
            //return redirect('dashboard/blog/edit/'.$id)->withErrors($validator)->withInput();
            $message = [
                "message" => "Validation error",
                "data" => $validator->errors()
            ];
        } else {
            $dataToInsert = $validator->validated();
            $dataDetailWI = WorkItem::find($dataToInsert['item_id']);
            if($dataDetailWI){
                $dataDetailWI->category_id = $dataToInsert['category_id'];
                $dataDetailWI->save();
                $message = [
                    "message" => "Record updated successfully"
                ];
            } else {
                $message = [
                    "message" => "Proper record not found"
                ];    
            }
        }
        return response()->json($message);
    }
}
