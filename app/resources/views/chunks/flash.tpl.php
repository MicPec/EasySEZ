{% if (session()->hasFlash('msg')) %}
<?php $msg = explode('|', session()->getFlash('msg')); ?>
    <div class="alert alert-{{ trim($msg[1]??'info') }} fresh-color alert-dismissable fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ trim($msg[0]) }}
    </div>
{% endif %}
