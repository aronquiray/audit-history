<article class="timeline-entry">
    <div class="timeline-entry-inner">
        <div class="timeline-icon bg-primary">
            {{-- <i class="fa fa-check"></i> --}}
        </div>
        <div class="timeline-label">
            <time class="clearfix">
                <span>{{ $history->updated_at->timezone(auth()->check()?app('auth')->user()->timezone:app('app.timezone'))->format(config('halcyon-laravel.audit-history.formats.datetime_12')) }}</span>
                <span> {{ $history->created_at->timezone(auth()->check()?app('auth')->user()->timezone:app('app.timezone'))->diffForHumans() }}</span>
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
