<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Zmień status dla zlecenia #{{ $order->id}}</h4>
</div>
<form class="modalform" method="POST" role="dialog" action="/order/{{$order->id}}/changestatus" data-toggle="validator">
    <div class="modal-body">
        <input type="hidden" name="csrf_token" value="{{ one_time_token() }}">
        <div class="form-group">
          <div class="form-group">
            <label for="status">Status</label>
        <select class="ajaxselect form-control" data--minimumResultsForSearch="10" data-ajax--url="/api/getStatuses" type="text" name="status" id="status" required>
            <option value="{{ $order->status_id ?? null }}">{{ $order->status->name ?? null }}</option>
        </select>
      </div>
        <div class="form-group"><label for="comment">Komentarz</label>
          <input type="text" maxlength="255" class="form-control" id="comment" name="comment" placeholder="Opcjonalny komentarz"/>
        </div>
      </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
        <button type="submit" class="btn btn-primary">Zapisz</button>
    </div>
</form>
