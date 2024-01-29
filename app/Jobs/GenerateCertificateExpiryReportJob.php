<?php

namespace App\Jobs;

use App\Mail\CertificateExpiryMail;
use App\Models\Member;
use App\Models\User;
use App\Models\UserReport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class GenerateCertificateExpiryReportJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;


    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $members = $this->getMembers();
        $recipients = $this->getRecipients();

        foreach ($recipients as $user) {
            Mail::to($user)->queue(new CertificateExpiryMail($members));
        }
    }

    public function getMembers(): Collection
    {
        $date = now()->addMonths(3);

        return Member::query()
            ->where('cfr_expires_on', '<', $date)
            ->orWhere('cert_expires_on', '<', $date)
            ->orWhere('garda_vetting_date', '<', $date->clone()->subYears(3))
            ->orWhere('manual_handling_date', '<', $date->clone()->subYears(2))
            ->get();
    }

    public function getRecipients(): Collection
    {
        $recipients = new Collection();
        $reports = UserReport::query()->with('user')->where('report', '=', 'certificate_expiry_report')->get();

        $reports->map(function (UserReport $report) use ($recipients) {
            $recipients->add($report->user);
        });

        return $recipients;
    }
}
