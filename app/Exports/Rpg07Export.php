<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class Rpg07Export implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $datas;
    protected $after_date;
    protected $before_date;

    public function __construct($datas,$after_date,$before_date)
    {
        $this->datas = $datas;
        $this->after_date = $after_date;
        $this->before_date = $before_date;
    }



    public function collection()
    {
        //建立標題
        $rows=[];

        foreach($this->datas as $key => $data)
        {
            $data->comment = '';
            foreach($data->gdpapers as $gd_key => $gdpaper)
            {
                if (isset($gdpaper->gdpaper_id)){
                    $data->comment .= $gdpaper->gdpaper_name->name."\r\n";
                }else{
                    $data->comment .= '無';
                }
            }
        }
        dd($this->datas);

        foreach($this->datas as $key => $data)
        {
            $rows[] = [
                'No' => $key+1,
                '日期' => $data->sale_date,
                '客戶' => $data->cust_name->name,
                '寶貝名' => $data->pet_name,
                '方案' => $data->plan_name->name,
                '金紙' => $data->comment,
            ];
        }
        return collect([$rows]);

    }

    public function headings(): array
    {
        //第一列為先放一個空白的資料，後面會取代掉
        return [
            ['團火日期'.$this->after_date.' - '.$this->before_date],
            [ 'No','日期','客戶','寶貝名', '方案' , '金紙' , '備註'],
        ];
    }

}
