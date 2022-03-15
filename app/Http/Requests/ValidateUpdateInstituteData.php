<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class ValidateUpdateInstituteData extends FormRequest
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
            'inst_address' =>'required',
            'inst_tel' =>'required',
            'is_functioning' =>'required',
            'started_on' =>'required',
            'divisional_sec_divisions_id' =>'required',
            'proprietor_name' =>'required',
            'proprietor_address' =>'required',
            'proprietor_tel' =>'required',
            'class_start_time' =>'required',
            'class_end_time' =>'required',
            'buildings_details' =>'required',
            'number_of_buildings' =>'required',
            'structure_of_building' =>'required',
            'electricity_availability' =>'required',
            'aircondition_facility' =>'required',
            'lavatory_facility' =>'required',
            'applicant_confirmation' =>'required',
            'ins_cat_id' =>'required',
        ];
    }
}
