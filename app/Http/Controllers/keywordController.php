<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\keyword;
use Illuminate\Support\Facades\DB;

class keywordController extends Controller
{
  public function store(request $request)
  {


    $keyword_content = $request->keyword_content;
    DB::table('keywords')->insert($keyword_content);
  }
  public function update(Request $request, $id)
  {
   
    $keyword = keyword::findOrFail($id);
    $keyword->content = $request->content;
    $keyword->update();


  }
}
