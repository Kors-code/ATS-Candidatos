<?php

namespace App\Services;

use OpenAI;

class OpenAIService
{
    protected $client;

    public function __construct()
    {
        $this->client = OpenAI::client(env('OPENAI_API_KEY'));
    }

    public function analizarCV($texto, $nombreVacante , $requisito_ia ,$criterios)
    {
    $criteriosTexto = '';
    foreach ($criterios as $criterio => $peso) {
        $criteriosTexto .= ucfirst($criterio) . ": " . $peso . "%\n";
    }

          $prompt = <<<PROMPT
Eres un reclutador experto encargado de evaluar un currículum para la vacante: "$nombreVacante".

Requisitos a tener en cuenta:
$requisito_ia

Criterios de evaluación y su peso en el puntaje final (en porcentaje):
$criteriosTexto

Instrucciones de evaluación:
1. Analiza cuidadosamente el texto del CV y verifica si cumple con los requisitos y criterios proporcionados.
2. Asigna un puntaje de 1 a 100 calculado según el peso de cada criterio cumplido parcial o totalmente.
3. Basándote en tu criterio profesional, decide si el candidato debe ser "aprobado" o "rechazado".
4. Indica la "razon" explicando brevemente el porqué del resultado, resaltando criterios cumplidos o faltantes.
5. Responde ÚNICAMENTE en formato JSON válido, sin texto adicional.

Formato de respuesta obligatorio:
{
  "estado": "aprobado" o "rechazado",
  "razon": "breve motivo",
  "puntaje": numero del 1 al 100
}

Ahora analiza este CV:
$texto
PROMPT;

        $response = $this->client->chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => $prompt],
            ],
            'temperature' => 0.4,
            'max_tokens' => 300,
        ]);

        $content = $response->choices[0]->message->content;

        \Log::debug("Respuesta OpenAI: " . $content);

        $json = json_decode($content, true);

        if (json_last_error() === JSON_ERROR_NONE && isset($json['estado'], $json['razon'])) {
            return $json;
        }

        return [
            'estado' => 'pendiente',
            'razon' => 'No se pudo obtener respuesta de IA'
        ];
    }
}
