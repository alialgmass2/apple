<?php

namespace App\Traits;

use App\Enums\OrderStatus;
use Illuminate\Validation\Rule;

trait HasValidation
{
    public function validateRegion($regionId = '')
    {
        return [
            'name_en' => 'required|string|max:180|unique:regions,name_en,' . $regionId,
            'name_ar' => 'required|string|max:180|unique:regions,name_ar,' . $regionId,
        ];
    }
    public function validateCity($cityId = '')
    {
        return [
            'region_id' => 'required|integer|exists:regions,id',
            'name_en' => 'required|string|regex:/[a-zA-Z]/|max:180|unique:cities,name_en,' . $cityId,
            'name_ar' => 'required|string|max:180|unique:cities,name_ar,' . $cityId,
        ];
    }
    public function validateEducationLevel($educationLevelId = '')
    {
        return [
            'name_en' => 'required|string|regex:/[a-zA-Z]/|max:180|unique:education_levels,name_en,' . $educationLevelId,
            'name_ar' => 'required|string|max:180|unique:education_levels,name_ar,' . $educationLevelId,
        ];
    }
    public function validateOrganization()
    {
        return [
            'region_id' => 'required|integer|exists:regions,id',
            'city_id' => 'required|integer|exists:cities,id',
            'education_level_id' => 'required|integer|exists:education_levels,id',
            'name_en' => 'required|string|regex:/[a-zA-Z]/|max:180|unique:organizations,name_en',
            'name_ar' => 'required|string|max:180|unique:organizations,name_ar',
            'domain' => 'required|string|unique:organizations,domain',
            // 'email' => 'required|string|email|unique:users,email|unique:users,email|min:10|max:181',
            // 'password' => 'required|string|min:6|max:181',
            'discount' => 'required|numeric|min:0|max:99',
            'banner' => 'required|mimes:jpeg,jpeg,svg,png|image',
            'image' => 'required|mimes:jpeg,jpeg,svg,png|image',
            'banner_dashboard' => 'required|mimes:jpeg,jpeg,svg,png|image',
            'logo_login' => 'required|mimes:jpeg,jpeg,svg,png|image',
            'delivery_price' => 'required',
            'max_order_number' => 'required',
            'address' => 'required',
            'shipment_city' => 'required'
        ];
    }
    public function validateOrganizationUpdate($organizationId = '')
    {
        return [
            'region_id' => 'required|integer|exists:regions,id',
            'city_id' => 'required|integer|exists:cities,id',
            'education_level_id' => 'required|integer|exists:education_levels,id',
            'name_en' => 'required|string|regex:/[a-zA-Z]/|max:180|unique:organizations,name_en,' . $organizationId,
            'name_ar' => 'required|string|max:180|unique:organizations,name_ar,' . $organizationId,
            'domain' => 'required|string|',
            // 'email' => 'required|string|email|min:10|max:181|unique:users,email|unique:organizations,email,' . $organizationId,
            // 'password' => 'required|string|min:6|max:181',
            'discount' => 'required|numeric|min:0|max:99',
            'banner' => 'nullable|mimes:jpeg,jpeg,svg,png|image',
            'image' => 'nullable|mimes:jpeg,jpeg,svg,png|image',
            'banner_dashboard' => 'nullable|mimes:jpeg,jpeg,svg,png|image',
            'logo_login' => 'nullable|mimes:jpeg,jpeg,svg,png|image',
            'delivery_price' => 'required',
            'max_order_number' => 'required',
            'address' => 'required',
            'shipment_city' => 'required'
        ];
    }

    public function validateRole($role = '')
    {
        return [
            'name_en' => 'required|string|regex:/[a-zA-Z]/|max:180|unique:roles,name_en,' . $role,
            'name_ar' => 'required|string|max:180|unique:roles,name_ar,' . $role,
        ];
    }
    public function validateBanner()
    {
        return [
            'image' => 'nullable|mimes:jpeg,jpeg,svg,png|image',
        ];
    }
    public function validateHomeIntro()
    {
        return [
            'title_en' => 'required|string|regex:/[a-zA-Z]/',
            'title_ar' => 'required|string',
            'text_en' => 'required|string',
            'text_ar' => 'required|string',
        ];
    }
    public function validateVision()
    {
        return [
            'title_en' => 'required|string|regex:/[a-zA-Z]/',
            'title_ar' => 'required|string',
            'text_en' => 'required|string',
            'text_ar' => 'required|string',
        ];
    }
    public function validateMissions($missionId = '')
    {
        $rules = [
            'title_en' => 'required|string|regex:/[a-zA-Z]/',
            'title_ar' => 'required|string',
            'text_en' => 'required|string',
            'text_ar' => 'required|string',
        ];
        if ($missionId == '') {
            $rules['image'] = 'required|mimes:jpeg,jpeg,svg,png|image';
        } else {
            $rules['image'] = 'nullable|mimes:jpeg,jpeg,svg,png|image';
        }

        return $rules;
    }

    public function validateCustomisedSolution()
    {
        return [
            'text_en' => 'required|string',
            'text_ar' => 'required|string',
        ];
    }
    public function validateEveryOneCode($everyOneCodeId = '')
    {
        $rules = [
            'title_en' => 'required|string|regex:/[a-zA-Z]/',
            'title_ar' => 'required',
            'text_en' => 'required|string',
            'text_ar' => 'required|string',
            'url' => 'required|string',
        ];
        if ($everyOneCodeId != '') {
            $rules['image'] = 'nullable|mimes:jpeg,jpeg,svg,png|image';
        } else {
            $rules['image'] = 'required|mimes:jpeg,jpeg,svg,png|image';
        }
        return $rules;
    }
    public function validateEveryOneCreate($everyOneCreateId = '')
    {
        $rules = [
            'text_en' => 'required|string|regex:/[a-zA-Z]/',
            'text_ar' => 'required|string',
            'findout_link' => 'required|string',
            'download_link' => 'required|string',
        ];
        if ($everyOneCreateId != '') {
            $rules['image'] = 'nullable|mimes:jpeg,jpeg,svg,png|image';
        } else {
            $rules['image'] = 'required|mimes:jpeg,jpeg,svg,png|image';
        }
        return $rules;
    }
    public function validateEducationCommunity($educationCommunityId = '')
    {
        $rules = [
            'text_en' => 'required|string|regex:/[a-zA-Z]/',
            'text_ar' => 'required|string',
            'title_en' => 'required|string',
            'title_ar' => 'required|string',
            'url' => 'required|string',
        ];
        if ($educationCommunityId != '') {
            $rules['image'] = 'nullable|mimes:jpeg,jpeg,svg,png|image';
        } else {
            $rules['image'] = 'required|mimes:jpeg,jpeg,svg,png|image';
        }
        return $rules;
    }
    public function validateParental($parentalId = '')
    {
        $rules = [
            'text_en' => 'required|string|regex:/[a-zA-Z]/',
            'text_ar' => 'required|string',
        ];
        if ($parentalId != '') {
            $rules['image'] = 'nullable|mimes:jpeg,jpeg,svg,png|image';
        } else {
            $rules['image'] = 'required|mimes:jpeg,jpeg,svg,png|image';
        }
        return $rules;
    }

    public function validateEducationIntro()
    {
        return [
            'text_en' => 'required|string|regex:/[a-zA-Z]/',
            'text_ar' => 'required|string',
            // 'text_2_en' => 'required|string',
            // 'text_2_ar' => 'required|string',
            'url' => 'required|string',
        ];
    }
    public function validateService()
    {
        return [
            'title_en' => 'required|string|regex:/[a-zA-Z]/',
            'title_ar' => 'required|string',
        ];
    }

    public function validateOnlineCourse($onlineCourseId = '')
    {
        $rules = [
            'title_en' => 'required|string|regex:/[a-zA-Z]/',
            'title_ar' => 'required|string',
            'title_2_en' => 'required|string|regex:/[a-zA-Z]/',
            'title_2_ar' => 'required|string',
        ];
        if ($onlineCourseId != '') {
            $rules['image'] = 'nullable|mimes:jpeg,jpeg,svg,png|image';
        } else {
            $rules['image'] = 'required|mimes:jpeg,jpeg,svg,png|image';
        }
        return $rules;
    }

    public function validateParentalTitle()
    {
        return [
            'title_en' => 'required|string|regex:/[a-zA-Z]/',
            'title_ar' => 'required|string',
        ];
    }
    public function validateUpdateOrderStatus()
    {
        return [
            'status' => 'required|string|' . Rule::in(OrderStatus::ORDER_PLACED, OrderStatus::IN_PROGRESS, OrderStatus::SHIPPED, OrderStatus::OUT_FOR_DELIVERY, OrderStatus::DELIVERED, OrderStatus::CANCELLED),
        ];
    }

    public function validateCourses($courseId = '')
    {
        $rules = [
            // 'education_level_id' => 'required|integer|exists:education_levels,id',
            'education_level_id' => 'required',
            'title_en' => 'required|string|regex:/[a-zA-Z]/',
            'title_ar' => 'required|string',
            'estimated_time' => 'nullable|numeric|min:0|max:99',
            'brief_en' => 'required|string',
            'brief_ar' => 'required|string',
            'what_will_learn_en' => 'nullable|string',
            'what_will_learn_ar' => 'nullable|string',
            'content_en' => 'nullable|string',
            'content_ar' => 'nullable|string',
            'requirements_en' => 'nullable|string',
            'requirements_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'about_en' => 'nullable|string',
            'about_ar' => 'nullable|string',
            'url' => 'required',
//            'url' => 'nullable/*|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/*/',
        ];
        if ($courseId != '') {
            $rules['image'] = 'nullable|mimes:jpeg,jpeg,svg,png|image';
            $rules['banner'] = 'nullable|mimes:jpeg,jpeg,svg,png|image';
        } else {
            $rules['image'] = 'required|mimes:jpeg,jpeg,svg,png|image';
            $rules['banner'] = 'required|mimes:jpeg,jpeg,svg,png|image';
        }
        return $rules;
    }

    public function validateTraning()
    {
        return [
            'title_en' => 'required|string|regex:/[a-zA-Z]/',
            'title_ar' => 'required|string',
            'text_en' => 'required|string',
            'text_ar' => 'required|string',
        ];
    }

    public function validateFeature($featureId = '')
    {
        $rules = [
            'title_en' => 'required|string|regex:/[a-zA-Z]/',
            'title_ar' => 'required|string',
            'text_en' => 'required|string',
            'text_ar' => 'required|string',
        ];

        if ($featureId != '') {
            $rules['image'] = 'nullable|mimes:jpeg,jpeg,svg,png|image';
        } else {
            $rules['image'] = 'required|mimes:jpeg,jpeg,svg,png|image';
        }

        return $rules;
    }
    public function validateTerms($cityId = '')
    {
        return [
            'title_en' => 'required|string|unique:terms,title_en,'.$cityId,
            'title_ar' => 'required|string|unique:terms,title_ar,'.$cityId,
            'sub_title_en' => 'nullable|string',
            'sub_title_ar' => 'nullable|string',
            'content_en' => 'required',
            'content_ar' => 'required',
        ];
    }
    public function validateTermsHeader()
    {
        return [
            'header_en' => 'required',
            'header_ar' => 'required',
        ];
    }
    public function validateOffer($offer_id='')
    {
        return [
            'title_en' => 'required',
            'title_ar' => 'required',
            'brief_en' => 'required',
            'brief_ar' => 'required',
            'discription_en' => 'required',
            'discription_ar' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'percent' => 'required',
            'status' => 'nullable',
        ];
    }
    public function validateOrganizationOffer()
    {
        return [
            'offer_id' => 'required|exists:offers,id',
            'organization_id' => 'required|exists:organizations,id',
        ];
    }
}
