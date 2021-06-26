@extends('web.layout')
@section('content')

<div class="row gx-4 gx-lg-5 justify-content-center">
    <div class="col-md-10 col-lg-8 col-xl-7">

        @foreach ($news as $new)
        <!-- Post preview-->
        <div class="post-preview">
            <a href="{{ $new->url }}" target="_blank">
                <!-- <h2 class="post-title">Man must explore, and this is exploration at its greatest</h2> -->
                <h2 class="post-title">{{ $new->title }}</h2>
                <h3 class="post-subtitle">{!! $new->description !!}</h3>
            </a>
            <p class="post-meta">
                Escrito por
                <a href="#!">Start Bootstrap</a>
                en {{ $new->publishedAt }}
            </p>
        </div>
        <!-- Divider-->
        <hr class="my-4" />
        @endforeach


        <!-- Pager-->
        <div class="d-flex justify-content-end mb-4">
            {!! $items->links() !!}
        </div>
    </div>
</div>

@stop