<?php

namespace Database\Factories;

use App\Models\HouseholdMember;
use Illuminate\Database\Eloquent\Factories\Factory;

class HouseholdMemberFactory extends Factory
{
    protected $model = HouseholdMember::class;

    public function definition()
    {
        $relationship = $this->faker->randomElement([
            'Chủ hộ',
            'Vợ (chồng)',
            'Cha đẻ, mẹ đẻ',
            'Cha nuôi, mẹ nuôi',
            'Con đẻ',
            'Con nuôi',
            'Ông nội, bà nội',
            'Ông ngoại, bà ngoại',
            'Anh ruột; chị ruột; em ruột; cháu ruột',
            'Cụ nội, cụ ngoại',
            'Bác ruột, chú ruột, cậu ruột, cô ruột, dì ruột, chắt ruột',
            'Người giám hộ',
            'Người ở nhờ; ở mượn; ở thuê',
            'Người cùng ở nhờ; cùng ở thuê; cùng ở mượn'
        ]);
        $isOwner = $this->faker->boolean;
        $householdId = \App\Models\Household::inRandomOrder()->first()->id;

        return [
            'personId' => \App\Models\Person::inRandomOrder()->first()->id,
            'householdId' => $householdId,
            'relationship' => $relationship,
            'isOwner' => $isOwner ? true : false,
        ];
    }
}
