<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusLikesController extends Controller
{


    public function store(Status $status)
    {
        $status->like();

        /*$status->likes()->create([
           'user_id' => auth()->id()
        ]);*/

        return [
            'response' => 'success',
            'likes_count' => $status->likesCount()
            ];
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Status $status
     * @return array
     */
    public function destroy(Status $status)
    {
        $status->unlike();

        return [
            'response' => 'success',
            'likes_count' => $status->likesCount()
        ];
    }
}
