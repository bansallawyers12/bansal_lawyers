<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use App\Models\Admin;
// Invoice-related models removed - not needed for appointment system
// use App\Models\Invoice;
// use App\Models\Item;
// use App\Models\InvoiceDetail;
// use App\Models\InvoicePayment;
// use App\Models\InvoiceFollowup;
// use App\Models\TaxRate;
// use App\Models\Currency;
 use DateTime;
 use App\Mail\CommonMail;
use Mail;
use Config;
class CronJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CronJob:cronjob';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'User Name Change Successfully';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Invoice-related functionality removed - not needed for appointment system
        $this->info('CronJob executed - invoice functionality removed.');
    }
	
}
?>
