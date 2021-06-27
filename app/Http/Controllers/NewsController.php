<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Illuminate\Http\Request;

use App\Models\Author;
use App\Models\News;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->get('page') ?? 1;
        $pageSize = 10;

        try {
            $news = News::getNews($pageSize, $page);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $error = json_decode((string) $response->getBody());
                return view('sections.error', compact('error'));
            }
        }

        $authors = Author::getAuthors($pageSize);

        $currentPage = Paginator::resolveCurrentPage();
        $col = collect($news->articles);
        $currentPageItems = $col->slice(($currentPage - 1) * $pageSize, $pageSize)->all();

        $paginator = new Paginator($currentPageItems, $news->totalResults, $pageSize);
        $paginator->setPath($request->url());
        $paginator->appends($request->all());

        return view('sections.news', compact('news', 'authors', 'paginator'));
    }
}
