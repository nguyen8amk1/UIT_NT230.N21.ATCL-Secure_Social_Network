<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Note;

class NoteController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'content' => 'required|string'
        ]);

        $details = [
            'name' => $request->input('name'),
            'content' => $request->input('content')
        ];

        $note = new Note($details);
        if ($note->save())
            return [
                "status" => true,
                "msg" => "Note created! Use <a href=\"/get?id=$note->id\">Visit your note here</a>"
            ];
        else 
            return [
                "status" => false,
                "msg" => "Oops! Something went wrong"
            ];
    }
    
    public function get(Request $request)
    {
        $request->validate([
            'id' => 'required|integer'
        ]);

        $note = Note::where("id", "=", $request->input('id'))->first();
        if ($note)
            $var = [
                "status" => true,
                "name" => $note->name,
                "content" => $note->content,
            ];
        else 
            $var = [
                "status" => false,
                "name" => ":flag:",
                "content" => "Chúc may mắn :)",
            ];

        return view('getnote')->with($var);
    }
}
