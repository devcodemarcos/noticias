<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Illuminate\Http\Request;
use jcobhams\NewsApi\NewsApi;


class NewsController extends Controller
{

    private $page_size = 10;

    public function index(Request $request)
    {
        $page = $request->get('page') ?? 1;

        $q = "Apple";
        $sources = null;
        $domains = null;
        $exclude_domains = null;
        $from = "2021-06-26";
        $to = null;
        $language = 'en';
        // $sort_by = "popularity";
        $sort_by = null;

        $key = env('NEWS_APP_KEY', null);
        $newsApi = new NewsApi($key);
        $response = $newsApi->getEverything($q, $sources, $domains, $exclude_domains, $from, $to, $language, $sort_by, $this->page_size, $page);
        $news = $response->articles;
        // dd($response);
        // dd($news);

        $currentPage = Paginator::resolveCurrentPage();
        $col = collect($news);
        $currentPageItems = $col->slice(($currentPage - 1) * $this->page_size, $this->page_size)->all();

        // $items = new Paginator($currentPageItems, count($col), $perPage);
        $items = new Paginator($currentPageItems, $response->totalResults, $this->page_size);
        $items->setPath($request->url());
        $items->appends($request->all());
        // dd($items);

        return view('sections.news', compact('news', 'items'));
    }
}
