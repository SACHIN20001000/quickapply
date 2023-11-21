<?php

namespace App\Http\Resources\Users;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
           
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
             'profile' => $this->profile,
            'phone' => $this->phone,
            'birthday' => $this->birthday,
            'anniversary' => $this->anniversary,
            'account_no' => $this->account_no,
            'bank_name' => $this->bank_name,
            'account_name' => $this->account_name,
            'ifsc' => $this->ifsc,
            'upi' => $this->upi,
            'photo' => $this->photo,
            'pan_card' => $this->pan_card,
            'aadhar_card' => $this->aadhar_card,
            'gst' => $this->gst,
            'advance_payout' => $this->advance_payout,
            'gender'=>$this->gender,
            'city'=>$this->city,
            'state'=>$this->state,
            'address'=>$this->address,
            'github_url'=>$this->github_url,
            'linkdin_url'=>$this->linkdin_url,
            'ziprecuriter_url'=>$this->ziprecuriter_url,
            'tds_percentage'=>$this->tds_percentage,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'roles' => $this->getRoleNames(),
            'permissions' => $this->getAllPermissions()->pluck('name'),



                   
        ];
    }
}
