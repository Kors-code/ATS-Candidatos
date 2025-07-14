<?php

namespace App\Http\Controllers;

use App\Models\Candidato;
use Illuminate\Http\Request;
use Smalot\PdfParser\Parser;
use App\Models\Vacante;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Element\Text;
use PhpOffice\PhpWord\Element\TextRun;
use PhpOffice\PhpWord\Element\AbstractElement; // Importar la clase base AbstractElement
use App\Services\OpenAIService;


class CandidatoController extends Controller
{

public function index(Request $request)
{
    $query = Candidato::query();

    if ($request->filled('q')) {
        $search = $request->input('q');
        $query->where('cv_text', 'LIKE', "%$search%");
    }

    $candidatos = $query->get();

    return view('candidatos.index', compact('candidatos'));
}

    public function mostrarCandidatos(Request $request)
    {
        if ($request->filled('q')) {
        $search = $request->input('q');
        $vacantes = Vacante::where('slug', $search)
            ->orWhere('titulo', 'LIKE', "%$search%")
            ->get();
        } else {
            $vacantes = Vacante::all();
        }

    return view('candidatos.mostrarCandidatos', compact('vacantes'));
}

    public function create()
    {
return view('candidatos.create');
    }

    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request , $slug) {

        $vacante = Vacante::where('slug', $slug)->firstOrFail();
        $data = $request->validate([
            'nombre' => 'required',
            'email' => 'required|email',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        if ($request->hasFile('cv')) {
            $data['cv'] = $request->file('cv')->store('cvs', 'public');
        }


            $data['vacante_id'] = $vacante->id;
            $filePath = storage_path("app/public/{$data['cv']}");
            $extension = pathinfo($filePath, PATHINFO_EXTENSION);
            $text = '';

if ($extension === 'pdf') {
    $parser = new Parser();
    $pdf = $parser->parseFile($filePath);
    $text = $pdf->getText();
} elseif (in_array($extension, ['docx', 'doc'])) {
            try {
                $phpWord = IOFactory::load($filePath);

                // Helper function to extract text recursively
                $extractText = function (AbstractElement $element) use (&$extractText) {
                    $result = '';
                    if ($element instanceof Text) {
                        $result .= $element->getText(); // No añadir \n aquí, PhpWord ya maneja los saltos
                    } elseif (method_exists($element, 'getElements')) { // Esto cubre TextRun, Section, Paragraph, etc.
                        foreach ($element->getElements() as $child) {
                            $result .= $extractText($child);
                        }
                    }
                    return $result;
                };

                // Itera sobre todas las secciones y sus elementos para extraer el texto
                foreach ($phpWord->getSections() as $section) {
                    foreach ($section->getElements() as $element) {
                        $text .= $extractText($element) . "\n"; // Añadir salto de línea después de cada elemento de alto nivel si lo deseas
                    }
                }
            } catch (\Exception $e) {
                // Log the error for debugging, don't just display a generic message
                \Log::error("Error al leer el archivo Word: " . $e->getMessage());
                $text = '[Error al leer el archivo Word]';
            }
} else {
    $text = '[Formato no soportado]';
}

    $data['cv_text'] = $text;
    $nombreVacante = $vacante->slug;
    $openai = new OpenAIService();
    $evaluacion = $openai->analizarCV($text ,$nombreVacante );

    // Si OpenAI respondió correctamente
    if (isset($evaluacion['estado']) && isset($evaluacion['razon'])) {
        $data['estado'] = $evaluacion['estado'];
        $data['razon_ia'] = $evaluacion['razon'];
    } else {
        $data['estado'] = 'pendiente';
        $data['razon_ia'] = 'No se pudo obtener respuesta de IA';
    }

        Candidato::create($data);

        return redirect()->route('candidatos.index')->with('success', 'Candidato guardado');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $slug)
    {
    session()->put('toggles.contador', $request->input('contador') == '1');
    session()->put('toggles.cajero',   $request->input('cajero')   == '1');
    session()->put('toggles.ventas',   $request->input('ventas')   == '1');
    $query = Candidato::query();
    $vacante = Vacante::where('slug', $slug)->firstOrFail();
    $candidatos = $query->where('vacante_id', 'like', $vacante->id)->get();
    if ($request->filled('q')) {
        $search = $request->input('q');
        $query->where('cv_text', 'LIKE', "%$search%");
    }
if ($request->input('contador') == 1) {
    $keywords = ['Contabilidad', 'Finanzas', 'Auditoría', 'Impuestos', 'Declaraciones Fiscales',
        'Balances', 'Estados Financieros', 'Conciliaciones Bancarias', 'Cuentas por Pagar',
        'Cuentas por Cobrar', 'Nóminas', 'Presupuestos', 'Análisis Financiero', 'Costos',
        'Contabilidad de Costos', 'Normativa Contable', 'Regulaciones Fiscales', 'SAP',
        'QuickBooks', 'Excel Avanzado', 'Software Contable', 'Gestión de Activos',
        'Gestión de Pasivos', 'Análisis de Datos', 'Reportes Financieros', 'Cierre Contable',
        'Libros Contables', 'Planificación Financiera'];

    // Esta condición se añadirá AL LADO de cualquier condición anterior
    $query->where(function ($q) use ($keywords) {
        foreach ($keywords as $keyword) {
            $q->orWhereRaw('LOWER(cv_text) LIKE ?', ['%' . strtolower($keyword) . '%']);
        }
    });
    // Si $request->filled('q') fue true, $query ahora representa:
    // SELECT * FROM candidatos WHERE cv_text LIKE '%searchTerm%' AND (LOWER(cv_text) LIKE '%contador%' OR ...)
}
if ($request->input('aprobar')) {
    $candidato = Candidato::findOrFail($request->input('aprobar'));
    $candidato->estado = 'aprobado';
    $candidato->save();
    return redirect()->route('candidatos.show', ['slug' => $vacante->slug])->with('success', 'Candidato aprobado');
}
if ($request->input('ventas') == 1) {
    $keywords = ['Técnicas de Venta', 'Cierre de Ventas', 'Negociación', 'Prospección', 'Captación de Clientes',
        'Fidelización de Clientes', 'Gestión de Cartera', 'CRM', 'Análisis de Ventas',
        'Cumplimiento de Metas', 'Cuotas de Venta', 'Venta Cruzada', 'Up-selling',
        'Presentación de Productos', 'Elaboración de Presupuestos', 'Marketing', 'Comercial',
        'Generación de Leads', 'Pronóstico de Ventas'];

    // Esta condición se añadirá AL LADO de cualquier condición anterior
    $query->where(function ($q) use ($keywords) {
        foreach ($keywords as $keyword) {
            $q->orWhereRaw('LOWER(cv_text) LIKE ?', ['%' . strtolower($keyword) . '%']);
        }
    });
    // Si $request->filled('q') fue true, $query ahora representa:
    // SELECT * FROM candidatos WHERE cv_text LIKE '%searchTerm%' AND (LOWER(cv_text) LIKE '%contador%' OR ...)
}
if ($request->input('cajero') == 1) {
    $keywords = ['Manejo de Efectivo', 'Cierre de Caja', 'Arqueo de Caja', 'TPV', 'POS', 'Cobros',
        'Devoluciones', 'Cambios', 'Facturación', 'Contabilidad básica', 'Gestión de Inventario',
        'Control de Stock', 'Escáner de códigos', 'Operaciones bancarias', 'Detección de billetes falsos'];

    // Esta condición se añadirá AL LADO de cualquier condición anterior
    $query->where(function ($q) use ($keywords) {
        foreach ($keywords as $keyword) {
            $q->orWhereRaw('LOWER(cv_text) LIKE ?', ['%' . strtolower($keyword) . '%']);
        }
    });
    // Si $request->filled('q') fue true, $query ahora representa:
    // SELECT * FROM candidatos WHERE cv_text LIKE '%searchTerm%' AND (LOWER(cv_text) LIKE '%contador%' OR ...)
}
    $candidatos = $query->get();
    $initialToggles = session('toggles', []);
    return view('candidatos.show', compact('candidatos', 'vacante', 'initialToggles'));
    
  }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Candidato $candidato)
    {
    return view('candidatos.edit', compact('candidato'));

    }
public function aprobar(Request $request, Candidato $candidato)
{
     session()->put('toggles.contador', $request->input('contador') == '1');
    session()->put('toggles.cajero',   $request->input('cajero')   == '1');
    session()->put('toggles.ventas',   $request->input('ventas')   == '1');


    $candidato->estado = 'aprobado';
    $candidato->save();

    $initialToggles = session('toggles', []);

    return back()->with('success', 'Candidato '.$candidato->nombre.' aprobado' , compact('initialToggles'));
}
public function rechazar(Candidato $candidato)
{
    $candidato->estado = 'rechazado';
    $candidato->save();

    return back()->with('success', 'Candidato '.$candidato->nombre.' rechazado');
}

public function showaprobados($slug)
{
 $query = Candidato::query();
    $vacante = Vacante::where('slug', $slug)->firstOrFail();
    $candidatos = $query->where('vacante_id', 'like', $vacante->id)->get();
    return view('candidatos.aprobar', compact('candidatos' , 'slug'));
}
public function showrechazados($slug)
{
 $query = Candidato::query();
    $vacante = Vacante::where('slug', $slug)->firstOrFail();
    $candidatos = $query->where('vacante_id', 'like', $vacante->id)->get();
    return view('candidatos.rechazados', compact('candidatos' , 'slug'));
}

public function update(Request $request, Candidato $candidato)
{
    $data = $request->validate([
        'nombre' => 'required',
        'email' => 'required|email',
        'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
    ]);

    if ($request->hasFile('cv')) {
        $data['cv'] = $request->file('cv')->store('cvs', 'public');
    }

    $candidato->update($data);

    return redirect()->route('candidatos.index')->with('success', 'Candidato actualizado');
}

    /**
     * Remove the specified resource from storage.
     */
public function destroy(Candidato $candidato)
{
    $candidato->delete();

    return redirect()->route('candidatos.index')->with('success', 'Candidato eliminado');
}


}
