<article class="timeline-entry">
    <div class="timeline-entry-inner">
        <div class="timeline-icon bg-primary">
            {{-- <i class="fa fa-check"></i> --}}
        </div>
        <div class="timeline-label">
            <time class="clearfix">
                @if(auth()->guest())
                    <span>{{ $history->updated_at->format(config('halcyon-laravel.history.formats.time_12')) }}</span>
                    <span>{{ $history->created_at->diffForHumans() }}</span>
                @else
                    <span>{{ $history->updated_at->timezone(app('auth')->user()->timezone)->format(config('halcyon-laravel.history.formats.time_12')) }}</span>
                    <span>{{ $history->created_at->timezone(app('auth')->user()->timezone)->diffForHumans() }}</span>
                @endif
            </time>
            <p>{!!
				__('audit-history::message.actions.' . $history->event,
					[
					    'name' => 'test',
					'user' => 'xxxx'])
			!!}</p>
        </div>
    </div>

</article>
