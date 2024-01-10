<script type="module" src="{{ asset('/js/bootstrap.min.js') }}"></script>
<script type="module" src="{{ asset('/js/app.js') }}"></script>
<script src="/js/fontawesome.js"></script>
<script src="/js/jquery-3.2.1.min.js"></script>
<script src="/js/open_modal.js"></script>
<script type="module">

    const modalLoader = $('#modal-loader');

    const showLoader = function() {
        modalLoader.removeClass('fade');
        modalLoader.modal({backdrop: "static", keyboard: false});
        modalLoader.modal('show');
        modalLoader.addClass('show-loader');
    }

    const btn_submit = document.getElementById('form_save');
    const linkEl = document.getElementById('link');

    btn_submit.addEventListener("submit", () => {
        if(linkEl.value.trim()){
            showLoader();
        }
    })

</script>
@stack('scripts')
