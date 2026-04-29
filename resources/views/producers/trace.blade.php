@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8"> 

        <div class="card fondo-blanco">
            <div class="card-header">
                <div class="float-start">
                    <h3 class="texto-guinda">Trazabilidad</h3>
                </div>
                <div class="float-end">
                    <a href="{{ route('home') }}" class="btn btn-secondary btn-sm">&larr; Regresar</a>
                </div>
            </div>
            <div class="card-body">
                
                <form action="{{ route('producers.traces') }}" id="idForm" method="post">
                    @csrf

                    <br>
                    <div class="mb-3 row">
                        <div class="col-md-auto text-start" style="display: contents;">
                            <em class="fas fa-store texto-guinda" style="padding-top: 10px;padding-left: 80px;"></em>
                        </div>
                        <div class="col text-start" style="padding-right: 110px;">
                            <label for="id" class="col-form-label text-md-end text-start control-label texto-guinda">
                                Identificador:
                            </label><br>
                            <span class="texto-guinda">Pase la tarjeta del productor por el escáner.</span>
                            <input type="password" class="form-control @error('id') is-invalid @enderror" id="id" name="id" 
                                placeholder="Escaner código qr" required>
                                @if ($errors->has('id'))
                                    <span class="text-danger">{{ $errors->first('id') }}</span>
                                @endif
                        </div>
                    </div>
                    <br>

                    
<!-- QR Scan  
                    <div class="text-center">
                        <button type="button" class="btn btn-secondary" id="open-qr-scanner" style="width:160px;"><em class="fas fa-qrcode"></em> Escanear QR</button>
                    </div>

                    <br>
                    <div id="qr-reader" style="width:100%; height:300px; display:none;"></div>
                    <br>
-->

                    <div class="text-center">
                        <input type="submit" class="btn btn-primary" value="Continuar" style="width:150px;">
                    </div>
                    
                </form>
            </div>
        </div>
    </div>    
</div>

<!-- Include the QR Code Scanner library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js" integrity="sha512-r6rDA7W6ZeQhvl8S7yRVQUKVHdexq+GAlNkNNqVC7YyIV+NwqCTJe2hDWCiffTyRNOeGEzRRJ9ifvRm/HCzGYg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Initialize QR Scanner functionality -->
<script>
    document.getElementById('open-qr-scanner').addEventListener('click', function() {
        // Show the QR reader container
        document.getElementById("qr-reader").style.display = "block";

        // Initialize the QR code scanner
        const qrScanner = new Html5QrcodeScanner("qr-reader", {
            fps: 10,
            qrbox: 250
        });

        // Render the scanner and handle the decoded QR code
        qrScanner.render(function(decodedText) {
            // Use decoded QR text to populate the input field
            document.getElementById("id").value = decodedText;
            // Stop scanning after a successful read
            qrScanner.clear();
            // Hide the scanner
            document.getElementById("qr-reader").style.display = "none";
        });
    });
</script>

{!! JsValidator::formRequest('App\Http\Requests\IdentificadorRequest', '#idForm') !!}

@endsection
