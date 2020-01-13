@extends('public.shared.layout')

@section('content')
    <div class="px-5 my-4">
        <h1>{{ $post->title }}</h1>
        <h3 class="text-secondary font-weight-normal mt-3 mb-5">
            {{ $post->description }}
        </h3>

        <div class="d-flex mb-5">
            <img
                class="avatar mr-3"
                src="{{ $post->user->avatar }}"
                alt="{{ $post->user->name }}"
            >
            <div class="d-flex flex-column">
                <span>{{ $post->user->name }}</span>
                <span class="text-secondary">{{ $post->created_at->format('M d, Y') }}</span>
            </div>
        </div>

        <div class="d-flex justify-content-center mb-5">
            <img 
                class="img-fluid"
                src="{{ $post->main_photo }}"
                alt="{{ $post->title }}"
            >
        </div>

        <div id="content" class="mb-5"></div>
        <textarea id="content-ta" class="d-none">{{ $post->content }}</textarea>

        @include('public.category.tag-category-list', [
            'categories' => $post->categories
        ])

        <div class="d-flex mt-5">
            <div class="mr-4">
                <a href="#" class="text-danger" data-user-action="like">
                    <i class="fa fa-heart{{ $post->isLiked() ? '' : '-o' }} fa-2x"></i>
                    <span class="text-dark fs-25 ml-1">
                        {{ $post->likes->count() }}
                    </span>
                </a>
            </div>
            <div class="mr-4">
                <a href="#" class="text-dark" data-user-action="comment">
                    <i class="fa fa-comment-o fa-2x"></i>
                    <span class="text-dark fs-25 ml-1">
                        {{ $post->comments->count() }}
                    </span>
                </a>
            </div>
            <div>
                <a href="#" class="btn btn-outline-success" data-user-action="like">
                    Follow
                </a>
            </div>
        </div>

        @if ($post->comments->count() > 0)
            <h3 class="my-5 pb-3 border-bottom">Comments</h3>
            @foreach ($post->comments as $comment)
                <div class="d-flex">
                    <div class="d-flex mb-2">
                        <img
                            class="avatar mr-3"
                            src="{{ $comment->user->avatar }}"
                            alt="{{ $comment->user->name }}"
                        >
                    </div>
                    <div class="d-flex flex-column mb-4">
                        <div class="d-flex flex-column">
                            <span>{{ $comment->user->name }}</span>
                            <span class="text-secondary">{{ $comment->created_at->format('M d, Y') }}</span>
                        </div>
                        <div>{{ $comment->content }}</div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection