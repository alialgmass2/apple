<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\City;
use App\Models\Role;
use App\Models\Admin;
use App\Models\Banner;
use App\Models\Course;
use App\Models\Region;
use App\Models\Vision;
use App\Models\Contact;
use App\Models\Mission;
use App\Models\Product;
use App\Models\Service;
use App\Models\Category;
use App\Models\Parental;
use App\Models\Solution;
use App\Models\Training;
use App\Models\HomeIntro;
use App\Models\Technical;
use App\Models\LearnIntro;
use App\Models\ITContactUs;
use App\Models\LearnBanner;
use App\Models\SubCategory;
use App\Models\EveryOneCode;
use App\Models\LearnShopNow;
use App\Models\OnlineCourse;
use App\Models\Organization;
use App\Models\StudentIntro;
use App\Models\EducatorIntro;
use App\Models\MissionBanner;
use App\Models\ParentalTitle;
use App\Models\StudentBanner;
use App\Models\EducationIntro;
use App\Models\EducationLevel;
use App\Models\EducatorBanner;
use App\Models\EveryOneCreate;
use App\Models\StudentFeature;
use App\Models\EducationBanner;
use App\Models\LeadershipIntro;
use Illuminate\Database\Seeder;
use App\Models\BookAConsulation;
use App\Models\BookConsultation;
use App\Models\EducationFeature;
use App\Models\LeadershipBanner;
use App\Models\CustomisedSolution;
use App\Models\EducationCommunity;
use App\Models\LeadershipOurValue;
use App\Models\CustomisedSolutionBanner;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Admin::create([
            'name' => 'Admin Name',
            'email' => 'admin@mail.com',
            'password' => 123456,
        ]);
        Region::factory(3)->create();
        City::factory(10)->create();
        EducationLevel::factory(1)->create();
        // Organization::factory(1)->create();
        // =============== START
        Organization::factory(2)->create()
            ->each(function ($value) {
                $image = $this->createImage();
                $imageBanner = $this->createImage();
                $value->images()->create([
                    'name' => $imageBanner['name'],
                    'url' => $imageBanner['url'],
                    'group_name' => 'banner',
                ]);

                $value->images()->create([
                    'name' => $image['name'],
                    'url' => $image['url'],
                    'group_name' => $image['group_name'],
                ]);
            });
// =============== END

        Category::factory(5)->create();
        SubCategory::factory(15)->create();
        // Product::factory(5)->create();
        // =============== START
        Product::factory(10)->create()
            ->each(function ($value) {
                $image = $this->createImage();
                $imageBanner = $this->createImage();
                $value->images()->create([
                    'name' => $imageBanner['name'],
                    'url' => $imageBanner['url'],
                    'group_name' => 'banner',
                ]);
                $value->images()->create([
                    'name' => $image['name'],
                    'url' => $image['url'],
                    'group_name' => 'default_img',
                ]);

            });
// =============== END

        // HowTo::factory(15)->create();
        Role::factory(4)->create();
        // User::create([
        //     'user_type' => UserType::TEACHER,
        //     'region_id' => 1,
        //     'city_id' => 1,
        //     'education_level_id' => 1,
        //     'organization_id' => 1,
        //     'email' => 'user@mail.com',
        //     'password' => 123456,
        //     'otp_verified' => 1,
        // ]);
        // User::factory(15)->create();

        Contact::factory(10)->create();
        BookAConsulation::factory(10)->create();
        ITContactUs::factory(10)->create();
        // =============== START
        Banner::factory()->create()
            ->each(function ($value) {
                $image = $this->createImage();
                $value->images()->create([
                    'name' => $image['name'],
                    'url' => $image['url'],
                    'group_name' => 'default',
                ]);
            });
        // =============== END
        HomeIntro::factory()->create(); // ONLY EDIT CREATE DEFAULT FOR PRODUCTION
        Vision::factory()->create(); // ONLY EDIT CREATE DEFAULT FOR PRODUCTION
        LeadershipIntro::factory()->create(); // ONLY EDIT CREATE DEFAULT FOR PRODUCTION
        LeadershipOurValue::factory()->create(); // ONLY EDIT CREATE DEFAULT FOR PRODUCTION
        CustomisedSolution::factory()->create(); // ONLY EDIT CREATE DEFAULT FOR PRODUCTION
        BookConsultation::factory()->create(); // ONLY EDIT CREATE DEFAULT FOR PRODUCTION
        EducatorIntro::factory()->create(); // ONLY EDIT CREATE DEFAULT FOR PRODUCTION
        StudentIntro::factory()->create(); // ONLY EDIT CREATE DEFAULT FOR PRODUCTION
        EducationIntro::factory()->create(); // ONLY EDIT CREATE DEFAULT FOR PRODUCTION
        LearnIntro::factory()->create(); // ONLY EDIT CREATE DEFAULT FOR PRODUCTION
        // =============== START
        Mission::factory(2)->create()
            ->each(function ($value) {
                $image = $this->createImage();
                $value->images()->create([
                    'name' => $image['name'],
                    'url' => $image['url'],
                    'group_name' => $image['group_name'],
                ]);
            });
        // =============== END
        // =============== START
        Solution::factory(1)->create()
            ->each(function ($value) {
                $image = $this->createImage();
                $value->images()->create([
                    'name' => $image['name'],
                    'url' => $image['url'],
                    'group_name' => $image['group_name'],
                ]);
            });
        // =============== END
        // =============== START
        Technical::factory()->create()
            ->each(function ($value) {
                $image = $this->createImage();
                $value->images()->create([
                    'name' => $image['name'],
                    'url' => $image['url'],
                    'group_name' => $image['group_name'],
                ]);
            });
        // =============== END
        // =============== START
        Training::factory(1)->create()
            ->each(function ($value) {
                $image = $this->createImage();
                $value->images()->create([
                    'name' => $image['name'],
                    'url' => $image['url'],
                    'group_name' => $image['group_name'],
                ]);
            });
        // =============== END
        // =============== START
        LeadershipBanner::factory()->create()
            ->each(function ($value) {
                $image = $this->createImage();
                $value->images()->create([
                    'name' => $image['name'],
                    'url' => $image['url'],
                    'group_name' => 'default',
                ]);
            });
        // =============== END
        // =============== START
        EducatorBanner::factory()->create()
            ->each(function ($value) {
                $image = $this->createImage();
                $value->images()->create([
                    'name' => $image['name'],
                    'url' => $image['url'],
                    'group_name' => 'default',
                ]);
            });
        // =============== END
        // =============== START
        EveryOneCode::factory(2)->create()
            ->each(function ($value) {
                $image = $this->createImage();
                $value->images()->create([
                    'name' => $image['name'],
                    'url' => $image['url'],
                    'group_name' => 'default',
                ]);
            });
        // =============== END
        // =============== START
        EveryOneCreate::factory()->create()
            ->each(function ($value) {
                $image = $this->createImage();
                $value->images()->create([
                    'name' => $image['name'],
                    'url' => $image['url'],
                    'group_name' => 'default',
                ]);
            });
        // =============== END
        // =============== START
        EducationCommunity::factory()->create()
            ->each(function ($value) {
                $image = $this->createImage();
                $value->images()->create([
                    'name' => $image['name'],
                    'url' => $image['url'],
                    'group_name' => 'default',
                ]);
            });
        // =============== END
        // =============== START
        StudentBanner::factory()->create()
            ->each(function ($value) {
                $image = $this->createImage();
                $value->images()->create([
                    'name' => $image['name'],
                    'url' => $image['url'],
                    'group_name' => 'default',
                ]);
            });
        // =============== END
        // =============== START
        Parental::factory()->create()
            ->each(function ($value) {
                $image = $this->createImage();
                $value->images()->create([
                    'name' => $image['name'],
                    'url' => $image['url'],
                    'group_name' => 'default',
                ]);
            });
        // =============== END
// =============== START
        EducationBanner::factory()->create()
            ->each(function ($value) {
                $image = $this->createImage();
                $value->images()->create([
                    'name' => $image['name'],
                    'url' => $image['url'],
                    'group_name' => 'default',
                ]);
            });
// =============== END
        Service::factory(10)->create();
// =============== START
        LearnBanner::factory()->create()
            ->each(function ($value) {
                $image = $this->createImage();
                $value->images()->create([
                    'name' => $image['name'],
                    'url' => $image['url'],
                    'group_name' => 'default',
                ]);
            });
// =============== END
// =============== START
        OnlineCourse::factory(2)->create()
            ->each(function ($value) {
                $image = $this->createImage();
                $value->images()->create([
                    'name' => $image['name'],
                    'url' => $image['url'],
                    'group_name' => 'default',
                ]);
            });
// =============== END

// =============== START
        MissionBanner::factory()->create()
            ->each(function ($value) {
                $image = $this->createImage();
                $value->images()->create([
                    'name' => $image['name'],
                    'url' => $image['url'],
                    'group_name' => 'default',
                ]);
            });
// =============== END

// =============== START
        CustomisedSolutionBanner::factory()->create()
            ->each(function ($value) {
                $image = $this->createImage();
                $value->images()->create([
                    'name' => $image['name'],
                    'url' => $image['url'],
                    'group_name' => 'default',
                ]);
            });
// =============== END
        ParentalTitle::factory(5)->create();
        // =============== START
        Course::factory(5)->create()
            ->each(function ($value) {
                $banner = $this->createImage();
                $image = $this->createImage();
                $value->images()->create([
                    'name' => $banner['name'],
                    'url' => $banner['url'],
                    'group_name' => 'banner',
                ]);
                $value->images()->create([
                    'name' => $image['name'],
                    'url' => $image['url'],
                    'group_name' => 'default',
                ]);
            });
        // =============== END
        LearnShopNow::factory(1)->create();
        // =============== START
        EducationFeature::factory()->create()
            ->each(function ($value) {
                $image = $this->createImage();
                $value->images()->create([
                    'name' => $image['name'],
                    'url' => $image['url'],
                    'group_name' => 'default',
                ]);
            });
// =============== END
        // =============== START
        StudentFeature::factory()->create()
            ->each(function ($value) {
                $image = $this->createImage();
                $value->images()->create([
                    'name' => $image['name'],
                    'url' => $image['url'],
                    'group_name' => 'default',
                ]);
            });
// =============== END

    }

    /*=============================================
    =       CREATE FAKE IMAGES FROM LOCAL Section            =
    =============================================*/
    public function createImage()
    {
        $root = '';
        $path = storage_path('app/uploads');
        $imgList = $this->getImagesFromDir($root . $path);
        $imgName = $this->getRandomFromArray($imgList);
        return [
            // 'url' => 'uploads/' . $img,
            'url' => $imgName,
            'name' => $imgName,
            'group_name' => 'default',
        ];
    }

    public function getImagesFromDir($path)
    {
        $images = array();
        if ($img_dir = @opendir($path)) {
            while (false !== ($img_file = readdir($img_dir))) {
                if (preg_match("/(\.gif|\.jpg|\.jpeg|\.png|\.svg)$/", $img_file)) {
                    $images[] = $img_file;
                }
            }
            closedir($img_dir);
        }
        return $images;
    }

    public function getRandomFromArray($ar)
    {
        $num = array_rand($ar);
        return $ar[$num];
    }

    /* ====  End of CREATE FAKE IMAGES FROM LOCAL==== */
}
