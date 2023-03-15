<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\orcid;
use App\Http\Resources\OrcidResource;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

use App\Models\keyword;

class OrcidController extends Controller
{
    public $url = "https://pub.orcid.org/v3.0/";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orcid = orcid::latest()->paginate(2);
        return OrcidResource::collection($orcid);
    }


    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        
      
    

        $orcid = orcid::create($request->all());
        return $orcid->id;
    }

    public function edit($id)
    {
        $orcid = orcid::findOrFail($id);

        return Inertia::render('editar_orcid', [
            'orcid' => new OrcidResource($orcid)
        ]);
    }


    public function show($id)
    {
        $orcid = orcid::findOrFail($id);
        return response(new OrcidResource($orcid));
    }


    public function update(Request $request, $id)
    {

        $orcid = orcid::findOrFail($id);
        $orcid->orcid_identifier_path = $request->orcid_identifier_path;
        $orcid->given_names = $request->given_names;
        $orcid->family_name = $request->family_name;
        $orcid->email_primary = $request->email_primary;
        $orcid->update();
        
    }


    public function destroy($id)
    {
        $orcid = orcid::findOrFail($id);
        $orcid->delete();
    }
}
