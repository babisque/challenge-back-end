<?php

namespace App\Http\Controllers;

use App\Models\Receita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReceitaController extends Controller
{
    public function store(Request $request)
    {
        $validate = $request->only(['descricao', 'data']);
        $dbDatas = DB::select('SELECT descricao, data FROM receitas');
        $dataDecoded = json_decode(json_encode($dbDatas), true);

        foreach ($dataDecoded as $data) {
            if ($data['descricao'] === $validate['descricao'] && $data['data'] === $validate['data']) {
                return response()->json(['erro' => 'Receita já cadastrada.']);
            }
        }

        return response()->json(Receita::create($request->all()), 201);
    }

    public function index()
    {
        return Receita::all();
    }

    public function show(int $id)
    {
        $receita = Receita::find($id);
        if (is_null($receita)) {
            return response()->json(['erro' => 'Receita não encontrada.'], 204);
        }

        return response()->json($receita, 201);
    }

    public function update(int $id, Request $request)
    {
        $receita = Receita::find($id);
        if (is_null($receita)) {
            return response()->json(['erro' => 'Receita não encontrada.'], 404);
        }

        $receita->fill($request->all());
        $dbDatas = DB::select('SELECT descricao, data FROM receitas');
        $dataDecoded = json_decode(json_encode($dbDatas), true);

        foreach ($dataDecoded as $data) {
            if ($data['descricao'] === $receita['descricao'] && $data['data'] === $receita['data']) {
                return response()->json(['erro' => 'Receita já cadastrada.']);
            }
        }
        $receita->save();

        return $receita;
    }

    public function destroy(int $id)
    {
        $qtd = Receita::destroy($id);
        if ($qtd === 0) {
            return response()->json(['erro' => 'Receita não encontrada.'], 404);
        }

        return response()->json('', 204);
    }
}
