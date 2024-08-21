<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use Illuminate\Http\Request;

class SearchMentorController extends Controller
{
    // Mostrar formulario de búsqueda y resultados
    public function index(Request $request)
    {
        $query = Mentor::query()->with('user');

        // Filtrar por especialización
        if ($request->filled('specialization')) {
            $query->where('specializations', 'like', '%' . $request->input('specialization') . '%');
        }

        // Filtrar por tarifa
        if ($request->filled('rate_min')) {
            $query->where('rate', '>=', $request->input('rate_min'));
        }
        if ($request->filled('rate_max')) {
            $query->where('rate', '<=', $request->input('rate_max'));
        }

        // Filtrar por disponibilidad
        if ($request->filled('availability')) {
            $query->where('availability', 'like', '%' . $request->input('availability') . '%');
        }

        // Obtener mentores
        $mentors = $query->get();

        return view('mentors.index', compact('mentors'));
    }
}
