<article class="timeline-entry">
    <div class="timeline-entry-inner">
        <div class="timeline-icon bg-primary">
            {{-- <i class="fa fa-check"></i> --}}
        </div>
        <div class="timeline-label">
            <time class="clearfix">
                <span>{{ $history->updated_at->timezone(auth()->check()?app('auth')->user()->timezone:config('app.timezone'))->format(config('halcyon-laravel.audit-history.formats.datetime_12')) }}</span>
                <span> {{ $history->created_at->timezone(auth()->check()?app('auth')->user()->timezone:config('app.timezone'))->diffForHumans() }}</span>
            </time>
            <p>{!!
				__('audit-history::message.actions.' . $history->event,
					[
					    'user' => $history->user->{config('halcyon-laravel.audit-history.user.name_attribute')},
					    'name' => $history->auditable->label_attirbute,
					])
			!!}</p>
        </div>
    </div>

</article>
