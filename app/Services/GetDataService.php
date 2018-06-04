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
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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
                        'graduated' => $item->graduated
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

}