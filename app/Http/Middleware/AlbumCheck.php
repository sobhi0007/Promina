<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Album;
class AlbumCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
       
         $album = Album::find($request->id);
         if($album->pictures->count()!=0){
            return redirect('album/delete_option/'.$request->id);
         }else{
            return redirect('album/forcedelete/'.$request->id);
         }

            
         
       
    }
}
