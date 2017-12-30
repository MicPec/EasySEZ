<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="myModalLabel">Jesteś pewny?</h4>
</div>
<form method="POST" id="confirm" role="dialog" action="{{ $action ?? '#' }}">
	<div class="modal-body">
        <input type="hidden" name="csrf_token" value="{{ $session->generateOneTimeToken() }}"/>
        {% foreach (($data??[]) as $key => $value) %}
        	<input type="hidden" name="{{ $key }}" value="{{ $value }}" />
        {% endforeach %}
		<h3 class="text-center">{{ $question ?? 'Jesteś pewny?' }}</h3>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-primary" data-dismiss="modal">Nie</button>
		<button type="submit" class="btn btn-danger">Tak</button>
	</div>
</form>
