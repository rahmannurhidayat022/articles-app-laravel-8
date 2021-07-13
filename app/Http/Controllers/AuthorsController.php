<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class AuthorsController extends Controller
{
    public function authors(Request $req)
    {
        $name = $req->input('name_author');
        $email = $req->input('email_author');

        $dataModel['resource'][] = [
            'name' => $name,
            'email' => $email
        ];

        try {
            $reqData = $this->apiClient->post('authors', [
                'json' => $dataModel
            ]);

            return redirect('/home');
        } catch (Exception $e) {
            return back();
        }
    }
}
