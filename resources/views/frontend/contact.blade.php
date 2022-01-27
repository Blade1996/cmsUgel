@extends('frontend.layouts.home_layout')
@section('title', 'Contacto')
@section('content')
<div class="container mt-5" style="margin-bottom: 50px">
    <div class="row">
        <div class="col-lg-6">
            <!-- Post content-->
            <article>
                <!-- Post header-->
                <header class="mb-4">
                    <!-- Post title-->
                    <h3 class="fw-bolder mb-1">Formulario de contacto</h3>
                    <!-- Post meta content-->
                    <div class="text-muted fst-italic mb-2">Por favor llene el siguiente formulario para contactarnos
                        con usted. </div>
                    <!-- Post categories-->

                </header>
                <!-- Preview image figure-->
                <figure class="mb-4"></figure>


                <section id="contacto">
                    <div id="form-contacto" class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="section-title text-center mt-2 mb-2">
                            <h3 class="mb-3"></h3>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <label class="control-label">Nombres y apellidos</label>
                                <input maxlength="100" type="text" required="required" class="form-control"
                                    placeholder="" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top: 10px">
                            <div class="form-group">
                                <label class="control-label">Correo electrónico</label>
                                <input maxlength="100" type="email" required="required" class="form-control"
                                    placeholder="" />
                            </div>
                        </div>
                        <!--    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
         <div class="form-group">
             <label class="control-label">Soy un estudiante de:</label>
             <div class="form-group select">
                <select name="" id="" class="form-control" required="required">
                    <option value="">1er - 3er año</option>
                    <option value="">4to - 6to año</option>
                    <option value="">Interno</option>
                    <option value="">Médico egresado</option>
                </select>
             </div>
          </div>
        </div>-->
                        <!--<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
         <div class="form-group">
             <label class="control-label">Universidad</label>
             <div class="form-group select">
                <select name="" id="" class="form-control" required="required">
                    <option value="">Universidad Peruana de Ciencias Aplicadas</option>
                    <option value="">Universidad San Ignacio de Loyola</option>
                    <option value="">Universidad Pacífico</option>
                    <option value="">Universidad Privada del Norte</option>
                </select>
             </div>
          </div>
        </div>-->
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top: 10px">
                            <div class="form-group">
                                <label class="control-label">Teléfono</label>
                                <input maxlength="100" type="password" required="required" class="form-control"
                                    placeholder="" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top: 10px">
                            <div class="form-group">
                                <label class="control-label">Mensaje</label>
                                <textarea class="form-control" type="textarea" name="mensaje"></textarea>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-3" style="margin-top: 10px">
                            <a class="btn btn-outline-primary me-2" href="" style="width: 100%;">ENVIAR</a>
                        </div>
                    </div>
                </section>



            </article>

        </div>

        <div class="col-lg-6">
            <!-- Post content-->
            <article>
                <!-- Post header-->
                <header class="mb-4">
                    <!-- Post title-->
                    <h3 class="fw-bolder mb-1">Información de contácto</h3>
                    <!-- Post meta content-->
                    <div class="text-muted fst-italic mb-2">Por favor llene el siguiente formulario para contactarnos
                        con usted. </div>
                    <!-- Post categories-->

                </header>
                <!-- Preview image figure-->
                <figure class="mb-4"></figure>


                <section id="contacto">
                    <div id="form-contacto" class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                            <div class="icon-opening-wrapper">
                                <div class="icon-opening-container">
                                    <p class="icon-opening"><i class="fa fa-phone"></i></p>
                                    <p class="icon-opening-content">T: 555 555 555</p>
                                </div>
                            </div>
                            <div class="icon-opening-wrapper">
                                <div class="icon-opening-container">
                                    <p class="icon-opening"><i class="fa fa-location-arrow"></i></p>
                                    <p class="icon-opening-content">Jr. Lampa 555<br>
                                        Cercado de Lima, Perú</p>
                                </div>
                            </div>
                            <div class="icon-opening-wrapper">
                                <div class="icon-opening-container">
                                    <p class="icon-opening"><i class="fa fa-envelope"></i></p>
                                    <p class="icon-opening-content">info@ugelica.com</p>
                                </div>
                            </div>
                            <div class="icon-opening-wrapper">
                                <div class="icon-opening-container">
                                    <p class="icon-opening"><i class="fa fa-globe"></i></p>
                                    <p class="icon-opening-content">www.ugelica.com</p>
                                </div>
                            </div>
                            <div class="margin-40"></div>


                        </div>

                    </div>
                </section>



            </article>

        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    </div>
</div>
@endsection
