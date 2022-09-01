<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Invoice;
use App\Models\Site;
use App\Models\User;
use App\Models\UserShift;
use App\Models\VehicleReport;
use Faker\Provider\en_IN\Internet;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class CompanyController extends Controller
{
    //
    public function companyManage(){
        $data = Company::all();
        return view('admin.CompanyMaster.company-manager', compact('data'));
    }
    public function companyAdd(){
        return view('admin.CompanyMaster.company-add');
    }
    public function companySave(Request $request){
        if(isset($request->id)){
            Company::where('id', $request->id)->update(['name' => $request->name, 'post_code' => $request->post_code,
                'address' => $request->address, 'phone' => $request->phone, 'fax' => $request->fax, 'email' => $request->email]);
        }
        else{
            Company::create(['name' => $request->name, 'post_code' => $request->post_code,
                'address' => $request->address, 'phone' => $request->phone, 'fax' => $request->fax, 'email' => $request->email]);
        }
        return response()->json(['status' => true]);
    }
    public function companyDelete(Request $request){
        Company::where('id', $request->id)->delete();
        return response()->json(['status' => true]);
    }

    public function invoiceManage(){
        $company = Company::all();
        return view('admin.CompanyMaster.invoice-manager', compact('company'));
    }
    public function invoiceTable(Request $request){
        $month = $request->year . '-'. $request->month;
        $sites = Site::where('status', 1)->get();
        $data = [];
        foreach ($sites as $site){
            $tmp = [];
            $tmp['id'] = $site->id;
            $tmp['name'] = $site->name;
            $invoice = Invoice::where('site_id', $site->id)->where('month', $month)->get()->first();
            if(!empty($invoice)){
                $tmp['amount'] = $invoice->amount;
            }
            else{
                $tmp['amount'] = 0;
            }
            array_push($data, $tmp);
        }

        return view('admin.CompanyMaster.invoice-table', compact('data'));
    }
    public function invoiceChange(Request $request){
        $site_id = $request->site_id;
        $month = $request->year . '-'. $request->month;
        $data = [
            'site_id' => $site_id,
            'month' => $month,
        ];

        Invoice::updateOrCreate($data, ['amount' => $request->amount]);
        return response()->json(['status' => true]);
    }
    public function invoiceDetailExportDown(Request $request){
        $request_month = $request->request_month;
        $start_date = date('Y-m-01', strtotime($request_month));
        $end_date = date('Y-m-d', strtotime('+1 month', strtotime($request_month)));

        $site_data = UserShift::with('site')->with('user')->whereIn('id', function($query) use ($start_date, $end_date) {
            $query->from('user_shifts')->where('shift_date', '>=', date('Y-m-d', strtotime($start_date)))
                ->where('shift_date', '<', date('Y-m-d', strtotime($end_date)))->groupBy('site_id')->selectRaw('MAX(id)');
        })->pluck('site_id')->toArray();
        $data = [];
        $total_row = 1;
        for($i = 0, $iMax = count($site_data); $i < $iMax; $i++){
            $tmp = array();
            $site_id = $site_data[$i];
            $tmp['site_id'] = $site_id;
            $tmp['site_name'] = Site::find($site_id)->name;
            $user_data = UserShift::with('site')->with('user')->whereIn('id', function($query) use ($start_date, $end_date, $site_id) {
                $query->from('user_shifts')->where('shift_date', '>=', date('Y-m-d', strtotime($start_date)))
                    ->where('shift_date', '<', date('Y-m-d', strtotime($end_date)))->where('site_id', $site_id)->groupBy('user_id')->selectRaw('MAX(id)');
            })->pluck('user_id')->toArray();
            $tmp['user_cnt'] = count($user_data);
            $total_row += count($user_data)+7;
            $tmp_user = [];
            for ($j = 0, $jMax = count($user_data); $j < $jMax; $j++){
                $tmp1 = array();
                $user_id = $user_data[$j];
                $tmp1['user_id'] = $user_id;
                $tmp1['user_shifts'] = UserShift::where('site_id', $site_id)->where('user_id', $user_id)->where('shift_date', '>=', date('Y-m-d', strtotime($start_date)))
                    ->where('shift_date', '<', date('Y-m-d', strtotime($end_date)))->get()->count();
                $tmp1['user_salary'] = User::find($user_id)->contract_value;
                $tmp1['user_name'] = User::find($user_id)->name;
                array_push($tmp_user, $tmp1);
            }
            $tmp['user_data'] = $tmp_user;
            $vehicle_data = VehicleReport::where('site_id', $site_id)->where('report_date', '>=', date('Y-m-d', strtotime($start_date)))
                ->where('report_date', '<', date('Y-m-d', strtotime($end_date)))->get();
            $etc = 0; $oil = 0; $park = 0; $other = 0;
            foreach ($vehicle_data as $item){
                $etc += $item->etc_value;
                $oil += $item->oil_valur;
                $park += $item->parking_value;
                $other += $item->other_value;
            }
            $tmp['car'] = $vehicle_data->count();
            $tmp['etc'] = $etc;
            $tmp['park'] = $park;
            $tmp['other'] = $other;
            array_push($data, $tmp);
        }
        //print_r($data);

        $style_title = [
            'font' => [
                'color' => ['rgb' => '000000'],
                'size' => 11
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
                'horizontal' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
                'vertical' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->getColumnDimension('B')->setWidth(15);
        $sheet->getColumnDimension('C')->setWidth(12);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(15);
        $sheet->getColumnDimension('F')->setWidth(15);
        $sheet->getColumnDimension('G')->setWidth(15);
        $sheet->getColumnDimension('H')->setWidth(15);

        $sheet->getStyle('B8')->applyFromArray($style_title);
        $sheet->getCell('B8')->setValue('現場名');
        $sheet->getStyle('C8')->applyFromArray($style_title);
        $sheet->getCell('C8')->setValue('区分');
        $sheet->getStyle('D8')->applyFromArray($style_title);
        $sheet->getCell('D8')->setValue('氏名');
        $sheet->getStyle('E8')->applyFromArray($style_title);
        $sheet->getCell('E8')->setValue('人工数');
        $sheet->getStyle('F8')->applyFromArray($style_title);
        $sheet->getCell('F8')->setValue('単位');
        $sheet->getStyle('G8')->applyFromArray($style_title);
        $sheet->getCell('G8')->setValue('単価');
        $sheet->getStyle('H8')->applyFromArray($style_title);
        $sheet->getCell('H8')->setValue('金額');
//        print_r($data);
//        die;
        $row_1 = 9;
        try {
            for($i = 0, $iMax = count($data); $i < $iMax; $i++){
                $sheet->mergeCellsByColumnAndRow(2, $row_1, 2, $row_1 + $data[$i]['user_cnt'] + 6);
                $sheet->getStyleByColumnAndRow(2, $row_1, 2, $row_1 + $data[$i]['user_cnt'] + 6)->applyFromArray($style_title);
                $sheet->getCellByColumnAndRow(2, $row_1)->setValue($data[$i]['site_name']);

                $sheet->mergeCellsByColumnAndRow(3, $row_1, 3, $row_1 + $data[$i]['user_cnt']);
                $sheet->getStyleByColumnAndRow(3, $row_1, 3, $row_1 + $data[$i]['user_cnt'])->applyFromArray($style_title);
                $sheet->getCellByColumnAndRow(3, $row_1)->setValue('労務費');
                $sheet->mergeCellsByColumnAndRow(3, $row_1 + $data[$i]['user_cnt'] + 1, 3, $row_1 + $data[$i]['user_cnt'] + 5);
                $sheet->getStyleByColumnAndRow(3, $row_1 + $data[$i]['user_cnt'] + 1, 3, $row_1 + $data[$i]['user_cnt'] + 5)
                    ->applyFromArray($style_title);
                $sheet->getCellByColumnAndRow(3, $row_1 + $data[$i]['user_cnt'] + 1)->setValue('経費');

                $sheet->getStyleByColumnAndRow(4, $row_1, 4, $row_1 + $data[$i]['user_cnt'] + 5)->applyFromArray($style_title);
                $user_data = $data[$i]['user_data'];
                $user_total = 0;
                for ($j = 0, $jMax = count($user_data); $j < $jMax; $j++){
                    $sheet->getCellByColumnAndRow(4, $row_1 + $j)->setValue($user_data[$j]['user_name']);
                    $sheet->getCellByColumnAndRow(5, $row_1 + $j)->setValue($user_data[$j]['user_shifts']);
                    $sheet->getCellByColumnAndRow(6, $row_1 + $j)->setValue('日');
                    $sheet->getCellByColumnAndRow(7, $row_1 + $j)->setValue($user_data[$j]['user_salary']);
                    $sheet->getCellByColumnAndRow(8, $row_1 + $j)->setValue($user_data[$j]['user_salary'] * $user_data[$j]['user_shifts']);
                    $user_total = $user_total + $user_data[$j]['user_salary'] * $user_data[$j]['user_shifts'];
                }
                $sheet->getCellByColumnAndRow(4, $row_1 + $data[$i]['user_cnt'])->setValue('合計金額　A');
                $sheet->getCellByColumnAndRow(5, $row_1 + $data[$i]['user_cnt'])->setValue('1');
                $sheet->getCellByColumnAndRow(6, $row_1 + $data[$i]['user_cnt'])->setValue('式');
                $sheet->getCellByColumnAndRow(8, $row_1 + $data[$i]['user_cnt'])->setValue($user_total);

                $sheet->getCellByColumnAndRow(4, $row_1 + $data[$i]['user_cnt'] + 1)->setValue('車両費');
                $sheet->getCellByColumnAndRow(5, $row_1 + $data[$i]['user_cnt'] + 1)->setValue($data[$i]['car']);
                $sheet->getCellByColumnAndRow(6, $row_1 + $data[$i]['user_cnt'] + 1)->setValue('往復');
                $sheet->getCellByColumnAndRow(7, $row_1 + $data[$i]['user_cnt'] + 1)->setValue('5000');
                $sheet->getCellByColumnAndRow(8, $row_1 + $data[$i]['user_cnt'] + 1)->setValue(5000* $data[$i]['car']);

                $sheet->getCellByColumnAndRow(4, $row_1 + $data[$i]['user_cnt'] + 2)->setValue('高速代');
                $sheet->getCellByColumnAndRow(5, $row_1 + $data[$i]['user_cnt'] + 2)->setValue('1');
                $sheet->getCellByColumnAndRow(6, $row_1 + $data[$i]['user_cnt'] + 2)->setValue('式');
                $sheet->getCellByColumnAndRow(7, $row_1 + $data[$i]['user_cnt'] + 2)->setValue($data[$i]['etc']);
                $sheet->getCellByColumnAndRow(8, $row_1 + $data[$i]['user_cnt'] + 2)->setValue($data[$i]['etc']);

                $sheet->getCellByColumnAndRow(4, $row_1 + $data[$i]['user_cnt'] + 3)->setValue('駐車場代');
                $sheet->getCellByColumnAndRow(5, $row_1 + $data[$i]['user_cnt'] + 3)->setValue('1');
                $sheet->getCellByColumnAndRow(6, $row_1 + $data[$i]['user_cnt'] + 3)->setValue('式');
                $sheet->getCellByColumnAndRow(7, $row_1 + $data[$i]['user_cnt'] + 3)->setValue($data[$i]['park']);
                $sheet->getCellByColumnAndRow(8, $row_1 + $data[$i]['user_cnt'] + 3)->setValue($data[$i]['park']);

                $sheet->getCellByColumnAndRow(4, $row_1 + $data[$i]['user_cnt'] + 4)->setValue('その他経費');
                $sheet->getCellByColumnAndRow(5, $row_1 + $data[$i]['user_cnt'] + 4)->setValue('1');
                $sheet->getCellByColumnAndRow(6, $row_1 + $data[$i]['user_cnt'] + 4)->setValue('式');
                $sheet->getCellByColumnAndRow(7, $row_1 + $data[$i]['user_cnt'] + 4)->setValue($data[$i]['other']);
                $sheet->getCellByColumnAndRow(8, $row_1 + $data[$i]['user_cnt'] + 4)->setValue($data[$i]['other']);

                $sheet->getCellByColumnAndRow(4, $row_1 + $data[$i]['user_cnt'] + 5)->setValue('合計金額　B');
                $sheet->getCellByColumnAndRow(5, $row_1 + $data[$i]['user_cnt'] + 5)->setValue('1');
                $sheet->getCellByColumnAndRow(6, $row_1 + $data[$i]['user_cnt'] + 5)->setValue('式');
                $sheet->getCellByColumnAndRow(8, $row_1 + $data[$i]['user_cnt'] + 5)
                    ->setValue(5000*$data[$i]['car']+$data[$i]['etc']+$data[$i]['park']+$data[$i]['other']);

                $sheet->mergeCellsByColumnAndRow(3, $row_1 + $data[$i]['user_cnt'] + 6, 4, $row_1 + $data[$i]['user_cnt'] + 6);
                $sheet->getStyleByColumnAndRow(3, $row_1 + $data[$i]['user_cnt'] + 6, 4, $row_1 + $data[$i]['user_cnt'] + 6)
                    ->applyFromArray($style_title);
                $sheet->getCellByColumnAndRow(3, $row_1 + $data[$i]['user_cnt'] + 6)->setValue('総合計金額　A+B');
                $sheet->getCellByColumnAndRow(5, $row_1 + $data[$i]['user_cnt'] + 6)->setValue('1');
                $sheet->getCellByColumnAndRow(6, $row_1 + $data[$i]['user_cnt'] + 6)->setValue('式');
                $sheet->getCellByColumnAndRow(8, $row_1 + $data[$i]['user_cnt'] + 6)
                    ->setValue($user_total+5000*$data[$i]['car']+$data[$i]['etc']+$data[$i]['park']+$data[$i]['other']);


                $row_1 = $row_1 + $data[$i]['user_cnt'] + 7;
            }
            $sheet->getStyleByColumnAndRow(5, 9, 8, $row_1 - 1)->applyFromArray($style_title);
        } catch (Exception $e) {
        }


        header("Content-Type:   application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Content-Disposition: attachment; filename=請求書明細.xls");  //File name extension was wrong
        $writer = IOFactory::createWriter($spreadsheet, 'Xls');
        $writer->save('php://output');
    }
    public function invoiceExportDown(Request $request){
        $request_month = $request->request_month;
        $invoices = Invoice::with('site')->where('month', $request_month)->get();
        $style_table = [
            'font' => [
                'color' => ['rgb' => '000000'],
                'size' => 12
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
                'horizontal' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
                'vertical' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];
        $style_title = [
            'font' => [
                'color' => ['rgb' => '000000'],
                'size' => 18
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ]
        ];
        $style_company = [
            'font' => [
                'color' => ['rgb' => '000000'],
                'size' => 16
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'bottom' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ]
            ]
        ];
        $style_company1 = [
            'font' => [
                'color' => ['rgb' => '000000'],
                'size' => 14
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ]
        ];

        $style_date = [
            'font' => [
                'color' => ['rgb' => '000000'],
                'size' => 12
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ]
        ];
        $style_date1 = [
            'font' => [
                'color' => ['rgb' => '000000'],
                'size' => 12
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ]
        ];
        $style_price = [
            'font' => [
                'color' => ['rgb' => '000000'],
                'size' => 14
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'bottom' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOUBLE,
                    'color' => ['rgb' => '000000'],
                ]
            ]
        ];

        $style_com = [
            'font' => [
                'color' => ['rgb' => '000000'],
                'size' => 16
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ]
        ];

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setShowGridlines(false);
        $sheet->getColumnDimension('A')->setWidth(15);
        $sheet->getColumnDimension('B')->setWidth(7);
        $sheet->getColumnDimension('C')->setWidth(7);
        $sheet->getColumnDimension('D')->setWidth(7);
        $sheet->getColumnDimension('E')->setWidth(7);
        $sheet->getColumnDimension('F')->setWidth(7);
        $sheet->getColumnDimension('G')->setWidth(7);
        $sheet->getColumnDimension('H')->setWidth(7);
        $sheet->getColumnDimension('I')->setWidth(7);
        $sheet->getColumnDimension('J')->setWidth(7);
        $sheet->getColumnDimension('K')->setWidth(7);
        $sheet->getColumnDimension('L')->setWidth(7);
        $sheet->getColumnDimension('M')->setWidth(7);
        $sheet->getColumnDimension('N')->setWidth(5);
        $sheet->getColumnDimension('O')->setWidth(9);
        $sheet->getColumnDimension('P')->setWidth(5);
        $sheet->getColumnDimension('Q')->setWidth(8);
        $sheet->getColumnDimension('R')->setWidth(8);
        try {
            $sheet->mergeCells('A1:R1');
            $sheet->getStyle('A1')->applyFromArray($style_title);
            $sheet->getCell('A1')->setValue('請　求　書');
            $sheet->mergeCells('A3:G3');
            $sheet->getStyle('A3:G3')->applyFromArray($style_company);
            $sheet->getCell('A3')->setValue('株式会社　占部組');
            $sheet->mergeCells('H3:I3');
            $sheet->getStyle('H3')->applyFromArray($style_company1);
            $sheet->getCell('H3')->setValue('御中');
            $sheet->mergeCells('M4:N4');
            $sheet->getStyle('M4')->applyFromArray($style_date);
            $sheet->getCell('M4')->setValue('請求日');
            $sheet->mergeCells('O4:R4');
            $sheet->getStyle('O4')->applyFromArray($style_date1);
            $sheet->getCell('O4')->setValue(date('m/d/Y'));
            $sheet->mergeCells('A6:B6');
            $sheet->getStyle('A6:B6')->applyFromArray($style_price);
            $sheet->getCell('A6')->setValue('御請求額（税込）');
            $sheet->mergeCells('C6:I6');
            $sheet->getStyle('C6:I6')->applyFromArray($style_price);
            $sheet->mergeCells('M6:R6');
            $sheet->getStyle('M6')->applyFromArray($style_com);
            $sheet->getCell('M6')->setValue('株式会社　山大企画');
            $sheet->mergeCells('B7:J7');
            $sheet->getStyle('B7')->applyFromArray($style_date);
            $sheet->getCell('B7')->setValue('下記の通り、ご請求申し上げます。');
            $sheet->mergeCells('M7:R7');
            $sheet->getStyle('M7')->applyFromArray($style_date);
            $sheet->getCell('M7')->setValue('大阪市淀川区十八条１－４－３５');
            $sheet->mergeCells('M8:R8');
            $sheet->getStyle('M8')->applyFromArray($style_date);
            $sheet->getCell('M8')->setValue('パールハイツ東三国１０２号');

            $sheet->getCell('A10')->setValue('No.');
            $sheet->mergeCells('B10:I10');
            $sheet->getCell('B10')->setValue('現場名');
            $sheet->mergeCells('J10:K10');
            $sheet->getCell('J10')->setValue('数量');
            $sheet->getCell('L10')->setValue('単位');
            $sheet->mergeCells('M10:O10');
            $sheet->getCell('M10')->setValue('単価');
            $sheet->mergeCells('P10:R10');
            $sheet->getCell('P10')->setValue('金額');

            for ($i = 11; $i <= 26; $i++){
                $sheet->mergeCellsByColumnAndRow(2, $i, 9, $i);
                $sheet->mergeCellsByColumnAndRow(10, $i, 11, $i);
                $sheet->mergeCellsByColumnAndRow(13, $i, 15, $i);
                $sheet->mergeCellsByColumnAndRow(16, $i, 18, $i);
            }
            $total = 0;
            foreach ($invoices as $index => $invoice){
                $sheet->getCellByColumnAndRow(1, 11 + $index)->setValue($index+1);
                $sheet->getCellByColumnAndRow(2, 11 + $index)->setValue($invoice->site->name);
                $sheet->getCellByColumnAndRow(10, 11 + $index)->setValue(1);
                $sheet->getCellByColumnAndRow(12, 11 + $index)->setValue('式');
                $sheet->getCellByColumnAndRow(13, 11 + $index)->setValue($invoice->amount);
                $sheet->getCellByColumnAndRow(16, 11 + $index)->setValue($invoice->amount);
                $total += $invoice->amount;
            }
            $sheet->getCell('C6')->setValue(number_format($total) . '円');

            $sheet->getStyleByColumnAndRow(1, 10, 18, 26)->applyFromArray($style_table);
            $sheet->mergeCells('A30:B33');
            $sheet->mergeCells('C30:R33');
            $sheet->getStyle('A30:R33')->applyFromArray($style_table);
            $sheet->getStyle('C30:R33')->applyFromArray($style_date);
            $sheet->getCell('A30')->setValue('備考');
            $sheet->getCell('C30')->setValue('【振込先】
三井住友銀行　新大阪支店
普通　4526973
カ）ヤマダイキカク　　　　　　　　　　　　　　　　　　　　　　　　御支払期限　6/6');

        } catch (Exception $e) {
        }

        header("Content-Type:   application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Content-Disposition: attachment; filename=請求書.xls");  //File name extension was wrong
        $writer = IOFactory::createWriter($spreadsheet, 'Xls');
        $writer->save('php://output');
    }
}
