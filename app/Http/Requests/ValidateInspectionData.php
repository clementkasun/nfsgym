<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class ValidateInspectionData extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules()
    {
        return [
            'inst_name' => 'required',
            'owner_name' => 'required',
            'ins_districts' => 'required',
            'divisional_sec_divisions_id' => 'required',
            'explainer_name' => 'required',
            'explainer_post' => 'required',
            'place_inspect_date_time' => 'required',
            'inspected_officer' => 'required',
            'inspected_officer_post' => 'required',
            // 'no_of_hall' => 'required',
            // 'no_of_class' => 'required',
            // 'class_area' => 'required',
            // 'no_of_students' => 'required',
            // 'special_area' => 'required',
            // 'girls_toilet' => 'required',
            // 'boys_toilet' => 'required',
            // 'chair_and_desk' => 'required',
            // 'training_instrument' => 'required',
            // 'learning_instrument' => 'required',
            // 'girls_hostel' => 'required',
            // 'boys_hostel' => 'required',
            // 'first_aid' => 'required',
            // 'libraury' => 'required',
            // 'scholar_facility' => 'required',
            // 'councelling' => 'required',
            // 'scholar_offer' => 'required',
            // 'food_facility' => 'required',
            // 'students_achievements' => 'required',
            // 'institute_achievements' => 'required',
            // 'attend_reg_maintain' => 'required',
            // 'play_national_anthem' => 'required',
            // 'works_for_attitude_development' => 'required',
            // 'term_test_procedure' => 'required',
            // 'theory_term_test' => 'required',
            // 'practicle_term_test' => 'required',
            // 'instruct_edu_pract_qualify' => 'required',
        ];
    }
}
