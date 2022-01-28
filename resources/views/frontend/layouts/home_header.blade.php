<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3">
    <div class="container">
        <div class="row">
            <a id="logo" href="{{ route('home') }}"
                class="me-auto align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
                <img class="img-fluid" src="{{ $companyData->companyInfo->url_company }}" alt=""
                    style="height: 50px; width: auto;">
            </a>

            <div id="btn-intranet" class="col-md-2 d-flex text-right">
                <button type="button"
                    onclick="window.open('http://200.48.65.242/sisgedonew/app/main.php?_op=1I&_type=L&_nameop=Login%20de%20Acceso', '_blank')"
                    class="btn btn-outline-primary me-2">Intranet</button>
                <button type="button" class="btn btn-outline-primary me-2">Transparencia</button>
            </div>
        </div>
    </div>
</header>
