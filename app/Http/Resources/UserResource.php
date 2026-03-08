<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                    => $this->id,
            'name'                  => $this->name,
            'user_name'             => $this->user_name,
            'kyc_status'            => $this->kyc_status,
            'email_verified_at'     => $this->email_verified_at,
            'email'                 => $this->email,
            'forget_password_token' => $this->forget_password_token,
            'forget_password_otp'   => $this->forget_password_otp,
            'status'                => $this->status,
            'image'                 => $this->image,
            'phone'                 => $this->phone,
            'country_id'            => $this->country_id,
            'state_id'              => $this->state_id,
            'city_id'               => $this->city_id,
            'zip_code'              => $this->zip_code,
            'address'               => $this->address,
            'is_provider'           => $this->is_provider,
            'email_verified'        => $this->email_verified,
            'agree_policy'          => $this->agree_policy,
            'designation'           => $this->designation,
        ];
    }
}
