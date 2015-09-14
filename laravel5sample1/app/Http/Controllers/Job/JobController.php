<?php namespace App\Http\Controllers\Job;
use App\Http\Controllers\Controller;
use App\Forms\FormValidationException;
use App\Forms\JobForm as jobForm;
use App\Models\Job as Job;
use Input;
use Illuminate\Support\Facades\Redirect;
use Session;
class JobController extends Controller {
     
    protected $job;
    protected $jobForm;
    public function __construct(jobForm $jobForm)
    {
        $this->job = new Job();
        $this->jobForm = $jobForm;
    }
    public function index($page = 1){
        $whereArr = array();
        $key = '';
        if (Input::has('keywords')) {
            $key = Input::get('keywords');
            $whereArr['company LIKE'] = "%".Input::get('keywords')."%";
        }
        $totalRecord = $this->job->getCountResult($whereArr);
        $maxRec = 5;
        $offset = ($page - 1) * $maxRec;
        $lastPage = ceil($totalRecord / $maxRec);
        $currentPage = $page;
        $previousPage = $page > 1 ? $page - 1 : 1;
        $nextPage = $page < $lastPage ? $page + 1 : $lastPage;
        $limitArray = array($offset, $maxRec);
        $orderArray = array('created_at DESC');
        $jobs = $this->job->getJobList($orderArray, $limitArray, $whereArr);
        return view("job.index",[
                'jobs'           => $jobs,
                'currentPage'    => $currentPage,
                'lastPage'       => $lastPage,
                'totalRecord'    => $totalRecord,
                'previousPage'   => $previousPage,
                'nextPage'       => $nextPage,
                'key'            => $key
        ]);
    }
    
     public function show($id){
        $job = $this->job->getJobById($id);
        $key = '';
        return view("job.show",[
            'job' => $job,
            'key' => $key
        ]);
    }
    
    public function edit($id){
        $job = $this->job->getJobById($id);
        $key = '';
        if (Input::has('update')){
            $formData = Input::except('_token','update');
            $file = Input::file('logo');
            try {
                // Validate
                $this->jobForm->validate($formData);
            } catch (FormValidationException $e) {
                return Redirect::back()->withInput()->withErrors($e->getErrors());
            }
            unset($formData['_token']);
            $updateArr = $formData;
            // Upload img
            if($file){
                $destinationPath = 'public/images/job';
                $extension = $file->getClientOriginalExtension(); // getting image extension
                $filename = 'job_'. $id . '.'. $extension;
                $file->move($destinationPath, $filename);
                $updateArr['logo'] = $destinationPath .'/'. $filename;
            }
            $whereArr = array(
                'id' => $id
            );
            $this->job->updateJobById($updateArr,$whereArr);
            Session::flash('success', 'Update successfully');
            return Redirect::route('index');
        }
        return view("job.edit",[
            'id'  => $id,
            'job' => $job,
            'key' => $key
        ]);
    }
    
    public function create(){
        if (Input::has('create')){
            $data = Input::except('_token','create');
            $file = Input::file('logo');
            $idMax = $this->job->getJobIdMax() + 1;
            $destinationPath = 'public/images/job';
            try {
                // Validate
                $this->jobForm->validate($data);
            } catch (FormValidationException $e) {
                return Redirect::back()->withInput()->withErrors($e->getErrors());
            }
            $this->job->exeBeginTrans();
            $whereArr = $data;
            if ($file){
                $extension = $file->getClientOriginalExtension(); // getting image extension
                $filename = 'job_'. $idMax. '.'. $extension;
                $whereArr['logo'] = $destinationPath .'/'. $filename;
            }
            $jobId = $this->job->insertJob($whereArr);
            if ($jobId) {
                $this->job->exeCommit();
                // Upload img
                if ($file){
                    $file->move($destinationPath, $filename);
                }
                Session::flash('success', 'create successfully'); 
            } else {
                $this->job->exeRollBack();
            }
            return Redirect::route('index');
        }
        return view("job.create")->with('key', '');
    }
}
?>
