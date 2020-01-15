@php
    $isUserPost = $post->user_id === auth()->id();
@endphp
@extends('public.shared.layout')

@section('content')
    <div class="px-5 my-4">
        <div class="d-flex justify-content-between">
            <h1>{{ $post->title }}</h1>
            @if ($isUserPost)
                <div class="d-flex">
                    <div class="mr-2">
                        <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-primary">
                            <i class="fa fa-pencil mr-2"></i>
                            {{ __('Edit') }}
                        </a>
                    </div>
                    <div>
                        <a id="delete-post"
                            class="btn btn-danger"
                            href="{{ route('posts.destroy', ['post' => $post->id]) }}"
                        >
                            <i class="fa fa-trash mr-2"></i>
                            {{ __('Remove') }}
                        </a>
                    </div>
                </div>
            @endif
        </div>
        <h4 class="text-secondary font-weight-normal mt-3 mb-5">{{ $post->description }}</h4>
        <div class="d-flex justify-content-between mb-4">
            <div class="d-flex">
                <img class="avatar mr-3"
                    src="{{ $post->user->avatar }}"
                    alt="{{ $post->user->name }}"
                >
                <div class="d-flex flex-column">
                    <span>{{ $post->user->name }}</span>
                    <span class="text-secondary">{{ $post->created_at->format('M d, Y') }}</span>
                </div>
            </div>
            @include('public.shared.follow-button', [
                'user' => $post->user
            ])
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

        <div class="d-flex justify-content-between mt-5 mb-4">
            <div class="mr-4">
                @php $isLiked = $post->isLiked() @endphp
                <a id="like-action" href="#" class="d-flex align-items-center text-dark">
                    <i class="fa fa-thumbs-{{ $isLiked ? '' : 'o-' }}up fa-2x mr-2"></i>
                    <span class="text-dark fs-25">{{ $post->likes->count() }}</span>
                </a>
            </div>
            <form id="comment-form" class="w-100">
                <div class="input-group mb-3">
                    <input type="text" name="content" required class="form-control" placeholder="Write a comment..." aria-label="Write a comment..." aria-describedby="comment-buttom">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-success input-group-text" id="comment-buttom">Submit</button>
                    </div>
                </div>
            </form>
        </div>

        <h3 class="mb-5 pb-3 border-bottom">{{$post->comments->count() > 0 ? 'Comments' : 'Be first to comment!'}}</h3>

        <div id="comment-list">
            @foreach ($post->comments as $comment)
                <div class="d-flex" data-comment-id="{{ $comment->id }}">
                    <div class="d-flex mb-2">
                        <img class="avatar mr-3"
                            src="{{ $comment->user->avatar }}"
                            alt="{{ $comment->user->name }}"
                        >
                    </div>
                    <div class="d-flex flex-column mb-4 w-100">
                        <div class="d-flex flex-column">
                            <div class="d-flex justify-content-between">
                                <span>{{ $comment->user->name }}</span>
                                @if (auth()->id() === $comment->user->id)
                                    <a href="#" class="text-dark" data-remove-comment>
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </a>
                                @endif
                            </div>
                            <span class="text-secondary">{{ $comment->created_at->format('M d, Y') }}</span>
                        </div>
                        <div>{{ $comment->content }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection