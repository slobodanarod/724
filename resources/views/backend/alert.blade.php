@if(session("message"))
    <div class="alert text-center alert-{{ session("message_type") }}">{{session("message")}}</div>
@endif
