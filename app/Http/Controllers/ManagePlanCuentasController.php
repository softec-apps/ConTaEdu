<?php

namespace App\Http\Controllers;

use App\Models\PlanCuentas;
use Illuminate\Http\Request;

class ManagePlanCuentasController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = PlanCuentas::all()->map(function ($item) {
                $item->signod = $this->mapTipoSigno($item->signo);
                $item->tipoestadod = $this->mapTipoEstado($item->tipoestado);
                $item->tipocuentad = $this->mapTipoCuenta($item->tipocuenta);
                return $item;
            });
            return datatables()->of($data)->make(true);
        }

        return view('docente.cuentas.index');
    }
    private function mapTipoEstado($tipoestado)
    {
        $map = [
            1 => 'Estado de Situacion Financiera',
            2 => 'Estado de resultados integral',
            3 => 'Estados de flujo de efectivo',
            4 => 'Null',
            5 => 'Estado de cambios en el patrimonio'
        ];

        return $map[$tipoestado] ?? 'Desconocido';
    }
    private function mapTipoCuenta($tipocuenta)
    {
        $map = [
            'T' => 'Total',
            'D' => 'Detalle'
        ];

        return $map[$tipocuenta] ?? 'Desconocido';
    }
    private function mapTipoSigno($signo)
    {
        $map = [
            'P' => 'Positivo',
            'N' => 'Negativo',
            'D' => 'Doble'
        ];
        return $map[$signo] ?? 'Desconocido';
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manageStudent.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'cuenta' => 'required',
            'description' => 'required',
            'tipocuenta' => 'required',
            'tipoestado' => 'required',
            'signo' => 'required'
        ]);

        if (!$validatedData) {
            return back()->withErrors(['message' => 'model not found']);
        }

        PlanCuentas::create($validatedData);

        return redirect()->route('plancuentas.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(PlanCuentas $PlanCuentas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PlanCuentas $PlanCuentas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'cuenta' => 'required',
            'description' => 'required',
            'tipocuenta' => 'required',
            'signo' => 'required',
            'tipoestado' => 'required'
        ]);
        $model = PlanCuentas::find($id);
        if ($model) {
            $model->update($validatedData);
            return redirect()->route('plancuentas.index');
        } else {
            return back()->withErrors(['message' => 'model not found']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function estado($id)
    {
        $model = PlanCuentas::find($id);
        if ($model) {
            $model->est = $model->est == 1 ? 0 : 1;
            $model->save();
            return response()->json(['success', true]);
        } else {
            return response()->json(['success', false]);
            //return back()->withErrors(['message' => 'model not found']);
        }
    }


    public function destroy($id)
    {
        $model = PlanCuentas::find($id);
        if ($model) {
            $model->est = 1 ? $model->est = 0 : $model->est = 1;
            $model->update($model);
            return redirect()->route('docente.cuentas.index');
        } else {
            return back()->withErrors(['message' => 'model not found']);
        }
    }


    public function search(Request $request)
    {
        $search = $request->input('q'); // Select2 usa 'q' por defecto para el término de búsqueda
        $page = $request->input('page', 1); // Para paginación
        $perPage = 10; // Número de resultados por página
        $exact = $request->input('exact', false); // Nuevo parámetro para búsqueda exacta

        $query = PlanCuentas::query();

        if ($exact) {
            // Si 'exact' es true, buscar por ID exacto
            $query->where('id', $search);
        } else {
            // Búsqueda normal
            $query->where('cuenta', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
        }

        $total = $query->count();

        $data = $query->offset(($page - 1) * $perPage)
                    ->limit($perPage)
                    ->get();

        $formattedData = $data->map(function($item) {
            return [
                'id' => $item->id,
                'cuenta' => $item->cuenta,
                'text' => $item->description,
                'signo' => $item->signo,
                'tipoCuenta' => $item->tipocuenta,
            ];
        });

        return response()->json([
            'results' => $formattedData,
            'pagination' => [
                'more' => ($page * $perPage) < $total
            ],
            'total_count' => $total
        ]);
    }
}
