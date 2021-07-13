<?php

namespace App\Http\Controllers;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

class CommentsController extends Controller
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
    }

    public function getComments()
    {
        try {
            $reqData = $this->apiClient->get('comments');
            $comments = json_decode($reqData->getBody())->resource;
        } catch (RequestException $e) {
            return [];
        }

        return $comments;
    }

    public function addComments(Request $req)
    {
        if ($req->isMethod('post')) {
            $article = $req->input('article');
            $name = $req->input('name_comments');
            $comment = $req->input('txt_comments');
            $dataModel = [
                'resource' => []
            ];

            $dataModel['resource'][] = [
                'article' => $article,
                'author' => $name,
                'content' => $comment,
            ];

            try {
                $reqData = $this->apiClient->post('comments', [
                    'json' => $dataModel
                ]);

                return redirect("guest/articles/{$article}");
            } catch (Exception $e) {
                return 'send comments gagal';
            }
        }
    }
}
