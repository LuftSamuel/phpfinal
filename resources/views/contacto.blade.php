@include('cabecera')

<div class="tm-hero d-flex justify-content-center align-items-center" data-parallax="scroll" data-image-src="{{url('assets/img/hero.jpg')}}"></div>

<div class="container-fluid tm-mt-60">
    <div class="row tm-mb-50">
        <div class="col-lg-4 col-12 mb-5">
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
                <h2 class="tm-text-primary mb-5">Our Address</h2>
                <p class="tm-mb-50">Quisque eleifend mi et nisi eleifend pretium. Duis porttitor accumsan arcu id rhoncus. Praesent fermentum venenatis ipsum, eget vestibulum purus. </p>
                <p class="tm-mb-50">Nulla ut scelerisque elit, in fermentum ante. Aliquam congue mattis erat, eget iaculis enim posuere nec. Quisque risus turpis, tempus in iaculis.</p>
                <address class="tm-text-gray tm-mb-50">
                    120-240 Fusce eleifend varius tempus<br>
                    Duis consectetur at ligula 10660
                </address>
                <ul class="tm-contacts">
                    <li>
                        <a href="#" class="tm-text-gray">
                            <i class="fas fa-envelope"></i>
                            Email: info@company.com
                        </a>
                    </li>
                    <li>
                        <a href="#" class="tm-text-gray">
                            <i class="fa fa-phone"></i>
                            Tel: 010-020-0340
                        </a>
                    </li>
                    <li>
                        <a href="#" class="tm-text-gray">
                            <i class="fas fa-globe"></i>
                            URL: www.company.com
                        </a>
                    </li>
                </ul>
            </div>                
        </div>
        <div class="col-lg-4 col-12">
            <h2 class="tm-text-primary mb-5">Our Location</h2>
            <!-- Map -->
            <div class="mapouter mb-4">
                <div class="gmap-canvas">
                    <iframe width="100%" height="520" id="gmap-canvas"
                            src="https://maps.google.com/maps?q=Av.+L%C3%BAcio+Costa,+Rio+de+Janeiro+-+RJ,+Brazil&t=&z=13&ie=UTF8&iwloc=&output=embed"
                            frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                </div>
            </div>               
        </div>
    </div>

</div> <!-- container-fluid, tm-container-content -->

@include('pie')