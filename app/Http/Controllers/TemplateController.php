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

        return redirect()->route('template.index')->with('success', 'Template creado exitosamente.');
    }

    public function update(Request $request, Template $template)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:500',
            'description' => 'required',
        ]);

        $template->update($validatedData);

        return redirect()->route('template.index')->with('success', 'Template actualizado exitosamente.');
    }

    public function destroy(Template $template)
    {
        $template->delete();

        return redirect()->route('template.index')->with('success', 'Template eliminado exitosamente.');
    }
}
