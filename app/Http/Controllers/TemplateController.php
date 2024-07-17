<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function index()
    {
        $templates = Template::all();
        return view('docente.templates.index', compact('templates'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:500',
            'description' => 'required',
        ]);

        Template::create($validatedData);
        swal()->success('Template creado', 'Template creado exitosamente.')->toast();

        return redirect()->route('template.index');
    }

    public function update(Request $request, Template $template)
    {
        try {
            if ($template) {
                $validatedData = $request->validate([
                    'name' => 'required|max:500',
                    'description' => 'required',
                ]);

                $template->update($validatedData);

                swal()->success('Template actualizado', 'El template se ha actualizado correctamente')->toast();
            } else {
                swal()->error('Error', 'El template no existe')->toast();
            }
        } catch (\Exception $e) {
            swal()->error('Error', 'Hubo un problema al actualizar el template: ' . $e->getMessage())->toast();
        }

        return redirect()->route('template.index');
    }

    public function destroy(Template $template)
    {
        try {
            if ($template) {
                $template->delete();
                swal()->success('Template eliminado', 'El template se ha eliminado correctamente')->toast();
            } else {
                swal()->error('Error', 'El template no existe')->toast();
            }
        } catch (\Exception $e) {
            swal()->error('Error', 'Hubo un problema al eliminar el template: ' . $e->getMessage())->toast();
        }

        return redirect()->route('template.index');
    }
}
