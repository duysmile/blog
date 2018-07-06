<?php

namespace App\Console\Commands;

use App\Article;
use Illuminate\Console\Command;

class CronJobUpdateStatusArticle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Cronjob:changeStatusArticle';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change status to Public';

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
        if(Article::updateArticleStatusDaily()){
            $this->info('Change status to Public successfully.');
        }
        else{
            $this->info('Something wrong when updating status.');
        }
    }
}
