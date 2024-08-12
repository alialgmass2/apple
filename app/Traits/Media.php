<?php

namespace App\Traits;

use App\Models\Color;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

// NOTE THIS TRAIT FILE WORKING IN STORAGE FOLDER TO UPLOAD NOT PUBLIC
trait Media
{

    // UPLOAD FILES and store to morph taple
    public function uploadFile($request, $groupName = 'default')
    {
        $originalFileName = str_replace(' ', '_', $request->getClientOriginalName());
        $originalFileExtension = $request->getClientOriginalExtension();
        $dateTime = date('Ymd_His');
        $fileName = $dateTime . '_' . Str::random(30) . str_shuffle($originalFileName) . '.' . $originalFileExtension;
        // EMPTY BECAUSE WILL TAKE FOLDER NAME FROM DEFINED DISK FIN filesystem.php & NO NEED MORE SUP FOLDERS
        $request->storeAs('uploads', $fileName);
        $url = $fileName;
        return $this->images()->create([
            'name' => $originalFileName,
            'url' => $url,
            'group_name' => $groupName,
        ]);
    }

    // Get FILE
    public function getFile($groupName = 'default')
    {
        $file = $this->images()->where('group_name', $groupName)->latest();
        // return $file->count() > 0 ? route('admin.uploads', $file->first()->url) : null;
        return $file->count() > 0 ? route('website.uploads', $file->first()->url) : null;
    }
    public function getFilesUrl($groupName = 'default')
    {
        $url = [];
        $files = $this->images()->where('group_name', $groupName)->get();
        foreach ($files as $file) {
            $url []= route('website.uploads', $file->url);
        }
        return $url;
    }

    // Get FILES
    public function getFiles($groupName = 'default', $groupColor = null)
    {
        $files = $this->images()->where('group_name', $groupName);
        $files = $groupColor == null ? $files : $files->where('color_code', $groupColor);
        return $files->count() > 0 ? $files->get(['id', 'url','color_code']) : [];
    }
    public function getColorImages($color_name )
    {
        $color = Color::where('color_name', $color_name)->first();
        $files = $this->images()->where('id', $color->id);
        return $files->count() > 0 ? $files->get(['id', 'url','color_code']) : [];
    }
    public function getColors()
    {
        $ids = $this->images()->where([['group_name', 'default'],['color_code','!=',null]])->get('color_code');
        $color = Color::whereIn('id', $ids);
        return $color->count() > 0 ? $color->get(['id','color_name','color_code']) : [];
    }

    public function deleteFile($groupName = 'default')
    {
        $file = $this->images()->where('group_name', $groupName)->latest();
        if ($file->count() > 0) {
            $filePath = $file->first()->url;
            $storageDisk = Storage::disk('uploads');
            $storageDisk->has($filePath) ? $storageDisk->delete($filePath) : '';
            return $file->delete();
        }
    }

    public function deleteFiles($groupName = 'default')
    {
        $files = $this->images()->where('group_name', $groupName);
        if ($files->count() > 0) {
            $storageDisk = Storage::disk('uploads');
            foreach ($files->get() as $file) {
                $filePath = $file->url;
                $storageDisk->has($filePath) ? $storageDisk
                    ->delete($filePath) : '';
            }
            return $files->delete();
        }
    }
    // REALTION
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
