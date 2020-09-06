<?php

use App\Models\Venue;
use App\Models\Course;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class CourseVenueTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Create Test Venues
            $venues = collect([]);

            $ven_1 = new \StdClass;
            $ven_1->name = 'Gymnasium (TUT)';
            $ven_1->location = 'TUT Soshanguve South Campus';
            $ven_1->latitude = '-25.541122';
            $ven_1->longitude = '28.095736';
            $venues->push($ven_1);


            $ven_2 = new \StdClass;
            $ven_2->name = 'Gencor Hall (TUT)';
            $ven_2->location = 'TUT Soshanguve South Campus';
            $ven_2->latitude = '-25.541893';
            $ven_2->longitude = '28.095813';
            $venues->push($ven_2);

            $ven_3 = new \StdClass;
            $ven_3->name = 'Information Center (TUT)';
            $ven_3->location = 'TUT Soshanguve South Campus';
            $ven_3->latitude = '-25.540596';
            $ven_3->longitude = '28.096074';
            $venues->push($ven_3);

            $ven_4 = new \StdClass;
            $ven_4->name = 'Building 20 (TUT)';
            $ven_4->location = 'TUT Soshanguve South Campus';
            $ven_4->latitude = '-25.539932';
            $ven_4->longitude = ' 28.09644';
            $venues->push($ven_4);

            $ven_5 = new \StdClass;
            $ven_5->name = 'Building 19 (TUT)';
            $ven_5->location = 'TUT Soshanguve South Campus';
            $ven_5->latitude = '-25.540137';
            $ven_5->longitude = '28.096429';
            $venues->push($ven_5);

            $ven_6 = new \StdClass;
            $ven_6->name = 'Building 18 (TUT)';
            $ven_6->location = 'TUT Soshanguve South Campus';
            $ven_6->latitude = '-25.540352';
            $ven_6->longitude = '28.096417';
            $venues->push($ven_6);

            

            foreach($venues as $venue) {
                Venue::create([
                    'name' => $venue->name,
                    'location' => $venue->location,
                    'latitude' => $venue->latitude,
                    'longitude' => $venue->longitude,
                ]);
            }

        // End Create Test Venues

        // Create Courses
            $course = Course::whereCode('NDCY03')->first();
            
            if(!$course) {
                $course = new Course;
                $course->name = 'NATIONAL DIPLOMA: COMPUTER SYSTEMS ENGINEERING';
                $course->code = 'NDCY03';
                $course->save();
            }

            $course = Course::whereCode('CS12')->first();
            
            if(!$course) {
                $course = new Course;
                $course->name = 'NATIONAL DIPLOMA: COMPUTER SCIENCE ENGINEERING';
                $course->code = 'CS12';
                $course->save();
            }


            // Link corresponding subjects
                $theLab = Venue::whereName($ven_3->name)->first();
                $subject = Subject::whereCode('COS101T')->first();
                
                if (!$subject) {

                    $subject = new Subject;
                    $subject->name = 'Communication Skills I';
                    $subject->code = 'COS101T';
                    $subject->semester = 1;
                    $subject->c_id = $course->c_id;
                    $subject->v_id = $theLab->v_id;
                    $subject->save();
                }

                $subject = Subject::whereCode('CSK101T')->first();
                if (!$subject) {

                    $subject = new Subject;
                    $subject->name = 'Computer Skills I';
                    $subject->code = 'CSK101T';
                    $subject->semester = 1;
                    $subject->c_id = $course->c_id;
                    $subject->v_id = $theLab->v_id;
                    $subject->save();
                }

                $subject = Subject::whereCode('DSY131C')->first();
                if (!$subject) {

                    $subject = new Subject;
                    $subject->name = 'Digital Systems I';
                    $subject->code = 'DSY131C';
                    $subject->semester = 1;
                    $subject->c_id = $course->c_id;
                    $subject->v_id = $theLab->v_id;
                    $subject->save();
                }

                $subject = Subject::whereCode('EEN111C')->first();
                if (!$subject) {

                    $subject = new Subject;
                    $subject->name = 'Electrical Engineering I';
                    $subject->code = 'EEN111C';
                    $subject->semester = 1;
                    $subject->c_id = $course->c_id;
                    $subject->v_id = $theLab->v_id;
                    $subject->save();
                }

                $subject = Subject::whereCode('ELC111B')->first();
                if (!$subject) {
                    
                    $subject = new Subject;
                    $subject->name = 'Electronics I';
                    $subject->code = 'ELC111B';
                    $subject->semester = 1;
                    $subject->c_id = $course->c_id;
                    $subject->v_id = $theLab->v_id;
                    $subject->save();
                }

                $subject = Subject::whereCode('MAT141F')->first();
                if (!$subject) {
                    
                    $subject = new Subject;
                    $subject->name = 'Mathematics I';
                    $subject->code = 'MAT141F';
                    $subject->semester = 1;
                    $subject->c_id = $course->c_id;
                    $subject->v_id = $theLab->v_id;
                    $subject->save();
                }

                $subject = Subject::whereCode('PGG111T')->first();
                if (!$subject) {
                    
                    $subject = new Subject;
                    $subject->name = 'Programming I';
                    $subject->code = 'PGG111T';
                    $subject->semester = 1;
                    $subject->c_id = $course->c_id;
                    $subject->v_id = $theLab->v_id;
                    $subject->save();
                }
            // End linking subjects
        // End Create Courses
    }
}
