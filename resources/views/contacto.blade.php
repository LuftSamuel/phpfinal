@include('cabecera')

<div class="tm-hero d-flex justify-content-center align-items-center" data-parallax="scroll" data-image-src="{{url('assets/img/hero.jpg')}}"></div>

<div class="container-fluid tm-mt-60">
    <div class="row tm-mb-50">
        <div class="col-lg-4 col-12 mb-5">
            @if (Session::has('alert-success'))
                <div class="alert alert-success alert-dismissible"><em>
                        {!! session('alert-success') !!}</em>
                </div>
            @endif
            <h2 class="tm-text-primary mb-5">Formulario de contacto</h2>
            <form id="contact-form" action="" method="POST" class="tm-contact-form mx-auto">
                @csrf
                <!-- nombre -->
                @if ($errors->has('nombre'))
                <span class="alert-danger">
                    <strong>{{ $errors->first('nombre') }}</strong>
                </span>
                @endif
                <div class="form-group">
                    <input type="text" name="nombre" value="{{ old('nombre') }}" class="form-control rounded-0" placeholder="Nombre" required />
                </div>
                <!-- email -->
                @if ($errors->has('email'))
                <span class="alert-danger">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
                <div class="form-group">
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control rounded-0" placeholder="Email" required />
                </div>
                <!-- motivo -->
                <div class="form-group">
                    <select class="form-control" id="contact-select" name="motivo">
                        <option value="0" @if(old('motivo')==0) selected @endif>Compra de articulos al por mayor</option>
                        <option value="1" @if(old('motivo')==1) selected @endif>Otra consulta</option>
                    </select>
                </div>
                <!-- mensaje -->
                @if ($errors->has('mensaje'))
                <span class="alert-danger">
                    <strong>{{ $errors->first('mensaje') }}</strong>
                </span>
                @endif
                <div class="form-group">
                    <textarea rows="8" name="mensaje"  class="form-control rounded-0" placeholder="Mensaje" required=>{{ old('mensaje') }}</textarea>
                </div>
                <!-- Captcha -->
                @if ($errors->has('g-recaptcha-response'))
                <span class="alert-danger">
                    <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                </span>
                @endif
                <div class="form-group">
                    {!! NoCaptcha::renderJs('es') !!}
                    {!! NoCaptcha::display() !!}
                </div>
                <!-- submit -->
                <div class="form-group tm-text-right">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </form>
       
        </div>
        <div class="col-lg-4 col-12 mb-5">
            <div class="tm-address-col">
                <h2 class="tm-text-primary mb-5">Quienes somos</h2>
                <p class="tm-mb-50">Somos un pequeño emprendimiento familiar que se dedica al cultivo y venta de plantas de distinto 
                    tipo al por mayor y por menor.<br><br>Vendemos articulos al por menor casi siempre con fines decorativos, pero tambien
                     se incluyen arboles frutales por unidad (orquideas, helechos, cactus, mandarina, ciruela, etc).<br><br>
                     Dentro la categoria de articulos al por mayor encontramos plantas como pino, kiri, eucalipto y
                      tambien mandarina, limon, ciruela, etc. (siempre en grandes cantidades).<br><br>
                    Tambien es posible pedir mediante el formulario de contacto articulos que normalmente se venderian solo al por menor
                     como por ejemplo, 100 orquideas, 50 helechos, etc.</p>
                <p class="tm-mb-50">Nos encontramos sobre la ruta 12 poco antes del parador de 3 de Mayo.</p>

                <ul class="tm-contacts">
                    <li>
                        <a href="#" class="tm-text-gray">
                            <i class="fas fa-envelope"></i>
                            Email: info@cactusinc.com
                        </a>
                    </li>
                    <li>
                        <a href="#" class="tm-text-gray">
                            <i class="fa fa-phone"></i>
                            Tel: 3743501512
                        </a>
                    </li>
                    
                </ul>
            </div>                
        </div>
        <div class="col-lg-4 col-12">
            <h2 class="tm-text-primary mb-5">Nuestra ubicacion</h2>
            <!-- Map -->
            <div class="mapouter mb-4">
                <div class="gmap-canvas">
                    <iframe width="100%" height="520" id="gmap-canvas"
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14245.184641588643!2d-54.9052557!3d-26.798697!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94f8293e358f16a5%3A0xea36780eaf44dc19!2sParador%20Tres%20De%20Mayo.%20Garuhape%20Misiones%20Argentina!5e0!3m2!1ses!2sar!4v1646859118260!5m2!1ses!2sar"
                            frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                </div>
            </div>               
        </div>
    </div>

</div> <!-- container-fluid, tm-container-content -->

@include('pie')