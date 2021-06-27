@extends('web.layout')
@section('content')

<div class="row gx-4 gx-lg-5 justify-content-center">
    <div class="col-md-10 col-lg-8 col-xl-7">

        @foreach ($news->articles as $index => $new)
        <!-- Post preview-->
        <div class="post-preview">
            <a href="{{ $new->url }}" target="_blank">
                <h2 class="post-title">{!! $new->title !!}</h2>
                <h3 class="post-subtitle">{!! $new->description !!}</h3>
            </a>
            <p class="post-meta">
                Escrito por
                <a href="mailto:{{ $authors[$index]->email }}">
                    {{ $authors[$index]->fullname }}
                </a>
                el {{ iconv('ISO-8859-2', 'UTF-8', strftime("%A, %d de %B de %Y", strtotime($new->publishedAt))) }}
            </p>
        </div>
        <!-- Divider-->
        <hr class="my-4" />
        @endforeach

        <!-- Paginacion-->
        <div class="d-flex justify-content-end mb-4">
            {!! $paginator->links() !!}
        </div>
    </div>
</div>

@stop