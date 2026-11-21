<?php

namespace App\Http\Controllers;

use App\Models\Hajo;
use App\Models\Tulajdonos;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminHajoController extends Controller
{
    public function index(): View
    {
        return view('admin.hajok.index', [
            'hajok' => Hajo::orderBy('nev')->orderBy('az')->paginate(15),
        ]);
    }

    public function create(): View
    {
        return $this->urlap(new Hajo(['uzemel' => true]));
    }

    public function store(Request $request): RedirectResponse
    {
        Hajo::create($this->validaltAdatok($request));

        return redirect()->route('admin.hajok.index')
            ->with('siker', 'A hajót hozzáadtuk.');
    }

    public function edit(Hajo $hajo): View
    {
        return $this->urlap($hajo);
    }

    public function update(Request $request, Hajo $hajo): RedirectResponse
    {
        $hajo->update($this->validaltAdatok($request));

        return redirect()->route('admin.hajok.index')
            ->with('siker', 'A hajó adatait mentettük.');
    }

    public function destroy(Hajo $hajo): RedirectResponse
    {
        $hajo->delete();

        return redirect()->route('admin.hajok.index')
            ->with('siker', 'A hajót töröltük.');
    }

    private function urlap(Hajo $hajo): View
    {
        return view('admin.hajok.urlap', [
            'hajo' => $hajo,
            'tulajdonosok' => Tulajdonos::orderBy('nev')->get(),
        ]);
    }

    private function validaltAdatok(Request $request): array
    {
        return $request->validate([
            'nev' => ['required', 'string', 'max:255'],
            'tipus' => ['required', 'string', 'max:255'],
            'tulaz' => ['nullable', 'integer', 'exists:tulajdonos,az'],
            'uzemel' => ['required', 'boolean'],
        ], [
            'nev.required' => 'Add meg a hajó nevét.',
            'nev.max' => 'A név legfeljebb 255 karakter lehet.',
            'tipus.required' => 'Add meg a hajó típusát.',
            'tipus.max' => 'A típus legfeljebb 255 karakter lehet.',
            'tulaz.exists' => 'Válassz létező tulajdonost.',
            'uzemel.required' => 'Add meg, hogy üzemel-e a hajó.',
            'uzemel.boolean' => 'Válaszd az Igen vagy a Nem lehetőséget.',
        ]);
    }
}