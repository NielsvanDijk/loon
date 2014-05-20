<?php

class LoonController extends BaseController {

	public function postChangeLanguage() 
    {
        $rules = [
        'language' => 'in:nl,po' //list of supported languages of your application.
        ];

        $language = Input::get('language'); //lang is name of form select field.
		
		// var_dump($language);die;
        
        $validator = Validator::make(compact($language),$rules);

        if($validator->passes())
        {
            Session::put('language',$language);
            App::setLocale($language);
            return Redirect::back();
        }
        else
        { return 'test'; }
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$caos = Caos::lists('name', 'id');
		$salaries = Salaries::all();

		return View::make('glastuin.index')
			->with('salaries', $salaries)
			->with('caos', $caos)
			->with('language',Session::get('language'));


	}

	public function calculate()
	{
		$input = Input::all();

		$birthDay      	= $input['birthday'];
		$birthDate     	= strtotime( $birthDay );
		$currentSalary 	= (float)$input['salary'];
		$age           	= date( 'Y' ) - date( 'Y', $birthDate );
		$cao 			= $input['cao'];

		if( date( 'md', date( 'U', $birthDate ) ) > date( 'md' ) )
			$age = $age - 1;

		$result = DB::table('salaries')->where('age', $age)->where('cao_id', $cao)->first();

		if( !empty($result) ){
			$minimumSalary = (float)$result->value;
			return Response::JSON( [
				'success'		=> true,
				'age'			=> $age,
				'difference' 	=> $currentSalary - $minimumSalary,
				'cao'			=> $cao
			] );
		} else{
			return Response::JSON( [
				'success'	=> false,
				'errors' 	=> 'No results found'
			] );
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
