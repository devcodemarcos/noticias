<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use jcobhams\NewsApi\NewsApi;

class News extends Model
{
    use HasFactory;

    public static function getNews($pageSize, $page)
    {
        $key = env('NEWS_APP_KEY', false);
        $newsApi = new NewsApi($key);
        $response = $newsApi->getEverything('Apple', null, null, null, '2021-06-26', null, 'es', null, $pageSize, $page);
        return (object) [
            'totalResults' => $response->totalResults,
            'articles' => $response->articles
        ];
    }
}
