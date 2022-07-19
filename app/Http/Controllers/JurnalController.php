<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class JurnalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jurnal = Jurnal::all();
        return view('admin.jurnal.index', compact('jurnal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.jurnal.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'tahun' => 'required',
            'penerbit' => 'required',
            'file' => 'required|file|mimes:txt',
        ]);
        $jurnal = new Jurnal;
        $jurnal->nama = $request->nama;
        $jurnal->tahun = $request->tahun;
        $jurnal->penerbit = $request->penerbit;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $md5name = md5($file->getRealPath());
            $timestamp = Carbon::now()->timestamp;
            $filename = $timestamp . '.' .$md5name. '.' .$request->nama. '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/jurnal', $filename);
            $jurnal->file = $filename;
        };
        $jurnal->filename = $filename;
        // dd($jurnal);
        $jurnal->save();
        return redirect()->route('jurnal.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jurnal  $jurnal
     * @return \Illuminate\Http\Response
     */
    public function show(Jurnal $jurnal)
    {
        $file = File::get(storage_path('app/public/jurnal/').$jurnal->file);
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'http://localhost:8000/getWordCount?file=' . $jurnal->filename);
        $word = json_decode($response->getBody()->getContents());
        return view('admin.jurnal.show', compact([
            'jurnal',
            'file',
            'word',
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jurnal  $jurnal
     * @return \Illuminate\Http\Response
     */
    public function edit(Jurnal $jurnal)
    {
        return view('admin.jurnal.edit', compact('jurnal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jurnal  $jurnal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jurnal $jurnal)
    {
        $request->validate([
            'nama' => 'required',
            'tahun' => 'required',
            'penerbit' => 'required',
        ]);
        $input = $request->all();
        // dd($jurnal->file);
        if ($image = $request->file('file')) {
            File::delete(storage_path('app/public/jurnal/').$jurnal->file);
            $path = 'public/jurnal/';
            $file = $request->file('file');
            $md5name = md5($file->getRealPath());
            $timestamp = Carbon::now()->timestamp;
            $filename = $timestamp . '.' .$md5name. '.' .$request->nama. '.' . $file->getClientOriginalExtension();
            $file->storeAs($path, $filename);
            $input['file'] = $filename;
        }else{
            unset($input['file']);
        };
        $jurnal->update($input);
        return redirect()->route('jurnal.index')->with('success', 'Data berhasil diubah');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jurnal  $jurnal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jurnal = Jurnal::findOrFail($id);
        // dd($jurnal);
        File::delete(storage_path('app/public/jurnal/').$jurnal->file);
        $jurnal->delete();

        return redirect()->route('jurnal.index')->with('success', 'Data berhasil dihapus');
    }
}
