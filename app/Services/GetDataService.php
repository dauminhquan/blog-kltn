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
}