<?php

namespace App\Http\Controllers;

use App\Models\Entidad;
use App\Models\Grupo;
use App\Models\Historico;
use App\Models\Persona;
use App\Models\ViewFCFemenino;
use App\Models\ViewEdad;
use App\Models\ViewFCMasculino;
use App\Models\ViewIMC;
use App\Models\viewPAFemenino;
use App\Models\viewPAMasculino;
use App\Models\ViewIMCNew;
use Faker\Provider\ar_EG\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function show(): View
    {
        return view('person_table', [
            'entidad' => Entidad::where('estado', 1)->get(),
            'grupo' => Grupo::where('estado', 1)->get(),
            'edad' => ViewEdad::where('edad', '<>', '')->get(),
        ]);
    }

    public function register(): View
    {
        return view(
            'person_register',
            [
                'entidad' => Entidad::where('estado', 1)->get(),
                'grupo' => Grupo::where('estado', 1)->get(),
            ]
        );
    }

    public function metrica(string $documento): View
    {
        $response = ['status' => 200, 'message' => 'Registro guardado.', 'data' => []];

        try {

            $persona = Persona::where('documento', $documento)->first();

            $response['data'] = [
                'person' => $persona,
                'entidad' => Entidad::where('estado', 1)->get(),
                'grupo' => Grupo::where('estado', 1)->get(),
            ];
        } catch (\Throwable $th) {
        }

        return view(
            'person_metrica',
            $response['data']
        );
    }

    public function person(Request $request)
    {
        $response = ['status' => 200, 'message' => '', 'data' => []];
        try {

            $response['data'] =  Persona::where('entidad', $request->entidad)
                ->where('grado', $request->grado)
                ->where('grupo', $request->grupo)
                ->where('estado', 1)
                ->get();
        } catch (\Throwable $th) {
        }

        return response()->json($response);
    }

    /**
     * Consulta de datos por solo Institución
     */
    public function reporteInstitucion(Request $request)
    {
        $response = ['status' => 200, 'message' => '', 'data' => []];
        try {

            $response['data'] =  Persona::where('entidad', $request->entidad)
                ->where('estado', 1)
                ->get();
        } catch (\Throwable $th) {
        }

        return response()->json($response);
    }

    /**
     * Consulta de datos por Grado 
     */
    public function reporteGrado(Request $request)
    {
        $response = ['status' => 200, 'message' => '', 'data' => []];
        try {

            $response['data'] =  Persona::where('grado', $request->grado)
                ->where('estado', 1)
                ->get();
        } catch (\Throwable $th) {
        }

        return response()->json($response);
    }

    /**
     * Consulta de datos por Grupo
     */
    public function reporteGrupo(Request $request)
    {
        $response = ['status' => 200, 'message' => '', 'data' => []];
        try {

            $response['data'] =  Persona::where('grupo', $request->grupo)
                ->where('estado', 1)
                ->get();
        } catch (\Throwable $th) {
        }

        return response()->json($response);
    }

    /**
     * Consulta de datos para ternar la genero
     */
    public function reporteGenero(Request $request)
    {
        $response = ['status' => 200, 'message' => '', 'data' => []];
        try {

            $response['data'] =  Persona::where('genero', $request->genero)
                ->where('estado', 1)
                ->get();
        } catch (\Throwable $th) {
        }

        return response()->json($response);
    }
    
    /**
     * Consulta de datos para ternar la jornada
     */
    public function reporteJornada(Request $request)
    {
        $response = ['status' => 200, 'message' => '', 'data' => []];
        try {

            $response['data'] =  Persona::where('jornada', $request->jornada)
                ->where('estado', 1)
                ->get();
        } catch (\Throwable $th) {
        }

        return response()->json($response);
    }
    /**
     * Consulta de datos para ternar la edad
     */
    public function reporteEdad(Request $request)
    {
        $response = ['status' => 200, 'message' => '', 'data' => []];
        try {
            
            $response['data'] =  DB::select("CALL obtenerRegistrosPorEdad(?)", array($request->edad));

            return response()->json($response);

        } catch (\Throwable $th) {
            return json_encode(['status' => 500, 'message' => $th->getMessage()]);

        }

    }

    /**
     * Consulta de datos para ternar la edad
     */
    public function dataEdad(Request $request)
    {
        $response = ['status' => 200, 'message' => '', 'data' => []];
        try {

            $response['data']  = ViewEdad::where('edad', '<>', '')
            ->get();

        } catch (\Throwable $th) {
        }

        return response()->json($response);
    }

    /**
     * Consulta multiple por select desde campos 
     */
    public function selectForInputFront(Request $request)
    {
        $response = ['status' => 200, 'message' => '', 'data' => []];
        try {

            $customQuery = "SELECT * FROM PERSONA WHERE ";

            //echo $customQuery;

            $edad = $request->edad;
            //var_dump($edad);
            $grado = $request->grado;
            //var_dump($grado);
            $grupo = $request->grupo;
            //var_dump($grupo);
            $identidad = $request->identidad;
            //var_dump($identidad);
            $jornada = $request->jornada;
            //var_dump($jornada);
            $genero = $request->genero;
            //var_dump($genero);

            
            if($grado !== 'default'){
                $customQuery .= " grado = '$grado' AND";
            }
            if($grupo !== 'default'){
                $customQuery .= " grupo = '$grupo' AND";
            }
            if($identidad !== 'default'){
                $customQuery .= " entidad = '$identidad' AND";
            }
            if($jornada !== 'default'){
                $customQuery .= " jornada = '$jornada' AND";
            }
            if($genero !== 'default'){
                $customQuery .= " genero = '$genero' AND";
            }
            if($edad !== 'default'){
                $customQuery .= " DATE_FORMAT(nacimiento, '%Y') = DATE_FORMAT(DATE_SUB(CURRENT_DATE, interval '$edad'  YEAR), '%Y') AND";
            }

            if(substr($customQuery,-4) === " AND" ){
                $customQuery = substr($customQuery,0,-4);
                $customQuery .= " AND estado = '1'";
            }

            // Imprimir el query utilizando echo o var_dump
            //echo "Query: " . $customQuery;
   

            $response['data']  = DB::select($customQuery);

            return response()->json($response);

        } catch (\Throwable $th) {
            return json_encode(['status' => 500, 'message' => $th->getMessage()]);
        }

    }



    public function personDoco(Request $request)
    {
        $response = ['status' => 200, 'message' => '', 'data' => []];

        try {
            $response['data'] = Persona::where('documento', $request->doco)
                ->where('estado', 1)
                ->get();
        } catch (\Throwable $th) {
            $response['message']=$th->getMessage().' - '.$th->getLine();
        }
        return response()->json($response);
    }

    public function personDelete(Request $request)
    {
        $response = ['status' => 200, 'message' => 'Movido a la papelera.', 'data' => []];

        try {
            Persona::where('id', $request->id)
                ->update(
                    [
                        'estado' => 0,
                    ]
                );
        } catch (\Throwable $th) {
        }

        return response()->json($response);
    }



    public function registerPerson(Request $request)
    {
        $response = ['status' => 200, 'message' => 'Registro creado.', 'data' => []];
        try {

            $persona = new Persona();
            $persona->tipodoco = $request->tipodoco;
            $persona->documento = $request->documento;
            $persona->nombres = $request->nombres;
            $persona->apellidos = $request->apellidos;
            $persona->genero = $request->genero;
            $persona->entidad = $request->entidad;
            $persona->grado = $request->grado;
            $persona->grupo = $request->grupo;
            $persona->nacimiento = $request->nacimiento;
            $persona->jornada = $request->jornada;
            $persona->save();

            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $nombreFoto = uniqid().'.'.$foto->getClientOriginalExtension();
                Storage::disk('public')->put($nombreFoto, file_get_contents($foto));
                $persona->foto = $nombreFoto;
            }

            if ($request->hasFile('consentimiento')) {
                $consentimiento = $request->file('consentimiento');
                $nombreConsentimiento = uniqid().'.'.$consentimiento->getClientOriginalExtension();
                Storage::disk('public')->put($nombreConsentimiento, file_get_contents($consentimiento));
                $persona->consentimiento = $nombreConsentimiento;
            }

            $persona->save();

            $idPersonaGuardada = $persona->id;
            $response['data'] = $idPersonaGuardada;
        } catch (\Throwable $th) {
            $response['status'] = 500;
            $response['message'] = 'Error al crear el registro.';
        }

        return response()->json($response);
    }

    public function updatePerson(Request $request)
    {
        $response = ['status' => 200, 'message' => 'Registro actualizado.', 'data' => []];

        try {

            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $nombreFoto = uniqid().'.'.$foto->getClientOriginalExtension();
                Storage::disk('public')->put($nombreFoto, file_get_contents($foto));
                $request->foto = $nombreFoto;
            }

            if ($request->hasFile('consentimiento')) {
                $consentimiento = $request->file('consentimiento');
                $nombreConsentimiento = uniqid().'.'.$consentimiento->getClientOriginalExtension();
                Storage::disk('public')->put($nombreConsentimiento, file_get_contents($consentimiento));
                $persona->consentimiento = $nombreConsentimiento;
            }

            Persona::where('id', $request->id)
                ->update(
                    [
                        'tipodoco' => $request->tipodoco,
                        'documento' => $request->documento,
                        'nombres' => $request->nombres,
                        'apellidos' => $request->apellidos,
                        'genero' => $request->genero,
                        'entidad' => $request->entidad,
                        'grado' => $request->grado,
                        'grupo' => $request->grupo,
                        'nacimiento' => $request->nacimiento,
                        'foto' => $request->foto,
                        'consentimiento' => $request->consentimiento,
                    ]
                );
        } catch (\Throwable $th) {
        }

        return response()->json($response);
    }


    public function insertMedida(Request $request)//INSERTA Y ACTUALIZA
    {
        $response = ['status' => 200, 'message' => 'Registro guardado.', 'data' => []];

        try{
            $auxIDMedida=$request->id;
        }catch(Exception ){
            $auxIDMedida=null;
        }

        try {

            $validator = Validator::make($request->all(), [
                'peso' => 'required|min:0',
                'altura' => 'required|min:0',
            ]);

            if ($validator->fails()) {
                $response['message'] = 'Campo Peso y Altura son obligatorios';
                $response['status'] = 500;
                return response()->json($response);
            }
            if($auxIDMedida!=null){
                Historico::where('id', $request->id)
                    ->update(
                        [
                            'peso' => $request->peso,
                            'altura' => $request->altura,
                            'IMC' => $request->peso / ($request->altura * $request->altura),
                            'FC' => $request->FC,
                            'periodo' => $request->Periodo,
                            'PS' => $request->PS,
                            'PD' => $request->PD,
                            'PA' => ((2*$request->PD)+$request->PS)/3,
                            'DIAG' => $request->DIAG,
                        ]
                    );
                $response['message'] = 'Actualizado con éxito';
            }else{
                $persona = new Historico();
                $persona->persona_id = $request->persona_id;
                $persona->peso = $request->peso;
                $persona->altura = $request->altura;
                $persona->IMC = $request->peso / ($request->altura * $request->altura);
                $persona->FC = $request->FC;
                $persona->periodo = $request->Periodo;
                $persona->PS = $request->PS;
                $persona->PD = $request->PD;
                $persona->PA = ((2*$request->PD)+$request->PS)/3;
                $persona->DIAG = $request->DIAG;
                $persona->save();
            }


        } catch (\Throwable $th) {
        }

        return response()->json($response);
    }

    public function deleteMedida(Request $request)
    {
        $response = ['status' => 200, 'message' => 'Movido a la papelera.', 'data' => []];

        try {
            Historico::where('id', $request->id)
                ->update(
                    [
                        'estado' => 0,
                    ]
                );
        } catch (\Throwable $th) {
        }

        return response()->json($response);
    }

    public function getObtenerDatosDiagnostico(Request $request)
    {
        $response = ['status' => 200, 'message' => 'Sin resultados.', 'data' => []];
        $diagnostico = [];

        $persona = Persona::where('documento', $request->documento)->first();

        try
        {
            if ($persona) 
            {
                if (strtoupper($persona->genero) == "MASCULINO") 
                {
                    $diagnostico = Historico::where('persona_id', $persona->persona_id)
                    ->where('estado', 1)
                    ->get();
                }
    
                if (strtoupper($persona->genero) == "FEMENINO") 
                {
                    $diagnostico = Historico::where('persona_id', $persona->persona_id)
                    ->where('estado', 1)
                    ->get();
                }
    
                $response['data'] = ['diagt' => $diagnostico];
                return response()->json($response);
            }    
        }
        catch(\Throwable $th)
        {
            return response()->json($th);
        }
    }

    public function getPersonaMedida(Request $request)
    {
        
        $response = ['status' => 200, 'message' => 'Registro guardado.', 'data' => []];
        $diagnostico = [];
        $FC = [];
        $PA = [];
        $IMC = [];

        try {

            $persona = Persona::where('documento', $request->documento)->first();


            if ($persona) {
            if (strtoupper($persona->genero) == "MASCULINO") {
                    $FC = ViewFCMasculino::where('documento', $request->documento)
                    ->where('cod_estado', 1)
                    ->get();
                    $PA =  viewPAMasculino::where('documento', $request->documento)->get();
                }

                if (strtoupper($persona->genero) == "FEMENINO") {
                    $FC = ViewFCFemenino::where('documento', $request->documento)
                    ->where('cod_estado', 1)
                    ->get();
                    $PA = viewPAFemenino::where('documento', $request->documento)->get();
                }

                $diagnostico = DB::select ('call apolo.obtenerDatosTallayPeso(?,?)', array($persona->documento,$persona->genero));

                if(empty($diagnostico)){
                    $diagnostico = DB::select ('call apolo.intradiaDatosTallayPeso(?);', array($persona->documento));
                }

                /*$diagnostico = Historico::where('persona_id', $persona->id)
                ->where('estado', 1)
                ->ORDERBY('created_at')
                ->get();*/


                $IMC = ViewIMC::where('documento', $request->documento)
                ->where('estado_cod', 1)
                ->get();
            }

            $response['data'] = ['person' => $persona, 'FC' => $FC, 'PA' => $PA, 'IMC' => $IMC, 'diagnostico' => $diagnostico];
        } catch (\Throwable $th) {
        }

        return response()->json($response);
    }

    public function getHistorico(Request $request)
    {
        $response = ['status' => 200, 'message' => 'Registro guardado', 'data' => []];

        $Medidias=[];
        try {
            $persona = Persona::where('id', $request->id)->first();
            if ($persona) {
                $Medidias=Historico::where('persona_id',$request->id)
                    ->where('estado', 1)
                    ->get();
            }
            $response['data'] = ['Medidas' => $Medidias];
        } catch (\Throwable $th) {
        }
        return response()->json($response);
    }


    public function grupo()
    {
        $response = ['status' => 200, 'message' => 'Registro guardado.', 'data' => []];

        try {

            $result = Grupo::all();
            $response['data'] = $result;
        } catch (\Throwable $th) {
        }

        return response()->json($response);
    }

    public function personGrafica(Request $request)
    {
        $response = ['status' => 200, 'message' => 'Registro guardado.', 'data' => []];

        try {

            $imc = ViewIMC::select('estado', DB::raw('COUNT(*) AS cantidad'))
                ->groupBy('estado')
                ->where('grupo', $request->grupo)
                ->get();


            $FCFemenino = ViewFCFemenino::select('estado', DB::raw('COUNT(*) AS cantidad'))
                ->groupBy('estado')
                ->where('grupo', $request->grupo)
                ->get();

            $FCMasculino = ViewFCMasculino::select('estado', DB::raw('COUNT(*) AS cantidad'))
                ->groupBy('estado')
                ->where('grupo', $request->grupo)
                ->get();


            $response['IMC'] =  $imc;
            $response['FCFemenino'] =  $FCFemenino;
            $response['FCMasculino'] =  $FCMasculino;
        } catch (\Throwable $th) {
        }

        return response()->json($response);
    }

    public function personGraficaNew(Request $request){
        $response = ['status' => 200, 'message' => 'Registro guardado.', 'data' => []];

        try {

            $customQuery = " SELECT estado,count(*) AS cantidad FROM view_imc_new WHERE ";
            $customQueryFcFemenino = " SELECT estado,count(*) AS cantidad FROM view_fc_femenino_new WHERE ";
            $customQueryFcMasculino = " SELECT estado,count(*) AS cantidad FROM view_fc_masculino_new WHERE ";
            $customQueryPaMasculino = " SELECT estado,count(*) AS cantidad FROM view_pa_general_new WHERE ";
            //$customQueryPaFemenino = " SELECT estado,count(*) AS cantidad FROM view_pa_femenino_new WHERE ";

            $edad = $request->edad;
            //var_dump($edad);
            $grado = $request->grado;
            //var_dump($grado);
            $grupo = $request->grupo;
            //var_dump($grupo);
            $identidad = $request->identidad;
            //var_dump($identidad);
            $jornada = $request->jornada;
            //var_dump($jornada);
            $genero = $request->genero;
            //var_dump($genero);

            
            if($grado !== 'default'){
                $customQuery .= " grado = '$grado' AND";
                $customQueryFcFemenino .= " grado = '$grado' AND";
                $customQueryFcMasculino .= " grado = '$grado' AND";
                $customQueryPaMasculino .= " grado = '$grado' AND";
                //$customQueryPaFemenino .= " grado = '$grado' AND";

            }
            if($grupo !== 'default'){
                $customQuery .= " grupo = '$grupo' AND";
                $customQueryFcFemenino .= " grupo = '$grupo' AND";
                $customQueryFcMasculino .= " grupo = '$grupo' AND";
                $customQueryPaMasculino .= " grupo = '$grupo' AND";
                //$customQueryPaFemenino .= " grupo = '$grupo' AND";
            }
            if($identidad !== 'default'){
                $customQuery .= " entidad = '$identidad' AND";
                $customQueryFcFemenino .= " entidad = '$identidad' AND";
                $customQueryFcMasculino .= " entidad = '$identidad' AND";
                $customQueryPaMasculino .= " entidad = '$identidad' AND";
                //$customQueryPaFemenino .= " entidad = '$identidad' AND";
            }
            if($jornada !== 'default'){
                $customQuery .= " jornada = '$jornada' AND";
                $customQueryFcFemenino .= " jornada = '$jornada' AND";
                $customQueryFcMasculino .= " jornada = '$jornada' AND";
                $customQueryPaMasculino .= " jornada = '$jornada' AND";
                //$customQueryPaFemenino .= " jornada = '$jornada' AND";
            }
            if($genero !== 'default'){
                $customQuery .= " genero = '$genero' AND";
                $customQueryFcFemenino .= " genero = '$genero' AND";
                $customQueryFcMasculino .= " genero = '$genero' AND";
                $customQueryPaMasculino .= " genero = '$genero' AND";
                //$customQueryPaFemenino .= " genero = '$genero' AND";
            }
            if($edad !== 'default'){
                $customQuery .= " edad = '$edad' AND";
                $customQueryFcFemenino .= " edad = '$edad' AND";
                $customQueryFcMasculino .= " edad = '$edad' AND";
                $customQueryPaMasculino .= " edad = '$edad' AND";
                //$customQueryPaFemenino .= " edad = '$edad' AND";
            }

            if(substr($customQuery,-4) === " AND" ){
                $customQuery = substr($customQuery,0,-4);
                $customQuery .= " group by estado ";
            }
            if(substr($customQueryFcFemenino,-4) === " AND" ){
                $customQueryFcFemenino = substr($customQueryFcFemenino,0,-4);
                $customQueryFcFemenino .= " group by estado ";
            }
            if(substr($customQueryFcMasculino,-4) === " AND" ){
                $customQueryFcMasculino = substr($customQueryFcMasculino,0,-4);
                $customQueryFcMasculino .= " group by estado ";
            }
            if(substr($customQueryPaMasculino,-4) === " AND" ){
                $customQueryPaMasculino = substr($customQueryPaMasculino,0,-4);
                $customQueryPaMasculino .= " group by estado ";
            }
            /*if(substr($customQueryPaFemenino,-4) === " AND" ){
                $customQueryPaFemenino = substr($customQueryPaFemenino,0,-4);
                $customQueryPaFemenino .= " group by estado ";
            }*/

            /*echo $customQuery;
            echo $customQueryFcFemenino;
            echo $customQueryFcMasculino;*/

            $imc = DB::select($customQuery);
            $FCFemenino = DB::select($customQueryFcFemenino);
            $FCMasculino = DB::select($customQueryFcMasculino);
            $PAMasculino = DB::select($customQueryPaMasculino);
            //$PAFemenino = DB::select($customQueryFcMasculino);

            $response['IMC'] =  $imc;
            $response['FCFemenino'] =  $FCFemenino;
            $response['FCMasculino'] =  $FCMasculino;
            $response['PAGeneral'] =  $PAMasculino;
            //$response['PAMasculino'] =  $PAFemenino;
        } catch (\Throwable $th) {
            $response['message']=$th->getMessage().' - '.$th->getLine();
        }

        return response()->json($response);
    
    }
}
