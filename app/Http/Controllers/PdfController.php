<?php

namespace App\Http\Controllers;

use App\Models\Timesheet;
use App\Models\Personal;
use App\Models\Asistencia;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;



use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PdfController extends Controller
{
    //
    public function TimesheetRecords ($user){
        //$personal = Personal::findOrFail($user);
        $personal = Personal::where('qr', $user)->first();

        $imagePath = storage_path('app/public/' . $personal->image);
        $imageData = base64_encode(file_get_contents($imagePath));
        $imageSrc = 'data:image/png;base64,' . $imageData;

        $baseUrl = config('app.url'); // Obtiene la URL base de tu aplicación
        $qrUrl = $baseUrl . '/carnet/asistencia/' . $personal->qr;

        $codigoQr = QrCode::size(100)->generate($qrUrl); // Genera el código QR
      
        $pdf = Pdf::loadView('pdf.example',  compact('personal','codigoQr','imageSrc'));
        $name = Uuid::uuid4()->toString();
        return $pdf->download("$name.pdf");
    }


    public function carnet ($user){

        $personal = Personal::where('qr', $user)->first();
        if (!$personal) {
            return view('carnet', ['mensaje' => 'El empleado no está registrado en el sistema. Verifique el código QR o contacte al administrador.']);
        }

        $fechaActual = Carbon::now()->toDateString();
        $horaActual = Carbon::now()->toTimeString(); $asistenciaExistente = Asistencia::where('cedula', $personal->cedula)
        ->where('fecha', $fechaActual)
        ->first();

            if ($asistenciaExistente) {
                // Si ya existe un registro, verifica si tiene hora de salida
                if ($asistenciaExistente->hora_salida) {
                    return view('carnet', ['mensaje' => 'Asistencia de entrada y salida registrada en el día de hoy.']);
            
                } else {
                    // Si no tiene hora de salida, actualiza la hora de salida
                    $asistenciaExistente->hora_salida = $horaActual;
                    $asistenciaExistente->save();
                    return view('carnet', ['mensaje' => 'Hora de salida registrada correctamente.']);
            }
            } else {
                // Si no existe un registro, crea uno nuevo
                Asistencia::create([
                    'cedula' => $personal->cedula,
                    'fecha' => $fechaActual,
                    'hora_entrada' => $horaActual,
                ]);
                return view('carnet', ['mensaje' => 'Hora de entrada registrada correctamente.']);
       
            }
    }





}
