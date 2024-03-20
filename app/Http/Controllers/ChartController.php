<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Aitool;
use App\Models\ChartHistory;
use Illuminate\Http\Request;
use PhpXmlRpc\Client;
use PhpXmlRpc\Request as XmlRpcRequest;
use PhpXmlRpc\Value as XmlRpcValue;





class ChartController extends Controller
{
    public function execute(Request $request)
    {
        $aiTool_id = $request->input('ai_tool_id');
        $requestData = $request->all(); 
        unset($requestData['ai_tool_id']);
        unset($requestData['_token']);

        $fileb64 = $this->executeAiTool($aiTool_id, $requestData);
        if ($fileb64!=0)
        {
            $file_decoded= base64_decode($fileb64);

            $title = $requestData['title'];
  
            $title = preg_replace("/[^a-zA-Z0-9\s]/", "", $title);
            

            $filename = $title . '.' .Aitool::find( $aiTool_id)->out_file_ext; 

            if(Auth::user()){
                $this->storeChart($aiTool_id,$fileb64,$filename,$requestData);
            }

            file_put_contents($filename, $file_decoded);


            return response()->download($filename)->deleteFileAfterSend(true);
        }
        else
        {
            return back()->with('error', 'An error occurred during the request.');

        }
    }
    private  function storeChart($aiTool_id,$fileb64,$file_name,$inputs)
    {
        $inputs['audio_file']= $inputs['audio_file']->getClientOriginalName();
        
        $chartHistory = new ChartHistory();
        $chartHistory->user_id = auth()->user()->id;
        $chartHistory->aitool_id = $aiTool_id;
        $chartHistory->fileb64 = $fileb64;
        $chartHistory->file_name = $file_name;
        $chartHistory->inputs = json_encode($inputs);
        $chartHistory->save();
    }

    private function valueTypeXml($value)
    {
        $type = gettype($value);
    
        if ($type === 'string') {
            return 'string';
        } elseif ($type === 'integer') {
            return 'int';
        } elseif ($type === 'double') {
            return 'double';
        } elseif ($type === 'boolean'){
            return 'boolean';
        } elseif ($type === 'array') {
            return 'array';
        }
        return null; 
    }

    private function executeAiTool($aiTool_id, $requestData)
    {

        $endpoint = $this->getEndpointForAiTool($aiTool_id);
        $method = $this->getMethodForAiTool($aiTool_id);
        $audioFile = $requestData['audio_file'];
        unset($requestData['audio_file']);
        if ($method == 'XML-RPC') {     

            $DataValues[]=array();
            foreach ($requestData as $value) {
                if($this->valueTypeXml($value)==='array')
                {
                    foreach ($value as $val) {
                        $value[] = new XmlRpcValue($val, $this->valueTypeXml($val));
                    }
                }
                $DataValues[]=new XmlRpcValue($value, $this->valueTypeXml($value));
            }


            if ($audioFile) {
                // Lettura e codifica file
                $fileContents = file_get_contents($audioFile->getPathname());
                $base64File = base64_encode($fileContents);
                $fileValue = new XmlRpcValue($base64File, 'base64');
                $DataValues[]=$fileValue;
     
                // Creazione nuova istanza del client XML-RPC
                $client = new Client($endpoint);
    
                // Costruisci la richiesta XML-RPC
                $request = new XmlRpcRequest('request', $DataValues);

                $response = $client->send($request);
                
                // Verifica se la richiesta ha avuto successo
                if (!$response->faultCode()) {
                    $value = $response->value();

                    $fileb64 = $value->structmem('file_content')->scalarval();
                    return $fileb64;
                }
                else {
                    // Se c'è stato un errore nella richiesta, gestisci l'errore
                    echo "Errore nella richiesta XML-RPC: " . $response->faultString();
                    return 0;
                } 
            } 
            else {
                return 0;
            }
        }
        
        return 0;
    }

    private function getEndpointForAiTool($aiTool_id)
    {
        return Aitool::find($aiTool_id)->endpoint;
    }

    private function getMethodForAiTool($aiTool_id)
    {
        return Aitool::find($aiTool_id)->method;
    }
}


