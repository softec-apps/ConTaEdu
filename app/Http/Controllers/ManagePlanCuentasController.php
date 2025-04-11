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
        try {
            $validatedData = $request->validate([
                'cuenta' => 'required|numeric',
                'description' => 'required|string',
                'tipocuenta' => 'required|in:T,D',
                'tipoestado' => 'required|in:1,2,3,5',
                'signo' => 'required|in:P,N,D',
                'template_id' => 'required|exists:templates,id'
            ]);

            if (!$validatedData) {
                return back()->withErrors(['message' => 'model not found']);
            }

            PlanCuentas::create($validatedData);
            swal()->success('Cuenta creada', 'Cuenta creada exitosamente.')->toast();

            return redirect()->route('template.accounts', $request->template_id);
        } catch (\Exception $e) {
            swal()->error('Error', 'No se pudo crear la cuenta: ' . $e->getMessage())->toast();
            return back()->withErrors(['message' => 'Error al crear la cuenta: ' . $e->getMessage()]);
        }
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
        try {
            $validatedData = $request->validate([
                'cuenta' => 'required|numeric',
                'description' => 'required|string',
                'tipocuenta' => 'required|in:T,D',
                'tipoestado' => 'required|in:1,2,3,5',
                'signo' => 'required|in:P,N,D',
                'template_id' => 'required|exists:templates,id'
            ]);
            $model = PlanCuentas::find($id);
            if ($model) {
                $model->update($validatedData);
                swal()->success('Cuenta actualizada', 'La cuenta se ha actualizado correctamente')->toast();
                return redirect()->route('template.accounts', $request->template_id);
            } else {
                return back()->withErrors(['message' => 'model not found']);
            }
        } catch (\Exception $e) {
            swal()->error('Error', 'No se pudo actualizar la cuenta: ' . $e->getMessage())->toast();
            return back()->withErrors(['message' => 'Error al actualizar la cuenta: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function estado($id)
    {
        try {
            $model = PlanCuentas::find($id);
            if ($model) {
                $model->est = $model->est == 1 ? 0 : 1;
                $model->save();
                return response()->json(['success', true]);
            } else {
                return response()->json(['success', false]);
                //return back()->withErrors(['message' => 'model not found']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error al cambiar el estado: ' . $e->getMessage()]);
        }
    }


    public function destroy($id)
    {
        try {
            $model = PlanCuentas::find($id);
            if ($model) {
                $model->est = 1 ? $model->est = 0 : $model->est = 1;
                $model->update($model);
                return redirect()->route('docente.cuentas.index');
            } else {
                return back()->withErrors(['message' => 'model not found']);
            }
        } catch (\Exception $e) {
            return back()->withErrors(['message' => 'Error al eliminar la cuenta: ' . $e->getMessage()]);
        }
    }


    public function search(Request $request)
    {
        $cuentaId = intval($request->input('id'));
        $search = intval($request->input('q')); // Select2 usa 'q' por defecto para el término de búsqueda
        $page = intval($request->input('page', 1)); // Para paginación
        $perPage = 10; // Número de resultados por página
        $templateId = intval($request->input('template_id')); // Obtener el template_id de la solicitud

        // Modificar la consulta para filtrar por template_id
        if ($cuentaId) {
            $query = PlanCuentas::where('id', '=', $cuentaId)->where('template_id', '=', $templateId);
        }
        else {
            $query = PlanCuentas::where('template_id', $templateId)
                ->where(function ($query) use ($search) {
                    $query->where('cuenta', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
                });
        }

        $total = $query->count();

        $data = $query->offset(($page - 1) * $perPage)
            ->limit($perPage)
            ->get();

        $formattedData = $data->map(function ($item) {
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



    public function showTemplateAccounts($templateId)
    {
        $template = \App\Models\Template::findOrFail($templateId);

        if (request()->ajax()) {
            $data = PlanCuentas::where('template_id', $templateId)
                ->get()
                ->map(function ($item) {
                    $item->signod = $this->mapTipoSigno($item->signo);
                    $item->tipoestadod = $this->mapTipoEstado($item->tipoestado);
                    $item->tipocuentad = $this->mapTipoCuenta($item->tipocuenta);
                    return $item;
                });
            return datatables()->of($data)->make(true);
        }

        return view('docente.cuentas.index', compact('template'));
    }
}
