<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Historia zlecenia #{{ $statuslog[0]->order->id}}</h4>
</div>
    <div class="modal-body">
      <table class="table table-striped table-condensed table-responsive table-dynamic">
          <thead>
              <tr>
                  <th>Data</th>
                  <th>Status</th>
                  <th>Komentaż</th>
                  <th>Użytkownik</th>
              </tr>
          </thead>
          <tbody>
              {% foreach ($statuslog as $log) %}
              <tr>
                  <td data-label="Data">{{ $log->date }}</td>
                  <td data-label="Status" class='ellipsis'>{{ $log->status }}</td>
                  <td data-label="Komentaż" class='ellipsis'>{{ $log->comment }}</td>
                  <td data-label="Użytkownik" class='ellipsis'>{{ $log->username }}</td>
              </tr>
              {% endforeach %}
          </tbody>
      </table>
  </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Zamknij</button>
    </div>
