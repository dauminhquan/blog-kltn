<?php
/**
 * Created by PhpStorm.
 * User: DauQuan
 * Date: 31/05/2018
 * Time: 22:18
 */

namespace App\Services;


use App\Models\Course;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Enterprise;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class GetDataService
{
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
}