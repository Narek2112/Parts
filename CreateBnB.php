<?php

namespace App\Http\Requests\Listing;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Traits\RequestHelper;

/**
 * Class CreateBnB
 * @package App\Http\Requests\Listing
 */
class CreateBnB extends FormRequest
{
    use RequestHelper;

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
            // System
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'category_id' => ['required', 'integer', 'exists:listing_categories,id'],
            'status' => ['required', 'integer'],

            // General
            'title' => ['required', 'string', 'max:255'],
            'listing_type' => ['required', 'string'],
            'home_type' => ['required', 'string'],

            // Location
            'country' => ['required', 'string'],
            'property_address' => ['required', 'string'],
            'appt_suite' => ['nullable', 'string'],
            'city' => ['required', 'string'],
            'state' => ['required', 'string'],
            'postal' => ['required', 'string'],

            // Listing details
            'bedrooms_count' => ['required', 'integer'],
            'bathrooms_count' => ['required', 'integer'],
            'max_guests' => ['required', 'integer'],
            'price_per_night' => ['required', 'numeric'],
            'price_per_guest' => ['required', 'numeric'],
            'cleaning_fee' => ['required', 'numeric'],

            // Booking details
            'instant_booking' => ['checkbox'],
            'breakfast_included' => ['checkbox'],
            'check_in' => ['date_format:Y-m-d H:i:s', 'required'],
            'check_out' => ['date_format:Y-m-d H:i:s', 'required'],
            'check_in_process' => ['string'],
            'booking_description' => ['nullable', 'string'],

            // Amenities
            'no_stairs' => ['checkbox'],
            'elevator' => ['checkbox'],
            'walk_in_shower' => ['checkbox'],
            'grab_bar_in_bathroom' => ['checkbox'],
            'off_street_parking' => ['checkbox'],
            'free_parking' => ['checkbox'],

            'kitchen' => ['checkbox'],
            'fridge' => ['checkbox'],
            'microwave' => ['checkbox'],
            'heating' => ['checkbox'],
            'ac' => ['checkbox'],
            'washer' => ['checkbox'],
            'dryer' => ['checkbox'],
            'iron' => ['checkbox'],
            'laptop_friendly_workspace' => ['checkbox'],
            'tv' => ['checkbox'],
            'private_bathroom' => ['checkbox'],
            'patio' => ['checkbox'],
            'deck' => ['checkbox'],
            'backyard' => ['checkbox'],
            'grill' => ['checkbox'],

            'smoke_alarm' => ['checkbox'],
            'carbon_monoxide_detector' => ['checkbox'],
            'lock_on_door' => ['checkbox'],
            'fire_extinguisher' => ['checkbox'],
            'onsite_host' => ['checkbox'],

            'crib' => ['checkbox'],
            'highchair' => ['checkbox'],
            'children_allowed' => ['checkbox'],

            'wifi' => ['checkbox'],
            'pets_allowed' => ['checkbox'],
            'smoking_allowed' => ['checkbox'],
            '420_friendly' => ['checkbox'],
            'pool' => ['checkbox'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $fields = [
            'user_id' => Auth::user()->id,
            'status' => 1
        ];

        foreach ($this->rules() as $field => $rules) {
            if (in_array('checkbox', $rules)) {
                $fields[$field] = $this->toBoolean($this[$field]);
            }
            if (in_array('date_format:Y-m-d H:i:s', $rules)) {
                $fields[$field] = $this->timeToDatetime($this[$field]);
            }
        }

        $this->merge($fields);
    }
}
