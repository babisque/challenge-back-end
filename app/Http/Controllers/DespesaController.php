<?php

namespace App\Http\Controllers;

use App\Models\Despesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DespesaController
{
    public function store(Request $request)
    {
        $validate = $request->only(['descricao', 'data']);
        $dbData = DB::select('SELECT descricao, data FROM despesas');
        $dataDecoded = json_decode(json_encode($dbData), true);

        foreach ($dataDecoded as $data) {
            if ($data['descricao'] === $validate['descricao'] && $data['data'] === $validate['data']) {
                return response()->json(['erro' => 'Despesa já cadastrada.']);
            }
        }

        return response()->json(Despesa::create($request->all()), 201);
    }

    public function index()
    {
        return Despesa::all();
    }

    public function show(int $id)
    {
        $despesa = Despesa::find($id);
        if (is_null($despesa)) {
            return response()->json(['erro' => 'Despesa não encontrada'], 204);
        }

        return response()->json($despesa, 201);
    }

    public function update($id, Request $request)
    {
        $despesa = Despesa::find($id);
        if (is_null($despesa)) {
            return response()->json(['erro' => 'Despesa não encontrada.'], 204);
        }

        $despesa->fill($request->all());
        $dbDatas = DB::select('SELECT descricao, data FROM despesas');
        $dataDecoded = json_decode(json_encode($dbDatas), true);

        foreach ($dataDecoded as $data) {
            if ($data['descricao'] === $despesa['descricao'] && $data['data'] === $despesa['data']) {
                return response()->json(['erro' => 'Despesa já cadastrada']);
            }
        }

        $despesa->save();
        return $despesa;
    }

    public function destroy($id)
    {
        $qtd = Despesa::destroy($id);
        if ($qtd === 0) {
            return response()->json(['erro' => 'Despesa não encontrada.']);
        }

        return response()->json('', 204);
    }
}
