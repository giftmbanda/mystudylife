<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Course;

class CourseComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     *
     * @return void
     */
    public function compose(View $view)
    {
        $courses = Course::all(['name', 'c_id', 'code']);

        $view->with('courses', $courses);
    }
}
