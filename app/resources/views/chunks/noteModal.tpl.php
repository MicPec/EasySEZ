<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Notatka do zlecenia #{{ $order->id ?? null }}</h4>
</div>
    <div class="modal-body">
        <textarea type="text" class="form-control" id="note" rows="16" style="resize: none;" readonly>{{ $order->note ?? null }}</textarea>
  </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Zamknij</button>
    </div>
