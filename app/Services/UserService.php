<?php

namespace App\Services;

use App\Models\{User,Detail};
use Illuminate\Http\Request;

class UserService
{
    public function listCategories()
    {
        dd('test');
        return User::select('User.*');
    }

    public function storeCategory(array $data)
    {
        dd($data);
        return User::create($data);
    }

    public function saveUserDetails(User $user)
    {
        $fullName = trim("{$user->firstname} {$user->middlename} {$user->lastname}");
        $middleInitial = $user->middlename ? strtoupper(substr($user->middlename, 0, 1)) : '';
        $avatar = $user->photo ?? 'default.png';
        $gender = $this->getGenderFromPrefix($user->prefixname);

        $details = [
            ['key' => 'full_name', 'value' => $fullName],
            ['key' => 'middle_initial', 'value' => $middleInitial],
            ['key' => 'avatar', 'value' => $avatar],
            ['key' => 'gender', 'value' => $gender],
        ];

        foreach ($details as $detail) {
            Detail::create([
                'user_id' => $user->id,
                'key' => $detail['key'],
                'value' => $detail['value'],
                'status' => 1
            ]);
        }

        // Send email 
        Mail::to($user->email)->send(new \App\Mail\UserDetailsSavedMail($details));
    }
    private function getGenderFromPrefix($prefix)
    {
        return match (strtolower($prefix)) {
            'mr' => 'male',
            'mrs', 'ms', 'miss' => 'female',
            default => 'unknown',
        };
    }

   



}