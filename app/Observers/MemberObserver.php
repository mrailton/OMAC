<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Member;
use Illuminate\Support\Facades\Storage;

class MemberObserver
{
    /**
     * Handle the Member "created" event.
     */
    public function created(Member $member): void
    {
        //
    }

    /**
     * Handle the Member "updated" event.
     */
    public function updated(Member $member): void
    {
        if ($member->isDirty('files')) {
            $originalFieldContents = $member->getOriginal('files');
            $newFieldContents = $member->files;

            foreach ($originalFieldContents as $file) {
                if ( ! in_array($file, $newFieldContents)) {
                    Storage::disk('s3')->delete($file);
                }
            }
        }
    }

    /**
     * Handle the Member "deleted" event.
     */
    public function deleted(Member $member): void
    {
        if (null !== $member->files) {
            foreach ($member->files as $file) {
                Storage::disk('s3')->delete($file);
            }
        }
    }

    /**
     * Handle the Member "restored" event.
     */
    public function restored(Member $member): void
    {
        //
    }

    /**
     * Handle the Member "force deleted" event.
     */
    public function forceDeleted(Member $member): void
    {
        //
    }
}
