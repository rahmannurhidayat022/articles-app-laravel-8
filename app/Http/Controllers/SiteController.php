<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\CommentsController;

class SiteController extends Controller
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

    public function index()
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

        //auth  authors
        $authorsData = $this->apiClient->get('authors');
        $authors = json_decode($authorsData->getBody())->resource;


        $author_existing = null;

        foreach ($authors as $item) {
            if ($item->email == Auth::user()->email) {
                $author_existing = true;
            }
        }

        return view('authors.index', ['data' => $data, 'author_existing' => $author_existing]);
    }

    public function articlesDetail($id)
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

        return view('authors.articles-detail', ['data' => $data, 'comments' => $comments]);
    }

    public function articlesAdd(Request $req)
    {
        if ($req->isMethod('post')) {
            $title = $req->input('frm-title');
            $content = $req->input('frm-content');
            $dataModel = [
                'resource' => []
            ];

            date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d h:i:sa');

            $dataModel['resource'][] = [
                'author' => '69',
                'title' => $title,
                'content' => $content,
                'published_at' => $date,
            ];

            try {
                $reqData = $this->apiClient->post('articles', [
                    'json' => $dataModel
                ]);
                $apiRespone = json_decode($reqData->getBody())->resource;
                $newId = $apiRespone[0]->id;

                Cache::forget('index');

                return redirect("/articles/detail/{$newId}");
            } catch (Exception $e) {
                return 'gagal add article';
            }
        }

        return view('authors.articles-add');
    }

    public function articlesEdit(Request $req, $id)
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

        if ($req->isMethod('post')) {
            $title = $req->input('frm-title');
            $content = $req->input('frm-content');
            $author = $req->input('author');
            $created_at = $req->input('created_at');

            $key = "articles/{$id}";

            $dataModel = [
                'resource' => []
            ];

            date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d h:i:sa');

            $dataModel['resource'][] = [
                'id' => $id,
                'author' => $author,
                'title' => $title,
                'content' => $content,
                'published_at' => $date,
                'created_at' => $created_at
            ];


            try {
                $reqData = $this->apiClient->put('articles', [
                    'json' => $dataModel
                ]);

                $apiRespone = json_decode($reqData->getBody())->resource;

                Cache::forget('index');
                Cache::forget($key);

                return redirect("/articles/detail/{$id}");
            } catch (Exception $e) {
                abort(501);
            }
        }

        return view('authors.articles-edit', ['data' => $data]);
    }

    public function articlesDelete($id)
    {
        $key = "articles/{$id}";
        try {
            $data = $this->apiClient->delete($key);
            Cache::forget('index');
            if ($data) {
                return redirect('/home')->with('success', 'Artikel berhasil terhapus!');
            } else {
                return redirect('/home')->with('failed', 'Terjadi kesalahan saat proses penghapusan Artikel.Silahkan Ccoba lagi..');
            }
        } catch (Exception $e) {
            abort(404);
        }
    }
}
