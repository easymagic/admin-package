<?php



/*

|--------------------------------------------------------------------------

| Web Routes

|--------------------------------------------------------------------------

|

| Here is where you can register web routes for your application. These

| routes are loaded by the RouteServiceProvider within a group which

| contains the "web" middleware group. Now create something great!

|

*/



// use Illuminate\Http\Response;

// use Illuminate\Routing\Route;

use App\Util\MigGen;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;



Route::get('/','HomeController@index')->name('home.main');
//Route::get('/',function(){
////    return '...';
//});



// $this->post('login', 'Auth\LoginController@login');

// Route::get('/test-home', 'HomeController@indexTest');



Auth::routes();





//User



Route::get('/user-dashboard', 'HomeController@userDashboard')->middleware('auth')->name('user.dashboard');



Route::get('/change-password/{user}', 'Auth\ChangePasswordController@changePassword')->middleware('auth')->name('user.change.password');



Route::post('/change-password/{user}', 'Auth\ChangePasswordController@changePasswordAction')->middleware('auth')->name('user.change.password.action');



Route::get('/user-profile/{user}','Auth\UserProfileController@profile')->middleware('auth')->name('user.profile');



Route::post('/user-profile/{user}','Auth\UserProfileController@profileAction')->middleware('auth')->name('user.profile.action');







//jobs

Route::resource('job','Job\JobController')->middleware('auth');



Route::get('job/{job}','Job\JobController@show')->name('job.show');



//job-certifications

Route::resource('jobcertification','Job\JobCertificationController')->middleware('auth');



//job-skills

Route::resource('jobskill','Job\JobSkillController')->middleware('auth');





//job-competencies

Route::resource('jobcompetence','Job\JobCompetenceController')->middleware('auth');



//jobrecruitmenttype

Route::resource('jobrecruitmenttype','Job\JobRecruitmentTypeController')->middleware('auth');





//skill

Route::resource('skill','Skill\SkillController')->middleware('auth');





//competence

Route::resource('competence','Competence\CompetenceController')->middleware('auth');





//certification

Route::resource('certification','Certification\CertificationController')->middleware('auth');





//recruitmenttype

Route::resource('recruitmenttype','RecruitmentType\RecruitmentTypeController')->middleware('auth');





//education

Route::resource('education','Education\EducationController')->middleware('auth');





//candidate

Route::resource('candidate','Candidate\CandidateController')->middleware('auth');



Route::post('candidate-upload-document','Candidate\CandidateController@uploadDocument')->name('candidate.upload.document')->middleware('auth');

Route::post('candidate-change-document','Candidate\CandidateController@changeDocument')->name('candidate.change.document')->middleware('auth');

Route::get('candidate-remove-document','Candidate\CandidateController@removeDocument')->name('candidate.remove.document')->middleware('auth');







Route::get('candidate/create','Candidate\CandidateController@create')->name('candidate.create')->middleware(['auth','no.cv']);



// Route::get('candidate/create/{jobId}','Candidate\CandidateController@create')->name('candidate.create.id')->middleware(['auth']);



//candidateAppliedJobs

Route::get('candidate-jobs-applied/{candidate}','Candidate\CandidateController@candidateAppliedJobs')->middleware('auth')->name('candidate.jobs.applied');



//candidateeducation

Route::resource('candidateeducation','Candidate\CandidateEducationController')->middleware('auth');





//candidateskill

Route::resource('candidateskill','Candidate\CandidateSkillController')->middleware('auth');





//candidatecertification

Route::resource('candidatecertification','Candidate\CandidateCertificationController')->middleware('auth');





//candidateworkexperience

Route::resource('candidateworkexperience','Candidate\CandidateWorkExperienceController')->middleware('auth');





//candidatejob

Route::resource('candidatejob','Candidate\CandidateJobController')->middleware('auth');





//jobtag

Route::resource('jobtag','Job\JobTagController')->middleware('auth');







//job-applicants

Route::get('/job/{job}/applicants','Job\JobController@showApplicants')->middleware('auth')->name('job.applicants');



//job-applicants-ajax

Route::get('/job/{job}/applicants/ajax','Job\JobController@showApplicantsAjax')

	->middleware('auth')

	->name('job.applicants.ajax');





//job-applicants

Route::get('/job-talent-pool','Job\JobController@showApplicantsPool')->middleware('auth')->name('job.applicants.pool');



//job-applicants-ajax

Route::get('/job-talent-pool/ajax','Job\JobController@showApplicantsPoolAjax')

	->middleware('auth')

	->name('job.applicants.pool.ajax');



//save-search-filter

Route::post('/save-search-filter','Job\JobController@saveFilteredSearch')->middleware('auth')->name('save.search.filter');




//user

Route::resource('user','User\UserController')->middleware('auth');





//user-ajax

Route::get('user-ajax','User\UserController@indexAjax')->middleware('auth')->name('user.ajax');





//filtergroup

Route::resource('filtergroup','FilterGroups\FilterGroupController')->middleware('auth');





//filtergroup-candidates

Route::get('filtergroup-candidates/{filterGroup}','FilterGroups\FilterGroupController@candidates')->middleware('auth')->name('filtergroup.candidates');







//candidatesAjax

Route::get('filtergroup-candidates-ajax/{filterGroup}','FilterGroups\FilterGroupController@candidatesAjax')->middleware('auth')->name('filtergroup.candidates.ajax');





//candidatefiltergroup

Route::resource('candidatefiltergroup','FilterGroups\CandidateFilterGroupController')->middleware('auth');





Route::post('download-cv', function()

{

	$data = request()->all();



	$file_name = $data['file_name'];



	$path = storage_path() . '/app/' .$file_name;



	// dd($path);

	if (file_exists($path)) {

		try{

			return Response::download($path);

		}catch(Exception $ex){

			return 'not found...';

		}



	}else{

		// echo $path;

	}

})->name('download.cv');







//CandidateFilterGroupShare

Route::get('filter-group-export/{group}','FilterGroups\CandidateFilterGroupShare@share')->middleware('auth')->name('filter.group.export');







///Region

Route::resource('region', 'JbRegionController');



///Discipline

Route::resource('discipline', 'JbDisciplineController');





//Job Filter

Route::get('job-filter','HomeController@getJobList')->name('job.filter');





//jobSkills(Request $request,$jobId)

Route::get('job-skills/{$jobId}','JobController@jobSkills')->name('job.skills');



// Route::get('')





Route::get('excel-manip-show','ExcelManipController@showForm')->name('excel.manip.show');

Route::post('excel-manip-show','ExcelManipController@showFormAction')->name('excel.manip.action');





///Handle http post actions

Route::post('process-action/{type}','CommandController@handlePost')->name('process.action');

Route::get('process-action/{type}','CommandController@handleGet')->name('process.action');







//Handle http get requests

Route::get('app-get/{type}','FrontController@processGet')->name('app.get')->middleware(['auth']);



Route::get('app-run/{type}','FrontControllerv2@execCommand')->name('app.run')->middleware(['auth']);





Route::get('test-actual',function(){

	return 'Running Actual ....' . date('Y:m:d h:i:s');

});



Route::get('gen-key',function(){

	return bcrypt(time());

})->name('gen.key');



Route::get('test-lab',function(){

	return url('');

})->name('test.lab');



Route::post('app-exec/{cmd}','CommandControllerv2@execCommand')->name('app.exec');

Route::get('pub-get/{cmd}','FrontControllerv2@execCommand')->name('pub.get');





Route::get('ajax-get-candidate/{candidateId}',function($candidateId){



	$obj = \App\Models\JbCandidate::find($candidateId);

	// dd($obj);

	// dd(strtotime($obj->created_at));

	// $obj->created_at = date('Y-m-d h:i:s', strtotime($obj->created_at));

	// dd($obj);

	// $obj->updated_at = \Carbon\Carbon::createFromFormat('Y-m-d h:i:s', $obj->updated_at);



	// dd($obj);

	$obj->created_at = $obj->created_at;

	$obj->updated_at = $obj->updated_at;



	// dd($obj);

	// $obj->save();



	// dd($obj->toArray());



	return $obj->toArray();



})->name('ajax.get.candidate');







Route::get('clear-profile-video/{email}',function($email){



	$user = (new \App\User)->newQuery()->where('email',$email)->first();

	$user->candidate->profile_video = '';

//	$user->candidate->save();

	return [

		'message'=>'Profile picture cleared....',

		'data'=>(new \App\User)->newQuery()->where('email',$email)->first()->candidate

	];



});







Route::get('applicant-mail-centre',function(){



	return view('applicants.mail_centre');



})->name('applicant.mail.centre');







// use ;





Route::get('test-pdf',function(){

    

    

    //cv-import

    

    // $x = new \Dompdf\Adapter\PDFLib\PDFlib;

    

    // dd($x);

    

    // echo public_path('cv-import') . '<-- Path:';

    $dir = scandir(public_path('cv-import'));

    $dir = array_diff($dir,['.','..']);

    

    $list = [];

    foreach ($dir as $k=>$v){



        $parser = new \Smalot\PdfParser\Parser();

        $pdf    = $parser->parseFile(public_path('cv-import') . '/' . $v);

         

        $text = $pdf->getText();

        

        $text = iconv('windows-1250', 'utf-8', $text);

        

        $text = trim($text);

        $r = explode("\(E\)",$text);

        $r = implode('_SEP_',$r);

        $r = explode('\(T\)',$r);

        $r = implode('_SEP_',$r);

        $r = explode('_SEP_',$r);

        

        array_shift($r);

        

        $r[0] = trim($r[0]);

        $r[1] = trim($r[1]);

        $t = $r[1];

        

        $t = explode('"',$t);

        $t = implode('',$t);

        

        $t = explode("\n",$t);

        $t = implode('',$t);

        // $t = trim($t,"\\xA0");

        

        $r[1] = strval($t);

        

        $v = explode('.',$v);

        $name = $v[0];

        $name = explode('-Profile',$name);

        $name = $name[0];

        

        

        $list[] = [

          'email'=>$r[0],

          'phone_number'=>$r[1],

          'name'=>$name

        ];

        

        // dd();



    

    }

    

    $jbJobQuery = (new \App\Models\JbJob)->newQuery();

    $role = 'SALES INTERN - JOBERMAN';

    if (!$jbJobQuery->where('role',$role)->exists()){

        // dd('ne');

        $jobNew = new \App\Models\JbJob;

        $jobNew->role = $role;

        $jobNew->save();

    }else{

        $jobNew = $jbJobQuery->where('role',$role)->first();

    }

    

    // dd($jobNew);

    

    foreach ($list as $item){

        

        $userCheck = (new \App\User)->newQuery();

        $userCheck = $userCheck->where('email',$item['email']);

        if (!$userCheck->exists()){

          $userObj = new \App\User;

          $userObj->email = $item['email'];

          $userObj->phone_num = $item['phone_number'];

          $userObj->name = $item['name'];

          $userObj->save();

        }else{

          $userObj = $userCheck->first();    

        }

        

        $candidateCheck = (new \App\Models\JbCandidate)->newQuery();

        $candidateCheck = $candidateCheck->where('user_id',$userObj->id);

        if (!$candidateCheck->exists()){

           $candidateObj = new \App\Models\JbCandidate;

           $candidateObj->user_id = $userObj->id;

           $candidateObj->email = $userObj->email;

           $candidateObj->name = $userObj->name;

           $candidateObj->phone_number = $userObj->phone_num;

           $candidateObj->save();

        }else{

           $candidateObj = $candidateCheck->first();       

        }

        

        $candidateJobCheck = (new \App\Models\JbCandidateJob)->newQuery();

        $candidateJobCheck = $candidateJobCheck->where('jb_job_id',$jobNew->id)->where('jb_candidate_id',$candidateObj->id);

        if (!$candidateJobCheck->exists()){

            $candidateJobObj = new \App\Models\JbCandidateJob;

            $candidateJobObj->jb_job_id = $jobNew->id;

            $candidateJobObj->jb_candidate_id = $candidateObj->id;

            $candidateJobObj->save();

        }else{

            $candidateJobObj = $candidateJobCheck->first();

        }

        

        

    }

    

    dd($list);

    

    // dd($dir);

    

    //BolaBola-Profile.pdf



// echo $text;    

    

});


Route::get('ingest-from-json/{json}',function($json){

     $json = json_decode($json);



    $jbJobQuery = (new \App\Models\JbJob)->newQuery();

    $role = 'SALES INTERN - JOBERMAN';

    if (!$jbJobQuery->where('role',$role)->exists()){

        // dd('ne');

        $jobNew = new \App\Models\JbJob;

        $jobNew->role = $role;

        $jobNew->save();

    }else{

        $jobNew = $jbJobQuery->where('role',$role)->first();

    }

    

    // dd($jobNew);

    

    foreach ($json as $item){

        

        $userCheck = (new \App\User)->newQuery();

        $userCheck = $userCheck->where('email',$item->email);

        if (!$userCheck->exists()){

          $userObj = new \App\User;

          $userObj->email = $item->email;

          $userObj->phone_num = $item->phone_number;

          $userObj->name = $item->name;

          $userObj->save();

        }else{

          $userObj = $userCheck->first();    

        }

        

        $candidateCheck = (new \App\Models\JbCandidate)->newQuery();

        $candidateCheck = $candidateCheck->where('user_id',$userObj->id);

        if (!$candidateCheck->exists()){

           $candidateObj = new \App\Models\JbCandidate;

           $candidateObj->user_id = $userObj->id;

           $candidateObj->email = $userObj->email;

           $candidateObj->name = $userObj->name;

           $candidateObj->phone_number = $userObj->phone_num;

           $candidateObj->save();

        }else{

           $candidateObj = $candidateCheck->first();       

        }

        

        $candidateJobCheck = (new \App\Models\JbCandidateJob)->newQuery();

        $candidateJobCheck = $candidateJobCheck->where('jb_job_id',$jobNew->id)->where('jb_candidate_id',$candidateObj->id);

        if (!$candidateJobCheck->exists()){

            $candidateJobObj = new \App\Models\JbCandidateJob;

            $candidateJobObj->jb_job_id = $jobNew->id;

            $candidateJobObj->jb_candidate_id = $candidateObj->id;

            $candidateJobObj->save();

        }else{

            $candidateJobObj = $candidateJobCheck->first();

        }

        

        

    }


     // dd($json);
    return [
       'data'=>$json,
       'message'=>'Data processed.'
    ];


});


Route::get('mail-centre','MailCentreController@index')->middleware('auth')->name('mail.centre');
Route::get('mail-centre-query/{query}','MailCentreController@query')->middleware('auth')->name('mail.centre.query');
Route::post('mail-centre-send-mail','MailCentreController@sendCandidateMail')->middleware('auth')->name('mail.centre.send.mail');

Route::resource('stage','StageController'); //->middleware(['auth']);
Route::resource('candidate_stage','CandidateStageController'); //->middleware(['auth']);

Route::post('progress-stage','CandidateStageController@progressStage')->name('progress.stage');

Route::get('migrate',function(){
//	\Illuminate\Support\Facades\Artisan::call('migrate');
	return 'Database migrated...';
});


Route::get('show-tables',function(){

    $tables = MigGen::getTablesFromDb();

    foreach ($tables as $item){

        $tableName = $item->Tables_in_mrecruit_db;
        $data = MigGen::getFieldsFromTable($tableName);
        $r = "<?php \n" . view('mig.generator',$data)->render();
        $hnd = fopen('migs/' . date('Y_m_d_his_') . $data['className'] . '.php','w+');
        fwrite($hnd,$r);
        fclose($hnd);

    }
//    dd($tables);

//    $data = MigGen::getFieldsFromTable('skills');
//    $r = "<?php \n" . view('mig.generator',$data)->render();
//    $hnd = fopen('migs/' . $data['className'] . '.php','w+');
//    fwrite($hnd,$r);
//    fclose($hnd);

//    dd($cols);

});


Route::get('seed-it',function(){
    \Illuminate\Support\Facades\Artisan::call('db:seed');
    return 'Seeded...';
});

Route::resource('workflow','WorkFlowController')->middleware(['auth']);
Route::resource('workflow-stages','WorkFlowStageController')->middleware(['auth']);
Route::resource('workflow-group','WorkFlowGroupController')->middleware(['auth']);
Route::resource('workflow-user-group','WorkFlowUserGroupController')->middleware(['auth']);


Route::get('/test-code-gen',function(){


    $tmp = \Illuminate\Support\Facades\Storage::disk('route_disk')->get('web.php');

    $tmp = $tmp . "\nRoute::resource('workflow-user-group','WorkFlowUserGroupController')->middleware(['auth']);";

    \Illuminate\Support\Facades\Storage::disk('route_disk')->put('web.php',$tmp);

//    dd($tmp);
    
});

//Route::resource('workflow-user-group','WorkFlowUserGroupController')->middleware(['auth']);
Route::resource('comment','CommentController')->middleware(['auth']);

Route::get('test-unit/{n}',function($n){

    return 'test-unit---' . $n;

});


Route::get('migrate',function(){
    Artisan::call('migrate');

    Artisan::call('default:user');

    return 'Migration created...,default user created';

});