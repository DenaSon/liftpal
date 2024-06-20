<?php

namespace App\Http\Controllers\Admin\Global;
use App\Http\Controllers\Controller;
use App\Models\Log;
use RealRashid\SweetAlert\Facades\Alert;



class LogController extends Controller
{
    public function index()
    {

        $logs = Log::query()
            ->when(request('type') === 'batchAlerts', function ($query) {
                return $query->where('action','ExpireDate_AlertSchedule')
                    ->orWhere('action','LowQuantity_Alert')
                ->orderbyDesc('created_at');
            })     ->orderbyDesc('created_at')
            ->paginate(getSetting('default_pagination_number'));

        return view('admin.log.index',compact('logs'));
    }

    public function saveLog( Log $logs )
    {
        $newLogs = Log::get();
        if (!empty($newLogs)) {
            $jsonData = json_encode($logs->get(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

            // Define the directory path
            $directoryPath = public_path('logs');

            // Create the directory if it doesn't exist
            if (!is_dir($directoryPath)) {
                mkdir($directoryPath, 0777, true);
            }

            // Define the file path within the directory
            $filePath = $directoryPath . '/logs.json';

            // Write the JSON data to the file
            file_put_contents($filePath, $jsonData,FILE_APPEND);
        }
        Alert::success("گزاراشات ذخیره شدند.");
        return redirect()->back()->with('link',1);
    }

    public function deleteLogs( Log $logs)
    {
        $newLogs = Log::get();
        if (!empty($newLogs)) {
            $jsonData = json_encode($logs->get(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

            // Define the directory path
            $directoryPath = public_path('logs');

            // Create the directory if it doesn't exist
            if (!is_dir($directoryPath)) {
                mkdir($directoryPath, 0777, true);
            }

            // Define the file path within the directory
            $filePath = $directoryPath . '/logs.json';

            // Write the JSON data to the file
            file_put_contents($filePath, $jsonData,FILE_APPEND);
            Log::truncate();

        }
        Alert::success('','تمام گزارشات حذف شدند');
        return redirect()->back();
    }







}
