<ul class="pagination">
    {% if(isset($first)) %}
        <li><a href="{{preserve:$first}}"><i class="glyphicon glyphicon-step-backward"></i></a></li>
    {% endif %}
    {% if(isset($previous)) %}
        <li><a href="{{preserve:$previous}}"><i class="glyphicon glyphicon-chevron-left"></i></a></li>
    {% endif %}
    {% foreach($pages as $page) %}
        {% if($page['is_current']) %}
            <li class="active"><span>{{$page['number']}}</span></li>
        {% else %}
            <li><a href="{{preserve:$page['url']}}">{{$page['number']}}</a></li>
        {% endif %}
    {% endforeach %}
    {% if(isset($next)) %}
        <li><a href="{{preserve:$next}}"><i class="glyphicon glyphicon-chevron-right"></i></a></li>
    {% endif %}
    {% if(isset($last)) %}
        <li><a href="{{preserve:$last}}"><i class="glyphicon glyphicon-step-forward"></i> <i class="btn-primary btn-xs">{{preserve: $number_of_pages}}</i></a></li>
    {% endif %}
</ul>
