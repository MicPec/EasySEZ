{% extends:'layout' %}

{%block:pageTitle%}Kalendarz{%endblock%}

{%block:content%}
<div class="row">
    <div class="col-sm-12">
            {{ view:'chunks.calendar' }}
    </div>
</div>
{%endblock%}
