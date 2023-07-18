<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Author;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Setting pagination to 4 - We're rendering in a table, so not that important
        $announcements = Announcement::orderBy('id','desc')->paginate(4);
        return view('announcements.index', compact('announcements'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('announcements.create');
    }

    /**
     * Store a newly created resource in storage.
     * Expect subject, body, and author name from the form/template.  We look up the author name to see
     * if it exists already, and if not then we create it.  Announcement is linked to that author_id
     * We also set the posted_date to the current time.  That field could be omitted, however if we wanted
     * to later add a "publish" feature for delayed release it might be useful to keep track.
     */
    public function store(Request $request)
    {
        //Just basic checking to make sure these exist.  
        $request->validate([
            'subject' => 'required',
            'body' => 'required',
            'name' => 'required',
        ]);
        
        
        $author = Author::findByName($request->name);  //Retrieve author name
        
        //If we don't exist, create it
        if(empty($author)) {
            $author = new Author(['name' => $request->name]);
            $author->save();
        }
     
        //Probably a better way to do this, but not familiar with laravel
        $request->merge([
            'posted_date' => date('Y-m-d H:i:s'),  //Just using current time
            'authors_id' => $author->id            
        ]);

        //dump($request);
        Announcement::create($request->post());

        return redirect()->route('announcements.index')->with('success','Announcement created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Announcement $announcement)
    {
        //If we were to show multiple announcements on a page would use pagination, 
        //but I used boilerplate code from and example that only shows one per page. 
        //Had to tweak AppServiceProviders to show pagination arrows correctly
        $announcements = Announcement::orderBy('id','desc')->paginate(4);
        return view('announcements.show',compact('announcement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Announcement $announcement)
    {
        //
        return view('announcements.edit',compact('announcement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Announcement $announcement)
    {
        //update the existing post and redirect to index.  We don't have underlying logic to remove  
        //authors that were already created.
        $announcement->fill($request->post())->save();

        return redirect()->route('announcements.index')->with('success','Announcment updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Announcement $announcement)
    {
        //deletes the announcement and redirects to index page
        $announcement->delete();
        return redirect()->route('announcements.index')->with('success','Announcement was deleted');
    }
}
