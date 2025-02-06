<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MyQRCodeController extends Controller
{
    public function myqrcodelist(Request $request)
    {
        $userId = Auth::user()->id; 

        $folders = DB::table('qr_basic_info')
        ->selectRaw('folder_name as name, COUNT(*) AS count, DATE(created_At) AS date')
        ->where('userid', $userId)
        ->groupBy('folder_name', DB::raw('DATE(created_At)'))
        ->orderBy('created_At', 'asc')
        ->distinct()
        ->get();


        
        $folder = $request->folder;
        $codes = DB::table('qr_basic_info')
            ->where('folder_name', $folder)
            ->where('userid', $userId)
            ->pluck('project_code')
            ->toArray(); 

        $tables = [
            'urlcode', 'btcqr', 'apkqr', 'dynamicurlcode', 'emailqr', 'epcqr', 'eventqr',
            'facebookqr', 'imageqr', 'mp3qr', 'pdfqr', 'smsqr', 'textqr', 'twitterqr',
            'vcard', 'vcardplus', 'videoqr', 'wifiqr', 'couponqr', 'businessqr',
            'socmedqr', 'ratingqr'
        ];

        $combinedResults = [];

        foreach ($tables as $table) {
            $results = DB::table($table)
                ->select('id', 'url', 'code', 'qrtype', 'created_at AS date', 'userid')
                ->where('userid', $userId)
                ->whereIn('code', $codes)
                ->get()
                ->toArray();
            
            $combinedResults = array_merge($combinedResults, $results);
        }

        $qrCodes = [];

        foreach ($combinedResults as $item) {
            if (isset($item->code)) {
                $projectName = DB::table('qr_basic_info')
                    ->where('project_code', $item->code)
                    ->orderBy('created_at', 'ASC')
                    ->value('project_name');

                $item->projectname = $projectName ?? '';
                $qrCodes[] = (array) $item;
            }
        }

        $userid = Auth::user()->username;
        $tables = [
            'urlcode', 'btcqr', 'apkqr', 'dynamicurlcode', 'emailqr', 'epcqr', 'eventqr',
            'facebookqr', 'imageqr', 'mp3qr', 'pdfqr', 'smsqr', 'textqr', 'twitterqr',
            'vcard', 'vcardplus', 'videoqr', 'wifiqr', 'couponqr', 'businessqr',
            'socmedqr', 'ratingqr'
        ];

        $query = null;

        foreach ($tables as $table) {
            $subQuery = DB::table($table)
                ->select('id', 'url', 'code', 'qrtype', 'created_at as date', 'userid', 'editstatus');
            
            if ($query === null) {
                $query = $subQuery->where('userid', $userId);
            } else {
                $query->unionAll($subQuery->where('userid', $userId));
            }
        }

        $results = $query->get();

        $qrCodes = [];

        foreach ($results as $row) {
            if (!isset($row->code)) {
                continue;
            }

            $projectName = DB::table('qr_basic_info')
                ->where('project_code', $row->code)
                ->orderBy('id', 'ASC')
                ->value('project_name');

            unset($row->qrimage);
            
            $row->projectname = $projectName ?? '';

            $qrCodes[] = (array) $row;
        }


        return view('my-qr-code',compact('userId','folders','results'));
    }

    public function folders_list(){

        $userId = Auth::user()->username;
       
        $folders = DB::table('qr_basic_info')
            ->selectRaw('folder_name as name, COUNT(*) AS count, DATE(created_At) AS date')
            ->where('userid', $userId)
            ->groupBy('folder_name', DB::raw('DATE(created_At)'))
            ->orderBy('created_At', 'asc')
            ->distinct()
            ->get();

        return response()->json($folders);
    }
    public function folder_details(Request $request){
        $userid = Auth::user()->id; dd($userid);
        $folder = $request->folder;
        $codes = DB::table('qr_basic_info')
            ->where('folder_name', $folder)
            ->where('userid', $userid)
            ->pluck('project_code')
            ->toArray(); 

        $tables = [
            'urlcode', 'btcqr', 'apkqr', 'dynamicurlcode', 'emailqr', 'epcqr', 'eventqr',
            'facebookqr', 'imageqr', 'mp3qr', 'pdfqr', 'smsqr', 'textqr', 'twitterqr',
            'vcard', 'vcardplus', 'videoqr', 'wifiqr', 'couponqr', 'businessqr',
            'socmedqr', 'ratingqr'
        ];

        $combinedResults = [];

        foreach ($tables as $table) {
            $results = DB::table($table)
                ->select('id', 'url', 'code', 'qrtype', 'created_at AS date', 'userid')
                ->where('userid', $userid)
                ->whereIn('code', $codes)
                ->get()
                ->toArray();
            
            $combinedResults = array_merge($combinedResults, $results);
        }

        $qrCodes = [];

        foreach ($combinedResults as $item) {
            if (isset($item->code)) {
                $projectName = DB::table('qr_basic_info')
                    ->where('project_code', $item->code)
                    ->orderBy('created_at', 'ASC')
                    ->value('project_name');

                $item->projectname = $projectName ?? '';
                $qrCodes[] = (array) $item;
            }
        }

        return response()->json($qrCodes);
    }
    public function qrcode_list(){

        $userid = Auth::user()->username;
        $tables = [
            'urlcode', 'btcqr', 'apkqr', 'dynamicurlcode', 'emailqr', 'epcqr', 'eventqr',
            'facebookqr', 'imageqr', 'mp3qr', 'pdfqr', 'smsqr', 'textqr', 'twitterqr',
            'vcard', 'vcardplus', 'videoqr', 'wifiqr', 'couponqr', 'businessqr',
            'socmedqr', 'ratingqr'
        ];

        $query = null;

        foreach ($tables as $table) {
            $subQuery = DB::table($table)
                ->select('id', 'url', 'code', 'qrtype', 'created_at as date', 'userid', 'editstatus');
            
            if ($query === null) {
                $query = $subQuery->where('userid', $userid);
            } else {
                $query->unionAll($subQuery->where('userid', $userid));
            }
        }

        $results = $query->get();

        $qrCodes = [];

        foreach ($results as $row) {
            if (!isset($row->code)) {
                continue;
            }

            $projectName = DB::table('qr_basic_info')
                ->where('project_code', $row->code)
                ->orderBy('id', 'ASC')
                ->value('project_name');

            unset($row->qrimage);
            
            $row->projectname = $projectName ?? '';

            $qrCodes[] = (array) $row;
        }

        return response()->json($qrCodes);

    }
}
