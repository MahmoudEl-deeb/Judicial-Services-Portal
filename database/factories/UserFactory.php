<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;

class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        // لستة محافظات مصرية
        $governorates = [
            'القاهرة', 'الجيزة', 'الإسكندرية', 'الدقهلية', 'البحيرة', 'الغربية', 'الشرقية',
            'المنوفية', 'القليوبية', 'كفر الشيخ', 'دمياط', 'بورسعيد', 'الإسماعيلية', 'السويس',
            'الفيوم', 'بني سويف', 'المنيا', 'أسيوط', 'سوهاج', 'قنا', 'الأقصر', 'أسوان',
            'البحر الأحمر', 'الوادي الجديد', 'مطروح', 'شمال سيناء', 'جنوب سيناء'
        ];

        // اختار محافظة عشوائية
        $gov = fake()->randomElement($governorates);

        return [
            'first_name'        => fake('ar_EG')->firstName(),
            'last_name'         => fake('ar_EG')->lastName(),
            'email'             => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password'          => static::$password ??= Hash::make('password'),

            // رقم قومي (14 رقم يبدأ غالباً بـ 2 أو 3)
            'national_id'       => fake()->unique()->numerify(fake()->randomElement(['2#############','3#############'])),

            // رقم موبايل مصري (010, 011, 012, 015)
            'phone'             => fake()->numerify(fake()->randomElement(['010########','011########','012########','015########'])),

            'status'            => 'active',

            // عناوين مصرية بسيطة
            'address'           => fake('ar_EG')->streetName().' - '.$gov,
            'city'              => fake('ar_EG')->city(),
            'governorate'       => $gov,
            'zipcode'           => fake()->numerify('#####'), // ممكن تسيبها أرقام عشوائية

            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'remember_token'    => Str::random(10),
            'profile_photo_path'=> null,
            'current_team_id'   => null,
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function withPersonalTeam(?callable $callback = null): static
    {
        if (! Features::hasTeamFeatures()) {
            return $this->state([]);
        }

        return $this->has(
            Team::factory()
                ->state(fn (array $attributes, User $user) => [
                    'name' => $user->first_name.' '.$user->last_name.'\'s Team',
                    'user_id' => $user->id,
                    'personal_team' => true,
                ])
                ->when(is_callable($callback), $callback),
            'ownedTeams'
        );
    }

    // States
    public function active(): static
    {
        return $this->state(fn () => ['status' => 'active']);
    }

    public function inactive(): static
    {
        return $this->state(fn () => ['status' => 'inactive']);
    }

    public function suspended(): static
    {
        return $this->state(fn () => ['status' => 'suspended']);
    }
}
