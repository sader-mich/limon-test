<?php


namespace App\Http\Controllers;

use App\Models\Producer;
use App\Models\Localidad;
use App\Models\Municipio;
use App\Models\Documento;
use App\Models\Descuento;
use App\Http\Requests\StoreProducerRequest;
use App\Http\Requests\UpdateProducerRequest;
use App\Imports\ProducersImport;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Exceptions\NoTypeDetectedException;
use Maatwebsite\Excel\Concerns\ImportFailed;
use Illuminate\Support\Facades\Log;
use Zxing\QrReader;
use Carbon\Carbon;
use JsValidator;
use Exception;
use GdImage;
use Illuminate\Support\Facades\Gate;

class ProducerController extends Controller
{
    //Display a listing of the resource.
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:crear_productor|editar_productor|eliminar_productor|show', ['only' => ['index','show']]);
        $this->middleware('permission:crear_productor', ['only' => ['create','store']]);
        $this->middleware('permission:editar_productor', ['only' => ['edit','update']]);
        $this->middleware('permission:eliminar_productor', ['only' => ['destroy']]);
        $this->middleware('permission:trazabilidad', ['only' => ['trace', 'traces']]);
    }

    public function index(): View
    {
        return view('producers.index', [
            'producers' => Producer::latest()->get()
        ]);
    }

    public function create(): View
    {
        $localidads = Localidad::all();
        $municipios = Municipio::all();
        $documentos = Documento::where('estatus', 'Aprobado')
                        ->whereDoesntHave('producer')
                        ->get();;

        return view('producers.create', [
            'localidads' => $localidads,
            'municipios' => $municipios,
            'documentos' => $documentos
        ]);
    }
    public function store(StoreProducerRequest $request): RedirectResponse
    {
        try{
            $documento = Documento::where('id', $request->documento_id)->first();
            $productor = $documento->productor;
            $identificador = $documento->identificador;

            //url de la imagen qr bd
            $urlqr = 'CodeQr/'.$productor.'_'.$identificador.'_QR.png';
            $urlcard = 'Card/tarjeta_'.$productor.'_'.$identificador.'.png';
            $request['urlqr']= $urlqr;
            $request['urlcard']= $urlcard;
            $request['descuento']= 0;
            $request['predio']= 'NA';
            $request['siembra_id']= 'NA';

            $localidad = Localidad::where('id', $request->localidad_id)->first();
            $municipio = Municipio::where('id', $request->municipio_id)->first();
            $request['municipio'] = mb_strtoupper($municipio->descripcion);
            $request['localidad']= mb_strtoupper($localidad->descripcion);

            //Guardar productor
            $create = Producer::create($request->all());

            //Llamar funcion para generar tarjeta digital
            $controller = new ProducerController();
            $controller->card($request);

        }catch(Exception $e){
            Log::error($e);
            notyf()
                ->position('y', 'top')
                ->position('x', 'center')
                ->duration(10000)
                ->addError('Error, intente nuevamente');
            return redirect()->route('producers.index');
        }
        activity()
                ->performedOn($create)
                ->causedBy(Auth::user()->id)
                ->withProperties(['attributes' => $create->attributesToArray()])
                ->log('Se agrego un nuevo productor');

        notyf()
            ->position('y', 'top')
            ->position('x', 'center')
            ->duration(10000)
            ->addSuccess('El productor se ha registrado');
        return redirect()->route('producers.index');
    }
    public function show(Producer $producer): View
    {
        return view('producers.show', [
            'producer' => $producer
        ]);
    }
    //Show the form for editing the specified resource.
    public function edit(Producer $producer): View
    {
        $localidads = Localidad::all();
        $municipios = Municipio::all();
        return view('producers.edit', [
            'producer' => $producer,
            'localidads' => $localidads,
            'municipios' => $municipios
        ]);
    }    
    //Update the specified resource in storage.
    public function update(UpdateProducerRequest $request, Producer $producer): RedirectResponse
    {
        try{
            $productor = $producer->documento->productor;
            $identificador = $producer->documento->identificador;
            $urlqr = 'CodeQr/'.$productor.'_'.$identificador.'_QR.png';
            $urlcard = 'Card/tarjeta_'.$productor.'_'.$identificador.'.png';
            $request['documento_id']= $producer->documento_id;
            $request['urlqr']= $urlqr;
            $request['urlcard']= $urlcard;

            if($request['descuento'] == $producer->descuento){
                $request['descuento'] = $producer->descuento;
            }

            if (Localidad::where('id', $request->localidad_id)->first() != null){
                $localidad = Localidad::where('id', $request->localidad_id)->first();
                $request['localidad']= mb_strtoupper($localidad->descripcion);
            }
            if(Municipio::where('id', $request->municipio_id)->first() != null){
                $municipio = Municipio::where('id', $request->municipio_id)->first();
                $request['municipio'] = mb_strtoupper($municipio->descripcion);
            }
            // Verificar si qr y la tarjeta existe en el almacenamiento y eliminarlo si es así
            if (Storage::disk('public')->exists($urlqr)) {
                Storage::disk('public')->delete($urlqr);
            }
            if (Storage::disk('public')->exists($urlcard)) {
                Storage::disk('public')->delete($urlcard);
            }

            $controller = new ProducerController();
            $controller->cardUpdate($request, $producer);
            $producer->update($request->all());

        }catch(Exception $e){
            Log::error($e);
            notyf()
                ->position('y', 'top')
                ->position('x', 'center')
                ->duration(10000)
                ->addError('Error, intente nuevamente');
            return redirect()->route('producers.index');
        }
        activity()
                ->performedOn($producer)
                ->causedBy(Auth::user()->id)
                ->withProperties(['attributes' => $producer->attributesToArray()])
                ->log('Se actualizo un productor');
        notyf()
                ->position('y', 'top')
                ->position('x', 'center')
                ->duration(10000)
                ->addSuccess('El productor se ha actualizado');
        return redirect()->route('producers.index');

    }
    //Remove the specified resource from storage.
    public function destroy(Request $request): RedirectResponse
    {
        try{
            $producer = Producer::findOrFail($request->productorEliminar);
            //Eliminar qr y tarjeta
            $urlqr = $producer->urlqr;
            $urlcard = $producer->urlcard;
            if (Storage::disk('public')->exists($urlqr)) {
                Storage::disk('public')->delete($urlqr);
            }
            if (Storage::disk('public')->exists($urlcard)) {
                Storage::disk('public')->delete($urlcard);
            }
            $descuentos = Descuento::where('producer_id', $request->productorEliminar)->first();
            if($descuentos){$descuentos->delete();}
            $producer->delete();

        }catch(Exception $e){
            Log::error($e);
            notyf()
                ->position('y', 'top')
                ->position('x', 'center')
                ->duration(10000)
                ->addError('Error, intente nuevamente');
            return redirect()->route('producers.index');
        }
        activity()
                ->performedOn($producer)
                ->causedBy(Auth::user()->id)
                ->withProperties(['attributes' => $producer->attributesToArray()])
                ->log('Se elimino un productor');
        notyf()
                ->position('y', 'top')
                ->position('x', 'center')
                ->duration(10000)
                ->addSuccess('El productor se ha eliminado');
        return redirect()->route('producers.index');
    }
    public function trace(): View
    {
        return view('producers.trace');
    }
    public function traces(Request $request)
    {
        // Obtener el valor de $request->id y extraer la primera cadena de números antes de un espacio
        //preg_match('/^\d+/', $request->id, $matches);

        $id = $request->id;

        preg_match('/^\w+/', $request->id, $matches);
        $id = isset($matches[0]) ? $matches[0] : null;
        $id = base64_decode($id);


        $registro = Documento::where('identificador', $id)->first();

        if(is_null($registro)){
            notyf()
                ->position('y', 'top')
                ->position('x', 'center')
                ->duration(10000)
                ->addError('Error, identificador no valido');
            return redirect()->route('producers.trace');
        }
        $producer = Producer::where('documento_id', $registro->id)->first();
        if(is_null($producer)){
            notyf()
                ->position('y', 'top')
                ->position('x', 'center')
                ->duration(10000)
                ->addError('Error, identificador no valido');
            return redirect()->route('producers.trace');
        }
        /*
        // Verificar si el usuario tiene permiso para editar productores
        if (Gate::allows('editar_productor')) {
            // Redirigir a la función 'edit' del controlador 'ProducerController'
            return redirect()->route('producers.edit', ['producer' => $producer]);
        }
        */
        return view('producers.traces', [
            'producer' => $producer

        ]);
    }
    public function deliver(Request $request, $id)
    {
        try{
            $producer = Producer::where('id', $id)->first();
            $descuento = $producer->descuento;
            $ton = $request->ton;
            $dif = $producer->toneladas - $descuento;

            $request['descuento']= $descuento+$ton;
            if($ton > $dif){
                notyf()
                ->position('y', 'top')
                ->position('x', 'center')
                ->duration(30000)
                ->ripple(true)
                ->dismissible(true)
                ->addError('No se puede llevar acabo el registro. <br/> El saldo por movilizar excede el limite de toneladas.');
            return redirect()->route('producers.trace');
        }

            $producer->update($request->all());

            $data['producer_id'] = $id;
            $data['toneladas'] = $ton;
            $dif = $dif - $ton;

            // Guardar Descuento
            Descuento::create($data);

        }catch(Exception $e){
            Log::error($e);
            notyf()
                ->position('y', 'top')
                ->position('x', 'center')
                ->duration(10000)
                ->addError('Error, intente nuevamente');
            return redirect()->route('producers.index');
        }

        activity()
                ->performedOn($producer)
                ->causedBy(Auth::user()->id)
                ->withProperties(['attributes' => $producer->attributesToArray()])
                ->log('Se realizo descuento en caseta');

        return view('producers.message', [
            'producer' => $producer,
            'ton' => $ton,
            'dif' => $dif
        ]);
    }
    public function card(StoreProducerRequest $request)
    {
        $controller = new ProducerController();

        $documento = Documento::where('id', $request->documento_id)->first();
        $id = $documento->identificador;
        $identificador = $documento->identificador;
        $productor= $documento->productor;
        $fecha_alta = $request->fecha_alta;
        $fecha = Carbon::parse($fecha_alta)->format('d-m-Y');
        $huerto = $request->huerto;

        //Craer qr del productor
        //Cadena de texto para el qr
        $encryptedId = base64_encode($id);

        $textqr = $encryptedId."\n\nSader Michoacan\nCertificado de origen y movilización de limón mexicano\nVIGENTE";
        $textqr = $controller->removeAccents($textqr);

        $dir_qr= 'CodeQr/'.$productor.'_'.$identificador.'_QR.png';

        //https://github.com/chillerlan/php-qrcode/tree/main Documentación de la libreria para la creación del qr
        //construccion de qr
        $qrcode=QrCode::size(350)
                    ->style('round')
                    ->eye('circle')
                    ->margin(1)
                    ->color(74, 0, 31)
                    ->format('png')
                    ->merge('/public/img/logo_sader.png', .3)
                    ->errorCorrection('H')
                    ->generate($textqr);

        // Guardar el código QR en el almacenamiento (storage/app/public/CodeQr)
        Storage::put('public/' . $dir_qr, $qrcode);

        $im = imagecreatefrompng('img/base.png');

        //Creación de la terjeta digital del productor
        $controller->cardText('PRODUCTOR:', 480, $im, 'titulo');
        $controller->cardText($identificador, 515,  $im, 'texto');
        $controller->cardText('FECHA DE REGISTRO:', 560, $im, 'titulo');
        $controller->cardText($fecha, 595, $im, 'texto');
        $controller->cardText($huerto, 175, $im, 'huerto');

        // Guardar la imagen como 'base2.png'
        imagePNG($im, 'img/base2.png');

        // Liberar memoria
        imagedestroy($im);

        //IMAGE_MERGE
        // Crear instancias de imágenes
        $filePath = storage_path('app/public/' . $dir_qr);
        $origen = imagecreatefrompng($filePath);
        $destino = imagecreatefrompng('img/base2.png');

        // Copiar y fusionar
        imagecopy($destino, $origen, 608, 60, 0, 0, 350, 350);

        // Definir el nombre del archivo final
        $finalFileName = 'tarjeta_' .$productor.'_'.$identificador.'.png';
        $finalFilePath = 'Card/' . $finalFileName;

        // Guardar la imagen final en una ruta temporal
        $tempPath = sys_get_temp_dir() . '/' . $finalFileName;
        imagepng($destino, $tempPath);

        // Leer el contenido del archivo temporal
        $imageContent = file_get_contents($tempPath);

        // Guardar la imagen final en el almacenamiento público
        Storage::disk('public')->put($finalFilePath, $imageContent);

        imagedestroy($destino);
        imagedestroy($origen);
        unlink('img/base2.png');
    }
    public function cardUpdate(UpdateProducerRequest $request, Producer $producer)
    {
        $controller = new ProducerController();
        $id = $producer->documento->identificador;
        $identificador = $producer->documento->identificador;
        $productor = $producer->documento->productor;
        $timestamp = $producer->created_at;
        $fecha = Carbon::parse($timestamp)->format('d-m-Y');
        $huerto = $request->huerto;

        //Crear qr del productor
        //Cadena de texto para el qr
        $encryptedId = base64_encode($id);
        $textqr = $encryptedId."\n\nSader Michoacan\nCertificado de origen y movilización de limón mexicano\nVIGENTE";
        $textqr = $controller->removeAccents($textqr);

        $dir_qr= 'CodeQr/'.$productor.'_'.$identificador.'_QR.png';

        //construccion de qr
        $qrcode= QrCode::size(350)
                    ->style('round')
                    ->eye('circle')
                    ->margin(1)
                    ->color(74, 0, 31)
                    ->format('png')
                    ->merge('/public/img/logo_sader.png', .3)
                    ->errorCorrection('H')
                    ->generate($textqr);

        // Guardar el código QR en el almacenamiento (storage/app/public/CodeQr)
        Storage::put('public/' . $dir_qr, $qrcode);

        // Crear una imagen en blanco y añadir algún texto
        $im = imagecreatefrompng('img/base.png');

        //Creación de la terjeta digital del productor
        $controller->cardText('PRODUCTOR:', 480, $im, 'titulo');
        $controller->cardText($identificador, 515, $im, 'texto');
        $controller->cardText('FECHA DE REGISTRO:', 560, $im, 'titulo');
        $controller->cardText($fecha, 595, $im, 'texto');
        $controller->cardText($huerto, 175, $im, 'huerto');

        // Guardar la imagen como 'base2.png'
        imagePNG($im, 'img/base2.png');

        // Liberar memoria
        imagedestroy($im);

        //IMAGE_MERGE
        // Crear instancias de imágenes
        $filePath = storage_path('app/public/' . $dir_qr);
        $origen = imagecreatefrompng($filePath);
        $destino = imagecreatefrompng('img/base2.png');

        //$origen = imagescale($im2, 400, 400);

        // Copiar y fusionar
        imagecopy($destino, $origen, 608, 60, 0, 0, 350, 350);

        // Definir el nombre del archivo final
        $finalFileName = 'tarjeta_' . $productor .'_'.$identificador. '.png';
        $finalFilePath = 'Card/' . $finalFileName;

        // Guardar la imagen final en una ruta temporal
        $tempPath = sys_get_temp_dir() . '/' . $finalFileName;
        imagepng($destino, $tempPath);

        // Leer el contenido del archivo temporal
        $imageContent = file_get_contents($tempPath);

        // Guardar la imagen final en el almacenamiento público
        Storage::disk('public')->put($finalFilePath, $imageContent);

        imagedestroy($destino);
        imagedestroy($origen);
        unlink('img/base2.png');
    }
    public function removeAccents(string $text) {
        $unwantedArray = [
            'Á'=>'A', 'À'=>'A', 'Â'=>'A', 'Ä'=>'A', 'Ã'=>'A', 'Å'=>'A', 'Ā'=>'A', 'Ă'=>'A', 'Ą'=>'A', 'Ǎ'=>'A',
            'á'=>'a', 'à'=>'a', 'â'=>'a', 'ä'=>'a', 'ã'=>'a', 'å'=>'a', 'ā'=>'a', 'ă'=>'a', 'ą'=>'a', 'ǎ'=>'a',
            'É'=>'E', 'È'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ē'=>'E', 'Ĕ'=>'E', 'Ė'=>'E', 'Ę'=>'E', 'Ě'=>'E',
            'é'=>'e', 'è'=>'e', 'ê'=>'e', 'ë'=>'e', 'ē'=>'e', 'ĕ'=>'e', 'ė'=>'e', 'ę'=>'e', 'ě'=>'e',
            'Í'=>'I', 'Ì'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ĩ'=>'I', 'Ī'=>'I', 'Ĭ'=>'I', 'Į'=>'I', 'İ'=>'I',
            'í'=>'i', 'ì'=>'i', 'î'=>'i', 'ï'=>'i', 'ĩ'=>'i', 'ī'=>'i', 'ĭ'=>'i', 'į'=>'i', 'ı'=>'i',
            'Ó'=>'O', 'Ò'=>'O', 'Ô'=>'O', 'Ö'=>'O', 'Õ'=>'O', 'Ō'=>'O', 'Ŏ'=>'O', 'Ő'=>'O',
            'ó'=>'o', 'ò'=>'o', 'ô'=>'o', 'ö'=>'o', 'õ'=>'o', 'ō'=>'o', 'ŏ'=>'o', 'ő'=>'o',
            'Ú'=>'U', 'Ù'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ũ'=>'U', 'Ū'=>'U', 'Ŭ'=>'U', 'Ů'=>'U', 'Ű'=>'U', 'Ų'=>'U',
            'ú'=>'u', 'ù'=>'u', 'û'=>'u', 'ü'=>'u', 'ũ'=>'u', 'ū'=>'u', 'ŭ'=>'u', 'ů'=>'u', 'ű'=>'u', 'ų'=>'u',
            'Ç'=>'C', 'Ć'=>'C', 'Ĉ'=>'C', 'Ċ'=>'C', 'Č'=>'C',
            'ç'=>'c', 'ć'=>'c', 'ĉ'=>'c', 'ċ'=>'c', 'č'=>'c',
            'Ñ'=>'N', 'Ń'=>'N', 'Ņ'=>'N', 'Ň'=>'N', 'Ŋ'=>'N',
            'ñ'=>'n', 'ń'=>'n', 'ņ'=>'n', 'ň'=>'n', 'ŋ'=>'n',
            'Ý'=>'Y', 'Ÿ'=>'Y', 'Ŷ'=>'Y',
            'ý'=>'y', 'ÿ'=>'y', 'ŷ'=>'y'
        ];
        return strtr($text, $unwantedArray);
    }
    public function cardText(string $txt, int $nextLinePosition, GdImage $im, string $type){

        $color = imagecolorallocate($im, 255, 255, 255);

        //saltos de linea prueba
        $txt = wordwrap($txt, (350/10));
        $lines = explode("\n", $txt);

        $lineHeight = 30;
        $cont = 0;

       // Ruta a nuestro archivo de fuente ttf
        switch ($type) {
            case 'titulo':
                $archivo_fuente = public_path('gibson-italic-webfont.woff');
                $color = imagecolorallocate($im, 255, 255, 255);
                $font_size = 13;
                break;
            case 'huerto':
                $archivo_fuente = public_path('gibson-book-webfont.woff');
                $color = imagecolorallocate($im, 0, 0, 0);
                $font_size = 18;
                break;
            default:
                $archivo_fuente = public_path('gibson-book-webfont.woff');
                $color = imagecolorallocate($im, 255, 255, 255);
                $font_size = 18;
                break;
        }

        $txt = wordwrap($txt, (350 / 10)); // Wrap text into lines
        $lines = explode("\n", $txt);

        $lineHeight = 30; // Set the height between lines
        $imageWidth = 550; // Assuming the image width

        foreach ($lines as $line) {
            // Calculate the width of the text line using the font and font size
            $bbox = imagettfbbox($font_size, 0, $archivo_fuente, trim($line));
            $textWidth = $bbox[2] - $bbox[0]; // Text width (bbox[2] is the rightmost X, bbox[0] is the leftmost X)

            // Calculate the padding to center the text
            $padding = ($imageWidth - $textWidth) / 2;
            if($type != 'huerto'){
                $padding = $padding+513;
            }


            // Draw the text centered horizontally and vertically with line height adjustment
            imagefttext($im, $font_size, 0, $padding, $nextLinePosition, $color, $archivo_fuente, trim($line));

            // Move to the next line's vertical position
            $nextLinePosition += $lineHeight;
        }
    }

    public function getLocalidades($municipioId) {
        $localidades = Localidad::where('municipioid', $municipioId)->pluck('descripcion', 'id');
        return json_encode($localidades);
    }

    public function import(Request $request)
    {
        try {
            if ($request->hasfile('file')) {
                $extension = $request->file->getClientOriginalExtension();
                if ($extension == 'xlsx') {
                    $import = new ProducersImport();
                    Excel::import($import, $request->file('file'));

                    // Generate a card for each newly imported producer
                    foreach ($import->getImportedProducers() as $producer) {
                        // Create a StoreProducerRequest or pass relevant data for each producer
                        $storeProducerRequest = new StoreProducerRequest([
                            'documento_id' => $producer->documento_id,  // adjust as per actual field name
                            'huerto' => $producer->huerto,  // adjust as per actual field name
                            'fecha_alta' => $producer->fecha_alta,  // adjust as per actual field name
                        ]);
                        // Call the card method
                        $this->card($storeProducerRequest);
                    }

                    notyf()
                        ->position('y', 'top')
                        ->addSuccess('registros importados correctamente');
                    return redirect()->back();
                } else {
                    notyf()
                        ->position('y', 'top')
                        ->addError('Error, verifique que el formato del archivo sea correcto (.xlsx)');
                    return redirect()->back();
                }
            } else {
                notyf()
                    ->position('y', 'top')
                    ->addError('Seleccione un archivo antes de importar');
                return redirect()->back();
            }
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $error_message = '';
            foreach ($failures as $failure) {
                $error_message = $error_message."Hubo un error en la fila " . $failure->row() . ", columna " . $failure->attribute() . ". " . implode(", ", $failure->errors())."\n";
            }
            notyf()
                ->position('y', 'top')
                ->duration(0)
                ->ripple(false)
                ->dismissible(true)
                ->addError($error_message);
            return redirect()->back();
        }catch (NoTypeDetectedException $e) {
            notyf()
            ->position('y', 'top')
            ->addError('Seleccione un archivo antes de importar');
            return redirect()->back();
        } catch (Exception $e) {
            notyf()
                ->position('y', 'top')
                ->addError('Error, intente nuevamente');
            return redirect()->back();
        }
    }

}
