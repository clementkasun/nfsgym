<?php

namespace App\Repositories;

use App\Models\AttributParameter;
use App\Models\Result;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SurveyRepository
 *
 * @author viraj
 */
// class SurveyRepository
// {

//     public function getTable($id)
//     {
//         return AttributParameter::
//             join('parameters', 'attribute_parameter.parameter_id', '=', 'parameters.id') // add ,'left' if needed
//             ->join('attributes', 'attribute_parameter.attribute_id', '=', 'attributes.id', 'right')
//             ->where('attributes.title_id', $id)
//             ->orderBy('attributes.title_no', 'asc')
//             ->select('attributes.name AS attr_name', 'parameters.name AS para_name', 'attribute_parameter.type', 'attributes.id AS attr_id', 'attributes.title_no AS attr_no')
//             ->get();
//     }

//     public function getValuesTable_()
//     {
//         return Result::join('attribute_parameter', 'results.attribute_parameter_id', '=', 'attribute_parameter.id')
//             ->join('parameters', 'attribute_parameter.parameter_id', '=', 'parameters.id')
//             ->join('titles', 'parameters.title_id', '=', 'titles.id')
//             ->join('attributes', 'attribute_parameter.attribute_id', '=', 'attributes.id')
//             ->orderBy('attribute_parameter.id', 'asc')
//             ->select('results.attribute_parameter_id', 'results.text', 'results.date', 'results.number', 'attribute_parameter.type', 'parameters.name AS param_name', 'parameters.id AS param_id', 'titles.name AS titlle_name', 'attributes.name AS attr_name', 'attributes.id AS attr_id', 'titles.id AS title_id')
//             ->get();
//     }

//     public function getValuesTable($id)
//     {
//         $d = AttributParameter::join('attributes', 'attribute_parameter.attribute_id', '=', 'attributes.id')
//             ->join('parameters', 'attribute_parameter.parameter_id', '=', 'parameters.id')
//             ->join('titles', 'attributes.title_id', '=', 'titles.id')
//             ->join('main_titles', 'titles.main_title_id', '=', 'main_titles.id')
//             ->join('main_title_survey_name', 'main_title_survey_name.main_title_id', '=', 'main_titles.id')
//             ->orderBy('main_no', 'asc')
//             ->orderBy('title_no', 'asc')
//             ->orderBy('attr_no', 'asc')
//             ->where('main_titles.survey_name_id', $id)
//             ->select('attribute_parameter.parameter_id', 'attribute_parameter.id', 'parameters.name AS param_name', 'attribute_parameter.attribute_id', 'attributes.name AS attr_name', 'attributes.title_id', 'titles.name AS title_name', 'attribute_parameter.type', 'titles.main_title_id', 'main_titles.name AS main_title_name', 'main_titles.title_no AS main_no', 'titles.title_no AS title_no', 'attributes.title_no AS attr_no')
//             ->get();
//         dd($d);
//         return $d;
//     }

// }
