<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Dodaj flagę do zlecenia #{{ $order->id}}</h4>
</div>
<form method="POST" role="dialog" action="/order/{{$order->id}}/addflag">
    <div class="modal-body">
        <input type="hidden" name="csrf_token" value="{{$session->generateOneTimeToken()}}">
        <select class="ajaxselect form-control" data--minimumResultsForSearch="10" data-ajax--url="/api/getFlags" type="text" name="flag" id="flag" data-placeholder="Dodaj flagę" required>
            <option></option>
        </select>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
        <button type="submit" class="btn btn-primary">Zapisz</button>
    </div>
</form>
