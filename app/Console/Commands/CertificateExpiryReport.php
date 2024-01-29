<?php

namespace App\Console\Commands;

use App\Jobs\GenerateCertificateExpiryReportJob;
use Illuminate\Console\Command;

class CertificateExpiryReport extends Command
{
    protected $signature = 'report:certificate-expiry';

    protected $description = 'Generate Certificate Expiry Report';

    public function handle(): int
    {
        GenerateCertificateExpiryReportJob::dispatch();

        return 0;
    }
}
