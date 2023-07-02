<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;
use Illuminate\Support\Str;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = config('dataseeder.types');
        foreach($types as $type)
        {
            $newType  = new Type();
            $newType-> name = $type['name'];
            $newType->slug = Str::slug($newType->name, "-");
            $newType-> image = $type['image'];

            $newType->save();
        }
    }
}
