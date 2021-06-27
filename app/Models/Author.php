<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Author extends Model
{
    use HasFactory;

    protected static $url = 'https://randomuser.me/api/';

    public static function getAuthors($pageSize)
    {
        $response = Http::get(self::$url, [
            'results' => $pageSize
        ]);
        $content = $response->body();
        $results = json_decode($content)->results;

        $authors = array();
        foreach ($results as $author) {
            $authors[] = (object) [
                'name' => $author->name->first,
                'last' => $author->name->last,
                'fullname' => $author->name->first . ' ' . $author->name->last,
                'email' => $author->email
            ];
        }

        return $authors;
    }
}
