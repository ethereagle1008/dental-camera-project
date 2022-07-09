<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\User;
use App\Models\UserAdvance;
use App\Models\UserShift;
use App\Models\WorkReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class WorkReportController extends Controller
{
    //
    public function workReportManage(){
        $sites = Site::where('status', 1)->get();
        return view('admin.WorkReportMaster.work-report-manager', compact('sites'));
    }

    public function vehicleManager(){
        $sites = Site::where('status', 1)->get();
        return view('admin.WorkReportMaster.vehicle-manager', compact('sites'));
    }
    public function workReportStatus(Request $request){
        $site_id = $request->site_id;
        $report_date = $request->report_date;
        $report_name = $request->report_name;
        if(isset(Auth::user()->contract_type)){
            UserShift::where('site_id', $site_id)->where('shift_date', date('Y-m-d', strtotime($report_date)))->update(['company_approval' => $report_name]);
        }
        else{
            UserShift::where('site_id', $site_id)->where('shift_date', date('Y-m-d', strtotime($report_date)))->update(['admin_approval' => $report_name]);
        }
        return response()->json(['status' => true]);
    }
    public function workReportTable(Request $request){
        $data = [];
        if(isset($request->site_name)){
            $report_date = $request->report_date;
            $site_name = $request->site_name;
            $data = UserShift::with('site')->with('user')->whereIn('id', function($query) use ($report_date) {
                $query->from('user_shifts')->where('shift_date', date('Y-m-d', strtotime($report_date)))->groupBy('site_id')->selectRaw('MAX(id)');
            })->whereHas('site', function ($query) use ($site_name) {$query->where('name', 'like' , '%' . $site_name . '%');})->get();
        }
        else{
            $report_date = $request->report_date;
            $data = UserShift::with('site')->with('user')->whereIn('id', function($query) use ($report_date) {
                $query->from('user_shifts')->where('shift_date', date('Y-m-d', strtotime($report_date)))->groupBy('site_id')->selectRaw('MAX(id)');
            })->get();
        }
        return view('admin.WorkReportMaster.work-report-table', compact('data'));
    }
    public function workReportDetailTable(Request $request){
        $site_id = $request->site_id;
        $report_date = $request->report_date;
        $data = UserShift::with('user')->where('site_id', $site_id)->where('shift_date', $report_date)->get();
        return view('admin.WorkReportMaster.work-report-detail-table', compact('data'));
    }
    public function workReportDetailEdit(Request $request){
        $report_id = $request->report_id;
        $work_report = WorkReport::where('id', $report_id)->update(['site_id' => $request->site_id, 'report' => $request->report_content]);
        return response()->json(['status' => true]);
    }

    public function workReportExportDown(Request $request){
        $report_date = $request->report_date;
        $shift_data = UserShift::where('shift_date', date('Y-m-d', strtotime($report_date)))->get()->toArray();
        $data = UserShift::with('site')->with('user')->whereIn('id', function($query) use ($report_date) {
            $query->from('user_shifts')->where('shift_date', date('Y-m-d', strtotime($report_date)))->groupBy('site_id')->selectRaw('MAX(id)');
        })->pluck('site_id')->toArray();

        $shift_data_site =  UserShift::with('site')->with('user')->whereIn('id', function($query) use ($report_date) {
            $query->from('user_shifts')->where('shift_date', date('Y-m-d', strtotime($report_date)))->groupBy('site_id')->selectRaw('MAX(id)');
        })->get();

        $site_data = Site::with('company')->whereIn('id', $data)->get();

        $data = UserShift::with('site')->with('user')->whereIn('id', function($query) use ($report_date) {
            $query->from('user_shifts')->where('shift_date', date('Y-m-d', strtotime($report_date)))->groupBy('user_id')->selectRaw('MAX(id)');
        })->pluck('user_id')->toArray();
        $user_data = User::whereIn('id', $data)->get();
        $cnt_team_leader = 0; $cnt_business = 0; $cnt_site = $site_data->count();

        $row_team_leader = 0; $row_business = 0;
        $row_after_table = 11;
        $team_leaders = [];
        $business = [];

        foreach ($user_data as $user){
            if($user->contract_type == 3){
                $cnt_team_leader++;
                $tmp = array();
                $tmp['id'] = $user->id;
                $tmp['name'] = $user->name;
                $start_time = date('Y-m-d', strtotime($report_date)) . '00:00:00';
                $end_time = date('Y-m-d', strtotime($report_date)) . '23:59:59';
                $user_advance = UserAdvance::where('user_id', $user->id)->where('status', 1)->where('updated_at', '>=', $start_time)->where('updated_at', '<', $end_time)->get()->first();
                $tmp['pay'] = 0;

                if(isset($user_advance)){
                    $tmp['pay'] = $user_advance->payment;
                }

                array_push($team_leaders, $tmp);
            }
            if($user->deal_type == 2){
                $cnt_business++;
                $tmp = array();
                $tmp['id'] = $user->id;
                $tmp['name'] = $user->name;
                $tmp['pay'] = 0;
                array_push($business, $tmp);
            }
        }

        if($cnt_team_leader == 0){
            $row_team_leader = 2;
            $cnt_team_leader = 1;
        }
        else{
            $row_team_leader = 2 * $cnt_team_leader;
        }

        if($cnt_business == 0){
            $row_business = 2;
            $cnt_business = 1;
        }
        else{
            $row_business = 2 * $cnt_business;
        }

        $row_after_table = $row_after_table + $row_team_leader + $row_business;

        $style_border_outline_thin = [
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];
        $style_title = [
            'font' => [
                'color' => ['rgb' => '000000'],
                'size' => 11
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ];

        $style_border_table1 = [
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                    'color' => ['rgb' => '000000'],
                ],
                'vertical' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
                'horizontal' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->getColumnDimension('A')->setWidth(15);
        $sheet->getColumnDimension('B')->setWidth(5);
        $sheet->getColumnDimension('C')->setWidth(12);
        $sheet->getColumnDimension('D')->setWidth(5);
        $sheet->getColumnDimension('E')->setWidth(12);
        $sheet->getColumnDimension('F')->setWidth(12);
        $sheet->getColumnDimension('G')->setWidth(15);
        for($i = 0; $i <= $cnt_site; $i++){
            $sheet->getColumnDimensionByColumn(8 + $i)->setWidth(12);
        }
        try{
            $sheet->mergeCells('B3:D3');
            $sheet->getStyle('B3')->applyFromArray($style_title);
            $sheet->getCell('B3')->setValue('業務日報報告書');
            $sheet->getStyleByColumnAndRow(8 + $cnt_site, 3)->applyFromArray($style_title);
            $sheet->getCellByColumnAndRow(8 + $cnt_site, 3)->setValue(date('Y.m.d', strtotime($report_date)));
            $sheet->mergeCells('B5:G5');
            $sheet->getStyle('B5')->applyFromArray($style_title);
            $sheet->getCell('B5')->setValue('発注者名');
            $sheet->mergeCells('B6:G6');
            $sheet->getStyle('B6')->applyFromArray($style_title);
            $sheet->getCell('B6')->setValue('配属現場名');
            $sheet->mergeCells('B7:G7');
            $sheet->getStyle('B7')->applyFromArray($style_title);
            $sheet->getCell('B7')->setValue('昼間と夜間の区別');
            $sheet->mergeCells('C8:F9');
            $sheet->getStyle('C8')->applyFromArray($style_title);
            $sheet->getCell('C8')->setValue('労務費出面（人数）');

            $sheet->mergeCellsByColumnAndRow(8 + $cnt_site, 5, 8 + $cnt_site, 6);
            $sheet->getStyleByColumnAndRow(8 + $cnt_site, 5, 8 + $cnt_site, 6)->applyFromArray($style_title);
            $sheet->getCellByColumnAndRow(8 + $cnt_site, 5)->setValue('前払い');
            $column_1 = 10 + $row_business + $row_team_leader - 1;
            $sheet->mergeCells('B8:B' . $column_1);
            $sheet->getStyle('B8')->applyFromArray($style_title);
            $sheet->getCell('B8')->setValue('労務者出勤');

            $sheet->getStyle('G8')->applyFromArray($style_title);
            $sheet->getCell('G8')->setValue('社員');

            $sheet->getStyle('G9')->applyFromArray($style_title);
            $sheet->getCell('G9')->setValue('業務委託');

            $column_2 = 10 + $row_team_leader - 1;
            $sheet->mergeCells('C10:C' . $column_2);
            $sheet->getStyle('C10')->applyFromArray($style_title);
            $sheet->getCell('C10')->setValue('班長');
            $sheet->mergeCells('C' . ($column_2 + 1) . ':C' . $column_1);
            $sheet->getStyle('C' . ($column_2 + 1))->applyFromArray($style_title);
            $sheet->getCell('C' . ($column_2 + 1))->setValue('業務委託');

            for($i = 0; $i < $cnt_team_leader; $i++){
                $sheet->mergeCells('D' . (10 + 2 * $i) . ':E' . (11 + 2 * $i));
                $sheet->getStyle('D' . (10 + 2 * $i))->applyFromArray($style_title);
                $sheet->getCell('D' . (10 + 2 * $i))->setValue($i+1);
                $sheet->mergeCells('F' . (10 + 2 * $i) . ':F' . (11 + 2 * $i));
                $sheet->mergeCellsByColumnAndRow(8 + $cnt_site, 10 + 2 * $i, 8 + $cnt_site, 11 + 2 * $i);
                if(count($team_leaders) > 0){
                    for($j = 0; $j < $cnt_site; $j++){
                        $user_shift = UserShift::where('user_id', $team_leaders[$i]['id'])->where('site_id', $site_data[$j]->id)
                        ->where('shift_date', date('Y-m-d', strtotime($report_date)))->first();
                        if(isset($user_shift)){
                            $sheet->getStyleByColumnAndRow(8 + $j, 10 + 2 * $i)->applyFromArray($style_title);
                            $sheet->getCellByColumnAndRow(8 + $j, 10 + 2 * $i)->setValue('○');
                            $sheet->getStyleByColumnAndRow(8 + $j, 11 + 2 * $i)->applyFromArray($style_title);
                            $sheet->getCellByColumnAndRow(8 + $j, 11 + 2 * $i)->setValue($user_shift->over_time);
                        }
                    }
                    $sheet->getStyle('F' . (10 + 2 * $i))->applyFromArray($style_title);
                    $sheet->getCell('F' . (10 + 2 * $i))->setValue($team_leaders[$i]['name']);
                    $sheet->getStyleByColumnAndRow(8 + $cnt_site, 10 + 2 * $i)->applyFromArray($style_title);
                    $sheet->getCellByColumnAndRow(8 + $cnt_site, 10 + 2 * $i)->setValue($team_leaders[$i]['pay']);
                }
                $sheet->getStyle('G' . (10 + 2 * $i))->applyFromArray($style_title);
                $sheet->getCell('G' . (10 + 2 * $i))->setValue('出勤');
                $sheet->getStyle('G' . (11 + 2 * $i))->applyFromArray($style_title);
                $sheet->getCell('G' . (11 + 2 * $i))->setValue('認定残業時間');
            }
            for($i = 0; $i < $cnt_business; $i++){
                $sheet->mergeCells('D' . (10 + $row_team_leader + 2 * $i) . ':E' . (11 + $row_team_leader + 2 * $i));
                $sheet->getStyle('D' . (10 + $row_team_leader + 2 * $i))->applyFromArray($style_title);
                $sheet->getCell('D' . (10 + $row_team_leader + 2 * $i))->setValue($i+1);
                $sheet->mergeCells('F' . (10 + $row_team_leader + 2 * $i) . ':F' . (11 + $row_team_leader + 2 * $i));
                $sheet->mergeCellsByColumnAndRow(8 + $cnt_site, 10 + $row_team_leader + 2 * $i, 8 + $cnt_site, 11 + $row_team_leader + 2 * $i);
                if(count($business) > 0){
                    for($j = 0; $j < $cnt_site; $j++){
                        $user_shift = UserShift::where('user_id', $business[$i]['id'])->where('site_id', $site_data[$j]->id)
                        ->where('shift_date', date('Y-m-d', strtotime($report_date)))->first();
                        if(isset($user_shift)){
                            $sheet->getStyleByColumnAndRow(8 + $j, 10 + $row_team_leader + 2 * $i)->applyFromArray($style_title);
                            $sheet->getCellByColumnAndRow(8 + $j, 10 + $row_team_leader + 2 * $i)->setValue('○');
                            $sheet->getStyleByColumnAndRow(8 + $j, 11 + $row_team_leader + 2 * $i)->applyFromArray($style_title);
                            $sheet->getCellByColumnAndRow(8 + $j, 11 + $row_team_leader + 2 * $i)->setValue($user_shift->over_time);
                        }
                    }
                    $sheet->getStyle('F' . (10 + $row_team_leader + 2 * $i))->applyFromArray($style_title);
                    $sheet->getCell('F' . (10 + $row_team_leader + 2 * $i))->setValue($business[$i]['name']);
                    $sheet->getStyleByColumnAndRow(8 + $cnt_site, 10 + $row_team_leader + 2 * $i)->applyFromArray($style_title);
                    $sheet->getCellByColumnAndRow(8 + $cnt_site, 10 + $row_team_leader + 2 * $i)->setValue($business[$i]['pay']);
                }

                $sheet->getStyle('G' . (10 + $row_team_leader + 2 * $i))->applyFromArray($style_title);
                $sheet->getCell('G' . (10 + $row_team_leader + 2 * $i))->setValue('出勤');
                $sheet->getStyle('G' . (11 + $row_team_leader + 2 * $i))->applyFromArray($style_title);
                $sheet->getCell('G' . (11 + $row_team_leader + 2 * $i))->setValue('認定残業時間');
            }

            $sheet->mergeCells('B' . $row_after_table . ':B' . ($row_after_table + 5));
            $sheet->getStyle('B' . $row_after_table)->applyFromArray($style_title);
            $sheet->getCell('B' . $row_after_table)->setValue('承認');

            $sheet->mergeCells('C' . $row_after_table . ':G' . ($row_after_table + 2));
            $sheet->getStyle('C' . $row_after_table)->applyFromArray($style_title);
            $sheet->getCell('C' . $row_after_table)->setValue('発注者承認印');

            $sheet->mergeCells('C' . ($row_after_table + 3) . ':G' . ($row_after_table + 5));
            $sheet->getStyle('C' . ($row_after_table + 3))->applyFromArray($style_title);
            $sheet->getCell('C' . ($row_after_table + 3))->setValue('五大企画承認印');

            $sheet->getStyle('B' . $row_after_table . ':B' . ($row_after_table + 5))->applyFromArray($style_border_outline_thin);
            $sheet->getStyle('C' . $row_after_table . ':G' . ($row_after_table + 2))->applyFromArray($style_border_outline_thin);
            $sheet->getStyle('C' . ($row_after_table + 3) . ':G' . ($row_after_table + 5))->applyFromArray($style_border_outline_thin);

            for($i = 0; $i < $cnt_site; $i++){
                $sheet->mergeCellsByColumnAndRow(8 + $i, $row_after_table, 8 + $i, $row_after_table + 2);
                $sheet->mergeCellsByColumnAndRow(8 + $i, $row_after_table + 3, 8 + $i, $row_after_table + 5);
                $sheet->getStyleByColumnAndRow(8 + $i, $row_after_table, 8 + $i, $row_after_table + 2)->applyFromArray($style_border_outline_thin);
                $sheet->getStyleByColumnAndRow(8 + $i, $row_after_table + 3, 8 + $i, $row_after_table + 5)->applyFromArray($style_border_outline_thin);

                $sheet->getStyleByColumnAndRow(8 + $i, 5)->applyFromArray($style_title);
                $sheet->getStyleByColumnAndRow(8 + $i, 6)->applyFromArray($style_title);
                $sheet->getStyleByColumnAndRow(8 + $i, $row_after_table)->applyFromArray($style_title);
                $sheet->getStyleByColumnAndRow(8 + $i, $row_after_table + 3)->applyFromArray($style_title);
                $sheet->getCellByColumnAndRow(8 + $i, 5)->setValue($site_data[$i]->company->name);
                $sheet->getCellByColumnAndRow(8 + $i, 6)->setValue($site_data[$i]->name);

                $deal_1 = UserShift::with('user')->where('site_id', $site_data[$i]->id)->where('shift_date', date('Y-m-d', strtotime($report_date)))
                ->whereHas('user', function ($query) {$query->where('deal_type', 1);})->get()->count();
                $deal_2 = UserShift::with('user')->where('site_id', $site_data[$i]->id)->where('shift_date', date('Y-m-d', strtotime($report_date)))
                ->whereHas('user', function ($query) {$query->where('deal_type', 2);})->get()->count();
                $sheet->getStyleByColumnAndRow(8 + $i, 8)->applyFromArray($style_title);
                $sheet->getStyleByColumnAndRow(8 + $i, 9)->applyFromArray($style_title);
                $sheet->getCellByColumnAndRow(8 + $i, 8)->setValue($deal_1);
                $sheet->getCellByColumnAndRow(8 + $i, 9)->setValue($deal_2);

                $type = '昼間';
                $shift_type = UserShift::where('site_id', $site_data[$i]->id)->where('shift_date', date('Y-m-d', strtotime($report_date)))
                ->where('over', '!=', 1)->get()->first();
                if(isset($shift_type)){
                    $type = '夜間';
                }

                $sheet->getStyleByColumnAndRow(8 + $i, 7)->applyFromArray($style_title);
                $sheet->getCellByColumnAndRow(8 + $i, 7)->setValue($type);

                foreach($shift_data_site as $shift_data){
                    if($site_data[$i]->id == $shift_data->site_id){
                        $sheet->getCellByColumnAndRow(8 + $i, $row_after_table)->setValue($shift_data->admin_approval);
                        $sheet->getCellByColumnAndRow(8 + $i, $row_after_table + 3)->setValue($shift_data->company_approval);
                    }
                }
            }

            $sheet->getStyleByColumnAndRow(8 + $cnt_site, 5, 8 + $cnt_site, 6)->applyFromArray($style_border_outline_thin);
            $sheet->getStyle('C' . ($column_2 + 1) . ':C' . $column_1)->applyFromArray($style_border_outline_thin);
            $sheet->getStyleByColumnAndRow(2, 5, 8 + $cnt_site, $row_after_table - 2)->applyFromArray($style_border_table1);
        }
        catch (\PhpOffice\PhpSpreadsheet\Exception $e) {
            Log::error('Exception:' . $e);
        }

        header("Content-Type:   application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Content-Disposition: attachment; filename=作業日報承認書.xls");  //File name extension was wrong
        $writer = IOFactory::createWriter($spreadsheet, 'Xls');
        $writer->save('php://output');
    }

    public function workReportDownList(Request $request){
        $range = $request->report_date;
        $dateArr = explode('to', $range);
        $start_time = date('Y-m-d', strtotime($dateArr[0]));
        $end_time = date('Y-m-d', strtotime($dateArr[1]));
        $timeDiff = abs(strtotime($dateArr[1]) - strtotime($dateArr[0]));

        $numberDays = $timeDiff/86400;  // 86400 seconds in one day

        // and you might want to convert to integer
        $numberDays = intval($numberDays);
        $shift_data_site = UserShift::with('user')->with('site')->whereIn('id', function($query) use ($start_time, $end_time) {
            $query->from('user_shifts')->where('shift_date', '>=', $start_time)->where('shift_date', '<', $end_time)->groupBy('site_id')->selectRaw('MAX(id)');
        })->get();

        $data = UserShift::with('user')->with('site')->whereIn('id', function($query) use ($start_time, $end_time) {
            $query->from('user_shifts')->where('shift_date', '>=', $start_time)->where('shift_date', '<', $end_time)->groupBy('site_id')->selectRaw('MAX(id)');
        })->pluck('site_id')->toArray();

        $site_data = Site::with('company')->whereIn('id', $data)->get();
        $cnt_site = $site_data->count();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $style_border_outline_double = [
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                    'color' => ['rgb' => '000000'],
                ],
                'vertical' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                    'color' => ['rgb' => '000000'],
                ],
                'horizontal' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];


        $style_border_outline_double2 = [
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                    'color' => ['rgb' => '000000'],
                ],
                'vertical' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
                'horizontal' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];

        $style_item_left = [
            'font' => [
                'color' => ['rgb' => '000000'],
                'size' => 20
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ];
        $style_title = [
            'font' => [
                'color' => ['rgb' => '000000'],
                'size' => 11
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ];

        $sheet->getColumnDimension('D')->setWidth(10);
        $sheet->getColumnDimension('E')->setWidth(10);
        $sheet->getColumnDimension('F')->setWidth(10);
        $sheet->getColumnDimension('G')->setWidth(10);
        $sheet->getColumnDimension('H')->setWidth(20);
        $sheet->getRowDimension(11)->setRowHeight(5);

        try{
            $sheet->mergeCells('D9:H10');
            $sheet->mergeCells('D12:G13');
            for($i = 0; $i < $numberDays; $i++){
                $sheet->mergeCells('D' . (14 + 2 * $i) . ':D' . (15 + 2 * $i));
                $sheet->getCell('D' . (14 + 2 * $i))->setValue(date('m', strtotime('+' . $i . 'days', strtotime($dateArr[0]))));
                $sheet->mergeCells('E' . (14 + 2 * $i) . ':E' . (15 + 2 * $i));
                $sheet->getCell('E' . (14 + 2 * $i))->setValue('月');
                $sheet->mergeCells('F' . (14 + 2 * $i) . ':F' . (15 + 2 * $i));
                $sheet->getCell('F' . (14 + 2 * $i))->setValue(date('d', strtotime('+' . $i . 'days', strtotime($dateArr[0]))));
                $sheet->mergeCells('G' . (14 + 2 * $i) . ':G' . (15 + 2 * $i));
                $sheet->getCell('G' . (14 + 2 * $i))->setValue('日');

                $sheet->getStyle('H' . (14 + 2 * $i) . ':H' . (15 + 2 * $i))->applyFromArray($style_border_outline_double);
                $sheet->getStyle('H' . (14 + 2 * $i) . ':H' . (15 + 2 * $i))->applyFromArray($style_title);
                $sheet->getCell('H' . (14 + 2 * $i))->setValue('発注者承認印');
                $sheet->getCell('H' . (15 + 2 * $i))->setValue('山大承認印');

                $sheet->getStyleByColumnAndRow(9, 14 + 2 * $i, 8 + $cnt_site, 15 + 2 * $i)->applyFromArray($style_border_outline_double);
                $sheet->getStyleByColumnAndRow(9, 14 + 2 * $i, 8 + $cnt_site, 15 + 2 * $i)->applyFromArray($style_title);

                for($j = 0; $j < $cnt_site; $j++){
                    $user_shift = UserShift::where('site_id', $site_data[$j]->id)
                    ->where('shift_date', date('Y-m-d', strtotime('+' . $i . 'days', strtotime($dateArr[0]))))->get()->first();
                    if(isset($user_shift)){
                        $sheet->getCellByColumnAndRow(9 + $j, 14 + 2 * $i)->setValue($user_shift->company_approval);
                        $sheet->getCellByColumnAndRow(9 + $j, 15 + 2 * $i)->setValue($user_shift->admin_approval);
                    }
                }
            }

            for($i = 0; $i < $cnt_site; $i++){
                $sheet->getStyleByColumnAndRow(9 + $i, 12, 8 + $cnt_site, 13)->applyFromArray($style_border_outline_double);
                $sheet->getStyleByColumnAndRow(9 + $i, 12, 8 + $cnt_site, 13)->applyFromArray($style_title);
                $sheet->getCellByColumnAndRow(9 + $i, 12)->setValue($site_data[$i]->site_code);
                $sheet->getCellByColumnAndRow(9 + $i, 13)->setValue($site_data[$i]->name);
            }

            $sheet->getStyle('D9')->applyFromArray($style_item_left);
            $sheet->getCell('D9')->setValue('承認一覧表');

            $sheet->getStyle('D12:G13')->applyFromArray($style_border_outline_double);
            $sheet->getStyle('D12')->applyFromArray($style_title);
            $sheet->getCell('D12')->setValue('現場情報');

            $sheet->getStyle('D14:G' . (15 + 2 * ($numberDays - 1)))->applyFromArray($style_border_outline_double2);
            $sheet->getStyle('D14:G' . (15 + 2 * ($numberDays - 1)))->applyFromArray($style_title);

            $sheet->getStyle('H12:H13')->applyFromArray($style_border_outline_double);
            $sheet->getStyle('H12:H13')->applyFromArray($style_title);
            $sheet->getCell('H12')->setValue('ID');
            $sheet->getCell('H13')->setValue('現場名');
        }
        catch (\PhpOffice\PhpSpreadsheet\Exception $e) {
            Log::error('Exception:' . $e);
        }

        header("Content-Type:   application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Content-Disposition: attachment; filename=作業日報承認書.xls");  //File name extension was wrong
        $writer = IOFactory::createWriter($spreadsheet, 'Xls');
        $writer->save('php://output');
    }
    public function workReportExportExcel($id){
        $work_report = WorkReport::with('site')->with('user')->find($id);
        $data = UserShift::with('user')->where('site_id', $work_report->site_id)->where('shift_date', $work_report->report_date)->get();
        $count = $data->count();
        $row_after_table1_end = $count + 14;
        $row_after_table2_before = $count + 16;
        $row_after_table1 = $count + 17;
        $row_after_table2 = $count + 22;
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $style_border_outline_double = [
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];
        $style_border_vertical_double = [
            'borders' => [
                'vertical' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];
        $style_border_table1 = [
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                    'color' => ['rgb' => '000000'],
                ],
                'vertical' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
                'horizontal' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];
        $style_border_bottom_thin = [
            'borders' => [
                'bottom' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];
        $style_title = [
            'font' => [
                'color' => ['rgb' => '000000'],
                'size' => 16
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ];
        $style_red_item = [
            'font' => [
                'color' => ['rgb' => 'FF0000'],
                'size' => 16
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ];
        $style_item = [
            'font' => [
                'color' => ['rgb' => '000000'],
                'size' => 10
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ];
        $style_item_left = [
            'font' => [
                'color' => ['rgb' => '000000'],
                'size' => 10
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ];
        $style_item_right = [
            'font' => [
                'color' => ['rgb' => '000000'],
                'size' => 10
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ];
        $style_item_detail = [
            'font' => [
                'color' => ['rgb' => '000000'],
                'size' => 10
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
            ],
        ];
        $style_fill_background = [
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => 'FFF2CC'
                ]
            ],
        ];

        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(12);
        $sheet->getColumnDimension('C')->setWidth(20);
        $sheet->getColumnDimension('D')->setWidth(12);
        $sheet->getColumnDimension('E')->setWidth(12);
        $sheet->getColumnDimension('F')->setWidth(30);
        $sheet->getColumnDimension('G')->setWidth(12);
        $sheet->getColumnDimension('H')->setWidth(30);
        $sheet->getColumnDimension('I')->setWidth(15);

        try{
            $sheet->mergeCells('B1:I1');
            $sheet->mergeCells('H6:H9');
            $sheet->mergeCells('I6:I9');
            $sheet->mergeCells('H11:I11');
            $sheet->mergeCells('B12:B13');
            $sheet->mergeCells('C12:C13');
            $sheet->mergeCells('D12:D13');
            $sheet->mergeCells('E12:F12');
            $sheet->mergeCells('G12:H12');
            $sheet->mergeCells('I12:I13');
            $sheet->mergeCells('B'.$row_after_table1.':I'.$row_after_table2);
        }
        catch (\PhpOffice\PhpSpreadsheet\Exception $e) {
        }

        try{
            $sheet->getStyle('B1')->applyFromArray($style_title);
            $sheet->getStyle('B3:B5')->applyFromArray($style_item);
            $sheet->getStyle('C3:C5')->applyFromArray($style_item_left);
            $sheet->getStyle('H3:H4')->applyFromArray($style_item_left);
            $sheet->getStyle('B7:B8')->applyFromArray($style_item);
            $sheet->getStyle('B11')->applyFromArray($style_item_left);
            $sheet->getStyle('H11')->applyFromArray($style_item);
            $sheet->getStyle('H5:I5')->applyFromArray($style_item);
            $sheet->getStyle('H5:I5')->applyFromArray($style_border_bottom_thin);
            $sheet->getStyle('H5:I9')->applyFromArray($style_border_outline_double);
            $sheet->getStyle('H5:I9')->applyFromArray($style_border_vertical_double);
            $sheet->getStyle('H6')->applyFromArray($style_item);
            $sheet->getStyle('I6')->applyFromArray($style_red_item);
            $sheet->getStyle('B12'.':I'.$row_after_table1_end)->applyFromArray($style_border_table1);
            $sheet->getStyle('C12'.':I13')->applyFromArray($style_item);
            $sheet->getStyle('E12'.':H'.$row_after_table1_end)->applyFromArray($style_fill_background);
            $sheet->getStyle('B' . $row_after_table2_before)->applyFromArray($style_item_left);
            $sheet->getStyle('B'.$row_after_table1.':I'.$row_after_table2)->applyFromArray($style_border_outline_double);
            $sheet->getStyle('B'.$row_after_table1)->applyFromArray($style_item_detail);
        }
        catch (\PhpOffice\PhpSpreadsheet\Exception $e) {
        }

        try{
            $sheet->getCell('B1')->setValue('作　業　日　報　承　認　書');
            $sheet->getCell('B3')->setValue('会社名');
            $sheet->getCell('C3')->setValue($work_report->site->company->name);
            $sheet->getCell('B4')->setValue('現場ID');
            $sheet->getCell('C4')->setValue($work_report->site->site_code);
            $sheet->getCell('B5')->setValue('現場名');
            $sheet->getCell('C5')->setValue($work_report->site->name);
            $sheet->getCell('H3')->setValue('株式会社山大企画');
            $sheet->getCell('H4')->setValue(date('Y年m月d日') . '(' . dayWeek(date('w')) . ')');
            $sheet->getCell('B7')->setValue('所属営業所');
            $sheet->getCell('B8')->setValue('所属班名');
            $sheet->getCell('C7')->setValue($work_report->user->office->name);
            $sheet->getCell('C8')->setValue($work_report->user->team->name);
            $sheet->getCell('B11')->setValue('作業時間報告');
            $sheet->getCell('H11')->setValue(date('Y年m月d日付分', strtotime($work_report->report_date)));
            $sheet->getCell('H5')->setValue('承認者');
            $sheet->getCell('I5')->setValue('山大企画');
            $sheet->getCell('C12')->setValue('氏名');
            $sheet->getCell('D12')->setValue('職責');
            $sheet->getCell('E12')->setValue('開始時間');
            $sheet->getCell('E13')->setValue('時間');
            $sheet->getCell('F13')->setValue('場所');
            $sheet->getCell('G12')->setValue('終了時間');
            $sheet->getCell('G13')->setValue('時間');
            $sheet->getCell('H13')->setValue('場所');
            $sheet->getCell('I12')->setValue('認定残業時間');
            foreach ($data as $index => $item){
                $row = 14 + $index;
                $sheet->getStyle('B'.$row)->applyFromArray($style_item);
                $sheet->getCell('B'.$row)->setValue($index+1);
                $sheet->getStyle('C'.$row)->applyFromArray($style_item);
                $sheet->getCell('C'.$row)->setValue($item->user->name);
                $sheet->getStyle('D'.$row)->applyFromArray($style_item);
                $sheet->getCell('D'.$row)->setValue(contractType($item->user->contract_type));
                $sheet->getStyle('E'.$row)->applyFromArray($style_item_right);
                $sheet->getCell('E'.$row)->setValue(date('H:i', strtotime($item->start_time)));
                $sheet->getCell('F'.$row)->setValue($item->start_place);
                $sheet->getStyle('G'.$row)->applyFromArray($style_item_right);
                $sheet->getCell('G'.$row)->setValue(date('H:i', strtotime($item->end_time)));
                $sheet->getCell('H'.$row)->setValue($item->end_place);
                $sheet->getStyle('I'.$row)->applyFromArray($style_item);
                $sheet->getCell('I'.$row)->setValue((int)$item->over_time . '分');
            }


            $sheet->getCell('B'.$row_after_table2_before)->setValue('作業内容報告');
            $sheet->getCell('B'.$row_after_table1)->setValue($work_report->report);
        }
        catch (\PhpOffice\PhpSpreadsheet\Exception $e) {
        }

        header("Content-Type:   application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Content-Disposition: attachment; filename=作業日報承認書.xls");  //File name extension was wrong
        $writer = IOFactory::createWriter($spreadsheet, 'Xls');
        $writer->save('php://output');
    }

    public function workShiftManage(){
        $sites = Site::where('status', 1)->get();
        return view('admin.WorkReportMaster.work-shift-manager', compact('sites'));
    }
    public function workShiftTable(Request $request){
        $site_name = $request->site_name;
        if(isset($site_name)){
            if(isset($request->report_date)){
                $data = UserShift::with('site')->with('user')->whereHas('site', function ($query) use ($site_name){
                    $query->where('name', 'like' , '%' . $site_name . '%');
                })->where('shift_date', date('Y-m-d', strtotime($request->report_date)))->get();
            }
            else{
                $data = UserShift::with('site')->with('user')->whereHas('site', function ($query) use ($site_name){
                    $query->where('name', 'like' , '%' . $site_name . '%');
                })->get();
            }
        }
        else{
            if(isset($request->report_date)){
                $data = UserShift::with('site')->with('user')->where('shift_date', date('Y-m-d', strtotime($request->report_date)))->get();
            }
            else{
                $data = UserShift::with('site')->with('user')->get();
            }
        }
        return view('admin.WorkReportMaster.work-shift-table', compact('data'));
    }

    public function workShiftChange(Request $request){
        $shift_id = $request->shift_id;
        $over = $request->over;
        $over_time = $request->over_time;
        $shift = UserShift::find($shift_id);
        UserShift::where('id', $shift_id)->update(['over' => $over, 'over_time' => $over_time,
            'start_time' => date('Y-m-d H:i:s', strtotime($shift->shift_date . ' '. $request->start_time)),
            'end_time' => date('Y-m-d H:i:s', strtotime($shift->shift_date . ' '. $request->end_time))]);
        return response()->json(['status' => true]);
    }

    public function workShiftTotal(){
        return view('admin.WorkReportMaster.work-shift-total');
    }
    public function workShiftTotalTable(Request $request){
        $range = $request->range;
        $data = [];
        if(isset($request->range)){
            $dateArr = explode('to', $range);
            $start_time = date('Y-m-d', strtotime($dateArr[0]));
            $end_time = date('Y-m-d', strtotime($dateArr[1]));
            $users = User::where('role', 'user')->get();
            foreach($users as $user){
                $tmp = array();
                $tmp['id'] = $user->id;
                $tmp['name'] = $user->name;
                $tmp['phone'] = $user->phone;
                $cnt_shift_normal = UserShift::where('user_id', $user->id)->where('over', 1)->where('shift_date', '>=', $start_time)->where('shift_date', '<', $end_time)->get()->count();
                $cnt_shift_night = UserShift::where('user_id', $user->id)->where('over', 2)->where('shift_date', '>=', $start_time)->where('shift_date', '<', $end_time)->get()->count();
                $shifts_over = UserShift::where('user_id', $user->id)->where('over_time', '!=', 0)->where('shift_date', '>=', $start_time)->where('shift_date', '<', $end_time)->get();
                $tmp['price_normal'] = $user->contract_value*$cnt_shift_normal;
                $tmp['price_night'] = calculatePriceByRole($cnt_shift_night, $user->contract_type, 2);
                $cnt_shift_total = UserShift::where('user_id', $user->id)->where('shift_date', '>=', $start_time)->where('shift_date', '<', $end_time)->get()->count();
                $price_over = 0;
                foreach ($shifts_over as $shift){
                    $price_over = $price_over + calculatePriceByRole($shift->over_time, $user->contract_type, 3);
                }
                $tmp['price_over'] = $price_over;
                $tmp['sub_staff'] = 0;
                $tmp['sub_price'] = 0;
                $tmp['direct_staff'] = 0;
                $tmp['direct_price'] = 0;
                if($user->contract_type == 4){
                    $team_id = $user->team_id;
                    $team_staffs = User::where('team_id', $team_id)->get();
                    foreach ($team_staffs as $staff){
                        if($staff->id != $user->id){
                            $cnt_shift_staff = UserShift::where('user_id', $staff->id)->get()->count();
                            if($cnt_shift_staff >= 20){
                                $tmp['sub_staff'] = $tmp['sub_staff'] + 1;
                            }
                        }
                    }
                    if($tmp['sub_staff'] > 3){
                        $tmp['sub_price'] = $tmp['sub_staff'] * 7000;
                    }
                    else{
                        $tmp['sub_staff'] = 0;
                    }
                    $direct_staffs = User::where('director_id', $user->id)->get();
                    foreach ($direct_staffs as $staff){
                        $cnt_shift_staff = UserShift::where('user_id', $staff->id)->get()->count();
                        if($cnt_shift_staff >= 20){
                            $tmp['direct_staff'] = $tmp['direct_staff'] + 1;
                        }
                    }
                    if($tmp['direct_staff'] > 3){
                        $tmp['direct_price'] = $tmp['direct_staff'] * 3000;
                    }
                    else{
                        $tmp['direct_staff'] = 0;
                    }
                }
                $tmp['a_price'] = $tmp['price_normal'] + $tmp['price_night'] + $tmp['sub_price'] + $tmp['direct_price'] + $price_over;

                $tmp['insurance'] = 0;
                if($user->insurance == 1){
                    $tmp['insurance'] = calculatePriceByType(1, 'insurance');
                }
                $tmp['self_insurance'] = $user->safe_cost * $cnt_shift_total;
                $tmp['safe_cost'] = $user->safe_cost * $cnt_shift_total;
                $tmp['cloth'] = 0;
                if($user->cloth == 1){
                    $tmp['cloth'] = calculatePriceByType($cnt_shift_total, 'cloth');
                }
                $tmp['helmet'] = calculatePriceByType($cnt_shift_total, 'helmet');
                $tmp['dormitory'] = 0;
                if($user->dormitory == 1){
                    $tmp['dormitory'] = calculatePriceByType($cnt_shift_total, 'dormitory');
                }
                $tmp['business_phone'] = 0;
                if($user->business_phone == 1){
                    $tmp['business_phone'] = calculatePriceByType($cnt_shift_total, 'phone');
                }

                $tmp['pre_pay'] = 0;
                $history = UserAdvance::where('user_id', $user->id)->where('status', 1)->where('updated_at', '>=', $start_time)->where('updated_at', '<', $end_time)->get();
                foreach ($history as $item){
                    $tmp['pre_pay'] = $tmp['pre_pay'] + $item->payment;
                }

                $tmp['pring'] = 0;
                if($user->receive_type == 1){
                    $tmp['pring'] = 55;
                }
                $tmp['b_price'] = $tmp['insurance'] + $tmp['self_insurance'] + $tmp['safe_cost'] + $tmp['cloth'] + $tmp['helmet'] + $tmp['dormitory'] + $tmp['business_phone'] + $tmp['pre_pay'] + $tmp['pring'];
                array_push($data, $tmp);
            }
        }
        return view('admin.WorkReportMaster.work-shift-total-table', compact('data'));
    }
    public function workShiftPerson(Request $request){
        $range = $request->range;
        $dateArr = explode('to', $range);
        $start_time = date('Y-m-d', strtotime($dateArr[0]));
        $end_time = date('Y-m-d', strtotime($dateArr[1]));
        $user = User::find($request->user_id);
        $tmp = array();
        $tmp['id'] = $user->id;
        $tmp['name'] = $user->name;
        $tmp['phone'] = $user->phone;
        $tmp['contract_type'] = $user->contract_type;
        $tmp['month'] = $range;
        $total_shift = UserShift::with('site')->where('user_id', $user->id)->where('shift_date', '>=', $start_time)->where('shift_date', '<', $end_time)->get();
        $tmp['shifts'] = $total_shift;
        $tmp['shift_total'] = $total_shift->count();
        $shifts_over = UserShift::where('user_id', $user->id)->where('over_time', '!=', 0)->where('shift_date', '>=', $start_time)->where('shift_date', '<', $end_time)->get();
        $price_over = 0;
        $over_time = 0;
        foreach ($shifts_over as $shift){
            $over_time = $over_time + $shift->over_time;
            $price_over = $price_over + calculatePriceByRole($shift->over_time, $user->contract_type, 3);
        }
        $tmp['price_over'] = $price_over;
        $tmp['over_time'] = $over_time;

        $cnt_shift_normal = UserShift::where('user_id', $user->id)->where('over', 1)->where('shift_date', '>=', $start_time)->where('shift_date', '<', $end_time)->get()->count();
        $cnt_shift_night = UserShift::where('user_id', $user->id)->where('over', 2)->where('shift_date', '>=', $start_time)->where('shift_date', '<', $end_time)->get()->count();
        $tmp['shift_normal'] = $cnt_shift_normal;
        $tmp['shift_night'] = $cnt_shift_night;
        $tmp['price_normal'] = $user->contract_value * $cnt_shift_normal;
        $tmp['price_night'] = calculatePriceByRole($cnt_shift_night, $user->contract_type, 2);
        $cnt_shift_total = UserShift::where('user_id', $user->id)->where('shift_date', '>=', $start_time)->where('shift_date', '<', $end_time)->get()->count();
        $tmp['sub_staff'] = 0;
        $tmp['sub_price'] = 0;
        $tmp['direct_staff'] = 0;
        $tmp['direct_price'] = 0;
        if($user->contract_type == 4){
            $team_id = $user->team_id;
            $team_staffs = User::where('team_id', $team_id)->get();
            foreach ($team_staffs as $staff){
                if($staff->id != $user->id){
                    $cnt_shift_staff = UserShift::where('user_id', $staff->id)->get()->count();
                    if($cnt_shift_staff >= 20){
                        $tmp['sub_staff'] = $tmp['sub_staff'] + 1;
                    }
                }
            }
            if($tmp['sub_staff'] > 3){
                $tmp['sub_price'] = $tmp['sub_staff'] * 7000;
            }
            else{
                $tmp['sub_staff'] = 0;
            }
            $direct_staffs = User::where('director_id', $user->id)->get();
            foreach ($direct_staffs as $staff){
                $cnt_shift_staff = UserShift::where('user_id', $staff->id)->get()->count();
                if($cnt_shift_staff >= 20){
                    $tmp['direct_staff'] = $tmp['direct_staff'] + 1;
                }
            }
            if($tmp['direct_staff'] > 3){
                $tmp['direct_price'] = $tmp['direct_staff'] * 3000;
            }
            else{
                $tmp['direct_staff'] = 0;
            }
        }
        $tmp['a_price'] = $tmp['price_normal'] + $tmp['price_night'] + $tmp['sub_price'] + $tmp['direct_price'] + $price_over;

        $tmp['insurance'] = 0;
        if($user->insurance == 1){
            $tmp['insurance'] = calculatePriceByType(1, 'insurance');
        }
        $tmp['self_insurance'] = calculatePriceByType($cnt_shift_total, 'self-insurance');
        $tmp['safe_cost'] = $user->safe_cost * $user->contract_type;
        $tmp['cloth'] = 0;
        if($user->cloth == 1){
            $tmp['cloth'] = calculatePriceByType($cnt_shift_total, 'cloth');
        }
        $tmp['helmet'] = calculatePriceByType($cnt_shift_total, 'helmet');
        $tmp['dormitory'] = 0;
        if($user->dormitory == 1){
            $tmp['dormitory'] = calculatePriceByType($cnt_shift_total, 'dormitory');
        }
        $tmp['business_phone'] = 0;
        if($user->business_phone == 1){
            $tmp['business_phone'] = calculatePriceByType($cnt_shift_total, 'phone');
        }

        $tmp['pre_pay'] = 0;
        $history = UserAdvance::where('user_id', $user->id)->where('status', 1)->where('updated_at', '>=', $start_time)->where('updated_at', '<', $end_time)->get();
        foreach ($history as $item){
            $tmp['pre_pay'] = $tmp['pre_pay'] + $item->payment;
        }

        $tmp['pring'] = 0;
        if($user->receive_type == 1){
            $tmp['pring'] = 55;
        }
        $tmp['b_price'] = $tmp['insurance'] + $tmp['self_insurance'] + $tmp['safe_cost'] + $tmp['cloth'] + $tmp['helmet'] + $tmp['dormitory'] + $tmp['business_phone'] + $tmp['pre_pay'] + $tmp['pring'];
        return view('admin.WorkReportMaster.work-shift-personal', compact('tmp'));
    }
}
