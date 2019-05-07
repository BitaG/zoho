<div class="toast-group container-fluid fixed-bottom">
    <div class="row px-4 justify-content-end">
        <div id="msg" role="alert" aria-live="assertive" aria-atomic="true" class="toast" data-autohide="true" data-delay="5000">
            <div class="toast-header" >
                <img src="{{asset('images/favicon.png')}}" class="mr-2" height="20">
                <strong class="mr-auto">SendPulse</strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="msgText" class="toast-body px-3 py-4">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>