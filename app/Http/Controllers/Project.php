<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Projects;
use App\Http\Providers\Auth;
use Illuminate\Filesystem\Filesystem;


class Project extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');  //this makes one to be logged in to access any of project pages

       // $this->middleware('auth')->except(['show']); // this allow access to show only when unlogged
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $data=Projects::where('user_id',auth()->user()->id)->get();
         return view('home',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd('stored');
        $id=auth()->user()->id;
        $attr=$request->validate([
            'title'=>['required','min:3'],
            'description'=>['required','min:3'],
            
        ]);

        Projects::create( $attr+['user_id'=> auth()->user()->id] );
        // Projects::create( $request ,['user_id'=> auth()->user()->id]);
        //  dd(auth()->user()->id);
        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Projects $project,$id)
    {
         $one = new Projects;
        // $userData=Projects::findOrFail($id);
         dd($one->id);
        
        if($project->user_id !== auth()->id() ){
            // /abort(403);
            dd($project->user_id ,auth()->id() );
        }

        $userData = Projects::where('user_id',$id)->get();
        return view('show',compact('userData'));

        // dd(app(Filesystem::class));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $projectData = Projects::findOrFail($id);

        return view('edit',compact('projectData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $projectData = ($request->validate([
        //     'title' => ['required','min:3'],
        //     'description' => ['required']
        // ]))->save();
        // THIS IS INCORRENT SIINCE WE WANT TO ACT UPON THE DATA SO WE USE THE ELOQUENT MODEL INSTEAD
        $projectData = Projects::findOrFail($id);
        $projectData= $request->validate(
            [
                'title' => 'required',
                'desription' => 'required'
            ]
            );

        $projectData->save();
        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
