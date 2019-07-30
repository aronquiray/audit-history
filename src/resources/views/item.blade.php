@php
    $date = app('audit-history.helpers')->getUpdatedAtWithTimezone($history);
@endphp
<article class="timeline-entry">
    <div class="timeline-entry-inner">
        <div class="timeline-icon bg-primary">
        </div>
        <div class="timeline-label">
            <time class="clearfix">
                <span>{{ $date->format(config('audit-history.formats.datetime_12')) }}</span>
                -
                <span>{{ $date->diffForHumans() }}</span>
            </time>
            <p>{!!
				__('audit-history::message.actions.' . $history->event,
					[
					    'user' => app('audit-history.helpers')->getUserName($history),
					    'name' => app('audit-history.helpers')->getAuditableName($history),
					])
			!!}</p>
        </div>
    </div>

</article>
