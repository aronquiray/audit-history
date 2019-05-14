@php
    $date = $history->updated_at->timezone(auth()->check()?app('auth')->user()->{config('audit-history.user.fields.timezone')}:config('app.timezone'));
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
					    'user' => $history->user? $history->user->{config('audit-history.user.name_attribute')}:'unknown',
					    'name' => \HalcyonLaravel\AuditHistory\Helpers::getAuditableName($history),
					])
			!!}</p>
        </div>
    </div>

</article>
