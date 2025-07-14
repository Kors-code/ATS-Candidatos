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

    public function analizarCV($texto, $nombreVacante)
    {
        $prompt = <<<PROMPT
Eres un reclutador experto. Analiza el siguiente texto de hoja de vida para la vacante: "$nombreVacante".

Debes responder únicamente en formato JSON, con las siguientes claves:
{
  "estado": "aprobado" o "rechazado",
  "razon": "breve motivo"
}

Ejemplo válido:
{
  "estado": "rechazado",
  "razon": "No se menciona experiencia relevante en el área solicitada."
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
