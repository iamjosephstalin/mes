<?php

namespace App\Http\Controllers\tags;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TagsController extends Controller
{
   
    public function index()
    {
      $tags = Tag::whereNull('deleted_at')->get();
      return view('content.tags.tags-index', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        try {
            Tag::create($request->all());
          return redirect()->route('tags.index')->withSuccess('New tag has been added');
        }catch(QueryException $e){
          if ($e->errorInfo[1] == 1062) {
            return redirect()->route('tags.index')->withErrors($request->name.' tag name already exists.');
          }
        } catch (Exception $e) {
            return redirect()->route('tags.index')->withErrors('An error occurred while adding the tag.');
        } 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag) : JsonResponse
    {
      try {

          $responseData = [
              'tag' => $tag,
          ];
          return response()->json($responseData, 200);
      } catch (Exception $e) {
          return response()->json(['error' => 'An error occurred'], 500);
      }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag) : RedirectResponse
    {
      try {
        $tag->update($request->all());
        return redirect()->back()
                ->withSuccess('Tag has been updated.');
      }catch(QueryException $e){
        if ($e->errorInfo[1] == 1062) {
          return redirect()->back()->withErrors($request->name.' tag name already exists.');
        }
      }
      catch (Exception $e) {
        return response()->json(['error' => 'An error occurred'], 500);
      }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag) : RedirectResponse
    {
        $tag->delete();
        return redirect()->route('tags.index')
                ->withSuccess('Tag has been deleted.');
    }

}
