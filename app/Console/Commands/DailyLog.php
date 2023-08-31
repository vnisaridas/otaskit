<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;
use Mail;

class DailyLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'DailyLog';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $data = Task::whereDay('created_at', now()->day)->get();
        $fileName = time().'-file.csv';
        $columnNames = [
            'Task',
            'Status',
            'Assignee'
        ];
        $dataArray = [];
        $file = fopen('public/export/' . $fileName, 'w');
        fputcsv($file, $columnNames);

        if($data): 
            foreach($data as $key => $value):
                fputcsv($file, [
                     $value->title,
                     $value->status,
                     (isset($value->employee)) ? $value->employee->name : 'Not Assigned',
                ]);
            endforeach; 
        endif;      
       
        fclose($file);
        Mail::send('email.dailylog', [], function($message) use ($fileName)
        {
            $message->to('admin@otaskit.com')->subject('Daily Log CSV Email '.date('d/m/Y'));
            $message->attach('public/export/' . $fileName);
        });

    }
}
