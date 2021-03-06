<?php
/**
 * Created by PhpStorm.
 * User: DauQuan
 * Date: 31/05/2018
 * Time: 22:18
 */

namespace App\Services;


use App\Models\Company;
use App\Models\Course;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Enterprise;
use App\Models\Position;
use App\Models\Post;
use App\Models\Skill;
use App\Models\Student;
use App\Models\TypeJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class GetDataService
{
    //-- admin
    public function getStudents()
    {
        $student = new Student();
        $students = [];
        $data = $student->get();

        if(count($data) > 0)
        {
            foreach ($data as $item)
            {
                if($item->branch != null)
                {
                    $name_department = $item->branch->department->name_department;
                    $name_branch = $item->branch->name_branch;

                }
                else{
                    $name_department = null;
                    $name_branch = null;
                }
                if($item->course != null)
                {
                    $name_course = $item->course->name_course;
                }
                else{
                    $name_course = null;
                }

                $students [] = [
                    'id' => $item->id,
                    'first_name_student' => $item->first_name_student,
                    'last_name_student' => $item->last_name_student,
                    'code_student' => $item->user->user_name,
                    'name_department' => $name_department,
                    'name_branch' => $name_branch,
                    'name_course' => $name_course,
                    'graduated' => $item->graduated,
                    'avatar_student' => $item->avatar_student
                ];

            }
        }
        return $students;
    }
    public function getOptionStudent($code_student,$option)
    {
        $user = User::where(DB::raw('LOWER(user_name)'), $code_student)->first();
        if ($user != null)
        {
            $id_user = $user->id;
            $student = Student::where('id_user',$id_user)->first();
            if($student != null)
            {
                if(gettype($option) == 'array')
                {
                    $data = [];
                    if(count($option) > 0)
                    {
                        foreach ($option as $item)
                        {
                            $data[$item] = $student->$item;
                        }
                    }
                    return $data;
                }
                return ['data' => $student->$option];
            }
        }



    }



    public function getCourses(){
        // get khóa học
        $course = new Course();
        return $course->get();
    }
    public function getDepartments()
    {
        $departments = new Department();
        return $departments->get();
    }
    public function getBranchesWithCodeDepartments($code_department)
    {
        $departments = Department::where('code_department',$code_department)->first();
        return $departments->branches;
    }

    public function getStudentWithCodeStudent($code_student){
        $user = User::where(DB::raw('LOWER(user_name)'), $code_student)->first();
        if ($user != null)
        {
            $student = $user->student;
            return [
                'info_student' => $student,
                'code_department' => $student->branch->code_department
            ];
        }
    }
    public function getWorkStudent(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'code_student' => 'required|exists:users,user_name'
        ],[
            'code_student.required' => 'Không có mã sinh viên',
            'code_student.exists' => 'Mã sinh viên không tồn tại'
        ]);
        if($validator->fails())
        {
            return response($validator->errors(),406);

        }

        $work_student = Employee::where('code_student',$request->code_student)->get();
        $enter = [];
        foreach ($work_student as $item)
        {
            $userEnterprise = $item->userEnterprise;
            $user_enterprise = $userEnterprise->user_name;
            $time_start_work = $item->updated_at;
            $time_end_work = $item->deleted_at;
            $position = $item->position;
            $name_enterprise = $userEnterprise->enterprise->name_enterprise;
            $avatar_enterprise = $userEnterprise->enterprise->avatar_enterprise;
            $introduce_enterprise = $userEnterprise->enterprise->introduce_enterprise;
            $enter[] = [
                "user_enterprise" => $user_enterprise,
                "time_start" => $time_start_work,
                'time_end' => $time_end_work,
                'name_enterprise' => $name_enterprise,
                'avatar_enterprise' => $avatar_enterprise,
                'introduce_enterprise' => $introduce_enterprise,
                'position' => $position
            ];
        }
        return $enter;

    }

    // enterprise


    public function getOptionEnterprise($email_address_enterprise,$option)
    {

        $user = User::where(DB::raw('LOWER(user_name)'), strtolower($email_address_enterprise))->first();
        if ($user != null)
        {
            $id_user = $user->id;
            $enterprise = Enterprise::where('id_user',$id_user)->first();
            if($enterprise != null)
            {
                if(gettype($option) == 'array')
                {
                    $data = [];
                    if(count($option) > 0)
                    {
                        foreach ($option as $item)
                        {
                            $data[$item] = $enterprise->$item;
                        }
                    }
                    return $data;
                }
                return ['data' => $enterprise->$option];
            }
        }
    }
    public function getEnterprise()
    {

        return Enterprise::join('users',"users.id","enterprises.id_user")->select('enterprises.*',DB::raw('users.user_name as user_enterprise'))->get();
    }
    public function getEnterpriseWithEmailAddressEnterprise($email_address_enterprise)
    {
        $user = User::where(DB::raw('LOWER(user_name)'), $email_address_enterprise)->first();
        if ($user != null)
        {
            $enterprise = $user->enterprise;
            $enterprise->email_address_enterprise = $user->user_name;
            return [
                'info_enterprise' => $enterprise,
            ];
        }
    }
    public function getEmployeesEnterprise(Request $request){
        $validator = Validator::make($request->all(),[
            'email_address_enterprise' => 'required|exists:users,user_name'
        ],[
            'email_address_enterprise.required' => 'Không có email doanh nghiệp',
            'email_address_enterprise.exists' => 'Doanh nghiệp không tồn tại'
        ]);
        if($validator->fails())
        {
            return response($validator->errors(),406);

        }

        $enterprise = Employee::where('user_enterprise',$request->email_address_enterprise)->get();
        $employees = [];

        foreach ($enterprise as $item)
        {

            $userStudent = $item->userStudent;

            $code_student = $item->code_student;
            $time_start_work = $item->updated_at;
            $time_end_work = $item->deleted_at;
            $position = $item->position;
            $first_name_student = $userStudent->student->first_name_student;
            $last_name_student = $userStudent->student->last_name_student;
            $branch = $userStudent->student->branch->name_branch;
            $avatar_student = $userStudent->student->avatar_student;

            $employees[] = [
                "code_student" => $code_student,
                "time_start" => $time_start_work,
                'time_end' => $time_end_work,
                'first_name_student' => $first_name_student,
                'last_name_student' => $last_name_student,
                'avatar_student' => $avatar_student,
                'branch' => $branch,
                'position' => $position
            ];
        }
        return $employees;
    }

    //!--admin

    //enterprise

    public function getListPost()
    {
//        $id_enterprise = Auth::user()->enterprise->id;
        $id_enterprise = 1;

        $posts = Post::where('id_enterprise',$id_enterprise)->orderBy('posts.created_at','DESC')->get();

        $list_post = [];
        if(count($posts) > 0)
        {
            foreach ($posts as $post)
            {
                $post->positions = $post->postions;

                $list_post[] = $post;
            }
        }
        return $list_post;
    }

    //!--enterprise

    //job



    public function getListJob(Request $request)
    {

        $posts=  Post::join('enterprises','enterprises.id','posts.id_enterprise');

        if($request->has('locals_selected'))
        {
            $posts = $posts->join('post_location','post_location.id_post','posts.id');
            if(gettype($request->locals_selected) =='array' && count($request->locals_selected) > 0)
            {
                foreach ($request->locals_selected as $item)
                {
                    $posts = $posts->orWhere('post_location.city',$item);
                }
            }

        }
        if($request->has('positions_selected'))
        {
            $posts = $posts->join('post_position','post_position.id_post','posts.id');
            if(gettype($request->positions_selected) =='array' && count($request->positions_selected) > 0)
            {
                foreach ($request->positions_selected as $item)
                {
                    $posts = $posts->orWhere('post_position.id_position',$item);
                }
            }

        }
        if($request->has('skills_selected'))
        {
            $posts = $posts->join('post_skill','post_skill.id_post','posts.id');
            if(gettype($request->skills_selected) =='array' && count($request->skills_selected) > 0)
            {
                foreach ($request->skills_selected as $item)
                {
                    $posts = $posts->orWhere('post_skill.id_skill',$item);
                }
            }

        }
        if($request->has('enterprises_selected'))
        {

            if(gettype($request->enterprises_selected) =='array' && count($request->skills_selected) > 0)
            {
                foreach ($request->enterprises_selected as $item)
                {
                    $posts = $posts->orWhere('posts.id_enterprise',$item);
                }
            }

        }

        if($request->has('types_job_selected'))
        {
            $posts = $posts->join('post_type','post_type.id_post','posts.id');
            if(gettype($request->types_job_selected) =='array' && count($request->types_job_selected) > 0)
            {
                foreach ($request->types_job_selected as $item)
                {
                    $posts = $posts->orWhere('post_type.id_job_type',$item);
                }
            }

        }
        if($request->has('dates_selected'))
        {
            if($request->dates_selected == 0) // hom nay
            {
                $posts = $posts->where('posts.time_start_post','>=',date('Y-m-d'));
            }
            if($request->dates_selected == 1) // hom qua
            {
                $posts = $posts->where('posts.time_start_post','>=',date('Y-m-d'));
            }
            if($request->dates_selected == 2) // tuan truoc
            {
                $posts = $posts->where('posts.time_start_post','>=',date("m/d/Y", strtotime("last week monday")));
            }
            if($request->dates_selected == 3) // thang truoc
            {
                $posts = $posts->where('posts.time_start_post','>=',date("Y-n-j", strtotime("first day of previous month")));
            }
//                   if($request->dates_selected == 4) // any time
//                   {
//                       $posts = $posts->where('posts.time_start_post','<=',date('Y-m-d'));
//                   }
        }
        if($request->has('email_address_enterprise'))
        {
            $user = User::where('user_name',$request->email_address_enterprise)->first();
            if($user != null)
            {
                $id_enterprise = $user->enterprise->id;
                $posts = $posts->where('posts.id_enterprise',$id_enterprise);
                return $posts->select('posts.id','posts.id_enterprise','posts.title_post'
                    ,'posts.description_post','posts.updated_at','enterprises.name_enterprise','enterprises.address_enterprise','enterprises.avatar_enterprise','posts.created_at','posts.accept')->distinct()->orderBy('posts.created_at','desc')->get();
            }
            return [];
        }
        if($request->has('get-all'))
        {
            return $posts->select('posts.id','posts.id_enterprise','posts.title_post'
                ,'posts.description_post','posts.updated_at','enterprises.name_enterprise','enterprises.address_enterprise','enterprises.avatar_enterprise','posts.created_at')->distinct()->orderBy('posts.created_at','desc')->get();
        }
        return $posts->select('posts.id','posts.id_enterprise','posts.title_post'
            ,'posts.description_post','posts.updated_at','enterprises.name_enterprise','enterprises.address_enterprise','enterprises.avatar_enterprise','posts.created_at')->distinct()->orderBy('posts.created_at','desc')->paginate(20);
    }

    public function getListTypeJob()
    {
        return TypeJob::all('id','name_job_type');
    }

    public function getListPosition(){
        return Position::all('id','name_position');
    }
    public function getListEnterprise()
    {
        return Enterprise::all('id','name_enterprise');
    }
    public function getListSkill()
    {
        return Skill::all('id','name_skill');
    }

    public function getDetailJob($id)
    {
        // tất cả thông tin về bài viết
        // tên doanh nghiệp
        // danh sách vị trí
        // danh sách loại công việc
        // danh sách kỹ năng
        $detail['info'] = Post::find($id);
        $detail['enterprise'] = $detail['info']->enterprise()->select('name_enterprise','introduce_enterprise','avatar_enterprise','address_enterprise')->first();
        $detail['skills'] = $detail['info']->skills()->select('name_skill')->get();

        $detail['types'] = $detail['info']->types()->select('name_job_type')->get();

        $detail['locations'] = $detail['info']->locations()->get();

        $detail['positions'] = $detail['info']->positions()->select('name_position')->get();


        $post = Post::find($id);
        $skills = $post->skills()->select('skills.id')->get();
        $positions = $post->positions()->select('positions.id')->get();

        $similar = Post::join('enterprises','enterprises.id','posts.id_enterprise')->select('posts.id','posts.id_enterprise','posts.title_post'
            ,'posts.description_post','posts.updated_at','enterprises.name_enterprise','enterprises.address_enterprise','enterprises.avatar_enterprise','posts.created_at')->where('posts.id','!=',$post->id);

        if($skills != null && gettype($skills) == 'array' && count($skills) > 0)
        {
            $similar = $similar->join('post_skill');
            foreach ($skills as $skill)
            {
                $similar  = $similar->orWhere('skills.id',$skill->id);
            }
        }
        if($positions != null && gettype($positions) == 'array' && count($positions) > 0)
        {
            $similar = $similar->join('post_position');
            foreach ($positions as $position)
            {
                $similar  = $similar->orWhere('skills.id',$position->id);
            }
        }

        $detail['similar'] = $similar->distinct()->orderBy('posts.created_at','desc')->limit(6)->get();


        return $detail;
//        return Post::find($id)->skills()->select('name_skill')->get();


        // thông tin về doanh nghiệp
        // các công việc giống
    }
    public function getSimilarJob($id)
    {
        // cùng vị trí
        // cùng kỹ năng



    }
}