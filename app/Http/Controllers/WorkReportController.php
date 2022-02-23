<?php

namespace App\Http\Controllers;

use App\Models\UserShift;
use App\Models\WorkReport;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class WorkReportController extends Controller
{
    //
    public function workReportManage(){
        return view('admin.WorkReportMaster.work-report-manager');
    }
    public function workReportTable(Request $request){
        $site_name = $request->site_name;
        if(isset($site_name)){
            if(isset($request->report_date)){
                $data = WorkReport::with('site')->with('user')->whereHas('site', function ($query) use ($site_name){
                    $query->where('name', 'like' , '%' . $site_name . '%');
                })->where('report_date', date('Y-m-d', strtotime($request->report_date)))->get();
            }
            else{
                $data = WorkReport::with('site')->with('user')->whereHas('site', function ($query) use ($site_name){
                    $query->where('name', 'like' , '%' . $site_name . '%');
                })->get();
            }
        }
        else{
            if(isset($request->report_date)){
                $data = WorkReport::with('site')->with('user')->where('report_date', date('Y-m-d', strtotime($request->report_date)))->get();
            }
            else{
                $data = WorkReport::with('site')->with('user')->get();
            }
        }
        return view('admin.WorkReportMaster.work-report-table', compact('data'));
    }
    public function workReportDetailTable(Request $request){
        $report_id = $request->report_id;
        $work_report = WorkReport::find($report_id);
        $data = UserShift::with('user')->where('site_id', $work_report->site_id)->get();
        return view('admin.WorkReportMaster.work-report-detail-table', compact('data'));
    }
    public function workReportExportExcel($id){
        $work_report = WorkReport::with('site')->with('user')->find($id);
        $data = UserShift::with('user')->where('site_id', $work_report->site_id)->get();
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
}
