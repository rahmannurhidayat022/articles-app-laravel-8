<?php

namespace App\Http\Controllers;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class AuthorsController extends Controller
{
    public const API_BASE = "https://blog-api.stmik-amikbandung.ac.id/api/v2/blog/_table/";
    public const API_KEY = "ef9187e17dce5e8a5da6a5d16ba760b75cadd53d19601a16713e5b7c4f683e1b";
    private $apiClient;

    public function __construct()
    {
        $this->apiClient = new Client([
            'base_uri' => self::API_BASE,
            'headers' => [
                'X-DreamFactory-API-Key' => self::API_KEY
            ]
        ]);
        $this->comments = new CommentsController();
    }

    public function authors(Request $req)
    {
        if ($req->isMethod('post')) {
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

                return back()->with('success', 'Your Author Data Submitted in API');
            } catch (Exception $e) {
                return back()->with('failed', 'Your Author Data failed submitted');
            }
        }
        return view('authors.profile');
    }
}
