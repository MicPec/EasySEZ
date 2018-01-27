<?php
 	$months = ['styczeń', 'luty', 'marzec', 'kwiecień', 'maj', 'czerwiec', 'lipiec', 'sierpień', 'wrzesień', 'październik', 'listopad', 'grudzień'];
  $weekdays = [ 'Nd', 'Pn', 'Wt', 'Śr', 'Cz', 'Pi', 'So'];
?>
<div class="panel panel-primary fresh-color  wow bounceInUp" data-wow-duration=".5s">
	<div class="panel-heading">
		<h4 class=" pull-left text-capitalize"><span class="fa fa-calendar fa-fw"></span> {{ $months[$calendar->month()-1] }} {{ $calendar->year() }}</h4>
		<div class="btn-group pull pull-right" role="group" aria-label="...">
			<a class="btn btn-default fresh-color btn-sm" role="button" href="{{preserve:url()->to('/calendar', $calendar->previous()) }}"><span class="fa fa-chevron-left"> </span></a>
			<a class="btn btn-default fresh-color btn-sm" role="button" href="{{preserve:url()->to('/calendar', $calendar->today()) }}"><span class="fa fa-calendar-check-o"> </span></a>
			<a class="btn btn-default fresh-color btn-sm" role="button" href="{{preserve:url()->to('/calendar', $calendar->next()) }}"><span class="fa fa-chevron-right"> </span></a>
		</div>
		<div class="clearfix"></div>
	</div>
	<!-- /.panel-heading -->
	<div class="panel-body">

		<div id="calendar-wrap">
			<div id="calendar">
				<ul class="weekdays">
					{% foreach ([1,2,3,4,5,6,0] as $dayLabel) %}
					<li>{{ $weekdays[$dayLabel] }}</li>
					{% endforeach %}
				</ul>

				<ul class="days">
					{% foreach ($calendar->get() as $year) %}
						{% foreach ($year['months'] as $month) %}
							{% foreach ($month['weeks'] as $week) %}
					 			{% foreach ([1,2,3,4,5,6,0] as $weekday) %}
					 				{% foreach ($week['days'] as $day) %}
					 					{% if ($day['weekday'] == $weekday) %}
											<li class="{{ $month['value'] != $calendar->month()?'other-month':'' }}
                                {{ $weekday==0?'sunday':'' }}
                                {{ date('Y-m-d',strtotime($year['value'].'-'.$month['value'].'-'.$day['value']))==date('Y-m-d')?'today':'' }}">

												<div class="label label-pill label-{{ $month['value'] != $calendar->month()?'default':'info' }} date"><div class="weekday">{{ $weekdays[$weekday] }}</div> {{ $day['value'] }}</div>


												{% foreach ($day['events'] as $event) %}
												<div class="event {{ $event['type'] }} " style="background-color: {{ $event['order']->status->color??null }}">
													<a href="{{ url()->to('/orders?id='.$event['order']->id) }}">#{{ $event['order']->id }}</a>
													<div class="event-desc">
														{{ $event['order']->product->name ?? null }} ({{ $event['order']->status->name ?? null }})<br>
														{{ $event['order']->client->sname ?? null}} {{ $event['order']->client->fname ?? null }} ({{ $event['order']->client->company ?? null }})
													</div>
												</div>

												{% endforeach %}
											</li>
										{% endif %}
									{% endforeach %}
								{% endforeach %}
							{% endforeach %}
						{% endforeach %}
					{% endforeach %}
				</ul>

			</div>
		</div>

	</div>
</div>
