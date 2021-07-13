<?php

namespace App\Http\Controllers;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\CommentsController;


class GuestsController extends Controller
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

    public function guestArticles()
    {
        $data = Cache::get('index', function () {
            try {
                $reqData = $this->apiClient->get('articles');
                $resource = json_decode($reqData->getBody())->resource;
                Cache::add('index', $resource);
            } catch (RequestException $e) {
                return [];
            }
        });

        return view('guest.index', ['data' => $data]);
    }

    public function guestArticlesDetail($id)
    {
        $key = "articles/{$id}";
        $data = Cache::get($key, function () use ($key) {
            try {
                $reqData = $this->apiClient->get($key);
                $resource = json_decode($reqData->getBody());

                Cache::add($key, $resource);
                return $resource;
            } catch (Exception $e) {
                abort(404);
            }
        });

        $comments = $this->comments->getComments();

        return view('guest.articles-detail', ['data' => $data, 'comments' => $comments]);
    }
}
