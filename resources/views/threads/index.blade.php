@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @forelse($threads as $thread)

                    <div class="card mb-5">
                        <div class="card-header bg-dark text-light">
                            <div class="level">
                                <div class="flex">
                                    <h5>
                                        <a class="text-light" href="{{ $thread->path() }}">
                                            @if (auth()->check() && $thread->hasUpdatesFor(auth()->user()))
                                                <strong>{{ $thread->title }}</strong>
                                            @else
                                                {{ $thread->title }}
                                            @endif
                                        </a>
                                    </h5>

                                    <h6>posted by <a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a></h6>

                                </div>

                                <a class="text-light" href="{{ $thread->path() }}">
                                    <strong class="float-right">{{ $thread->replies_count }} {{ str_plural('reply', $thread->replies_count) }}</strong>
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="body">{{ $thread->body }}</div>
                        </div>
                    </div>
                @empty
                    <p class="text-dark">There is no threads on this channel</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
