<?php

namespace System\Http\Controllers;

use System\User;
use Auth;
use System\Course;
use DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    public function __construct() {
        //only accesable by admin
        $this->middleware('role:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = \System\User::all();
        return view('/users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    public function add_course($user_id)
    {
        $user = User::where('id', $user_id)->first();
        $courses_all = Course::all();
        $courses = $user->courses()->get();
        $cor = array();
        foreach ($courses_all as $course) {
            if (!$courses->contains($course))
                array_push($cor, $course);
        }
        
        return view('users.add_course', ['courses' => $cor])->with('user', $user);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required|string|max:150',
            'surname' => 'required|string|max:150',
            'email' => 'required|string|email|max:150|unique:users',
            'user_type' => [
                'required',
                 Rule::in(['admin', 'student', 'teacher']),
            ],
            'degrees' => 'nullable|string|max:150|',
            'degree_programme' => [
                'nullable',
                Rule::in(['bachelor', 'master', 'phd']),
            ],
            'study_year' => 'nullable|integer|max:5',
        ]);

        $role = \System\Role::where('name', request('user_type'))->first();

        $user = new User();
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->username =  $this->generateUsername(request()->all());
        $user->email = $request->email;
        $user->password = bcrypt($this->generatePassword());
        //$user->degree = $request->degrees;
        //$user->degree_programme = $request->degree_programme;
        $user->study_year = $request->study_year;
        $user->save();
        $user->roles()->attach($role);

        return redirect('users');

    }

    public function store_course(Request $request, $user_id)
    {
        $user = User::where('id', $user_id)->first();
        $course = Course::where('id', $request->course)->first();       

        $user->courses()->attach($course);
       // return redirect('users');
        return redirect()->route('user_show', $user);

    }

    /**
     * Display the specified resource.
     *
     * @param  \System\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        $id = request()->segment(2);

        $user = User::where('id', $user_id)->first();
        if (is_null($user)) {
            return redirect()->route('users');
        }
        $courses = Course::all();

        return view('users.info', compact('courses'))->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \System\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $id = request()->segment(2);
        $person = User::find($id);
        return view('users.edit',compact('person', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \System\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $person)
    {
        $id = request()->segment(2);

        $this->validate($request,[
            'name' => 'required|string|max:150',
            'surname' => 'required|string|max:150',
            'email' => 'required|string|email|max:150',
            'user_type' => [
                'required',
                 Rule::in(['admin', 'student', 'teacher']),
            ]]);

            $person = User::where("id",$id)->update([
                "name" => $request->name,
                "surname" => $request->surname,
                "email" => $request->email
            ]);

            return redirect()->route('users.index')->with('success','Data Updated'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \System\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $id = request()->segment(2);
        DB::table('users')->where('id',$id)->delete();
        return redirect('users');
    }

    public function destroy_course($user_id, $course_id)
    {
        $user = User::where('id', $user_id)->first();
        $course = Course::where('id', $course_id)->first();

        $course->users()->detach($user);
        return back();
    }

    /*
    * Create new unique username for user
    *
    */
    public function generateUsername(array $data) {

        $username = "";
        //if number of character in name is 2 and more, put first 2 characters to the username
        if (strlen($data['name']) >= 2 ) {
            $username = substr($data['name'], 0, 2);
        //otherwise put first character from name to username and "n" (like "n"ame)
        } else {
            $username = $data['name'] . "n";
        }

        //if number of character in surename is 2 and more, put first 2 characters to the username
        if (strlen($data['surname']) >= 2 ) {
            $username .= substr($data['surname'], 0, 2);
        //otherwise put first character from surename to username and "s" (like "s"urename)
        } else {
            $username .= $data['surname'] . "s";
        }

        switch ($data['user_type']) {

            case "admin":
                $username .= "ad";
                break;
            case "student":
                $username .= "st";
                break;
            case "teacher":
                $username .= "te";
                break;
        }

        $counter = 0;
        $helpProm = $username . $counter;
        while (User::where('username', $helpProm)->first()) {
            $counter++;
            $helpProm = $username . $counter;

        }
        return $helpProm;
    }

    /*
    * Generate password for new user
    *
    */
    public function generatePassword() {
        $password = array();
        $index = 10;
        while(($index--) != 0){
            while (($char = rand(65, 122)) < 97 && $char > 90);
            $char = chr($char);
            $password[] = $char;
        }
        return implode($password);
    }

}
