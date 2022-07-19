<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use Illuminate\Http\Request;
use JeroenNoten\LaravelAdminLte\View\Components\Widget\Alert;

class ConcordanceController extends Controller
{
    public function find(Request $request)
    {
        $keyword = $request->keyword;
        $tahun = $request->tahun;
        $nama = $request->nama;
        $data = null;
        $client = new \GuzzleHttp\Client();

        if ($keyword) {
            if ($tahun && $nama) {
                $query = Jurnal::where('tahun', $tahun)
                    ->where('nama', 'like', '%' . $nama . '%')
                    ->pluck('filename')->toArray();
                if (!empty($query)) {
                    $response = $client->request('GET', 'http://localhost:8000/getConc2?keyword=' . $keyword . '&tahun=' . urlencode(json_encode($query)));
                    $data = json_decode($response->getBody()->getContents());
                    return view('concordance', compact('data'));
                } else {
                }
            } elseif ($tahun) {
                $query = Jurnal::where('tahun', $tahun)
                    ->pluck('filename')->toArray();
                if (!empty($query)) {
                    $response = $client->request('GET', 'https://localhost:8000/getConc2?keyword=' . $keyword . '&tahun=' . urlencode(json_encode($query)));
                    $data = json_decode($response->getBody()->getContents());
                    return view('concordance', compact('data'));
                }
            } elseif ($nama) {
                $query = Jurnal::where('nama', 'like', '%' . $nama . '%')
                    ->pluck('filename')->toArray();
                if (!empty($query)) {
                    $response = $client->request('GET', 'https://api-corpus.mirfanrafif.me/getConc2?keyword=' . $keyword . '&tahun=' . urlencode(json_encode($query)));
                    $data = json_decode($response->getBody()->getContents());
                    return view('concordance', compact('data'));
                }
            } else {
                $response = $client->request('GET', 'https://api-corpus.mirfanrafif.me/getConc2?keyword=' . $keyword);
                $data = json_decode($response->getBody()->getContents());
                // dd($data);
                // if(empty($data)){
                  
                // };
                return view('concordance', compact('data'));
            }
        };
        // dd($data);
        return view('concordance', compact('data'));
    }
}
