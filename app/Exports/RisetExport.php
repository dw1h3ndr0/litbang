<?php

namespace App\Exports;

use App\Models\Riset;
use App\Models\Kategori;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RisetExport implements FromCollection, WithHeadings, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

    	// dd(Riset::all());
        // $data_kategori = Kategori::all();
        // $kategoris = Riset::select('kategori_id')->explode(',');
        return Riset::select('tahun','tahun_data','tgl_mulai','tgl_selesai','sumber_dana','judul','penyelenggara','pelaksana','penanggungjawab','nik','kontak','no_surat_izin','tgl_surat_izin')->get();
    }

    public function headings(): array

    {

        return [

        	'Tahun',

            'Tahun Data',

            'Tanggal Mulai',

            'Tanggal Selesai',

            'Sumber Dana',

        	'Judul',

            'Penyelenggara Kegiatan',

        	'Pelaksana Kegiatan',

            'Penanggung Jawab Kegiatan',

        	'NIK',

            'Kontak',

        	'Nomor Surat Izin',

            'Tanggal Surat Izin',

        ];

    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => [
            		'font' => [
            			'bold' => false,
            			'color' => [
            				'argb' => 'FFFFFFFF'
            			]
            		],
            		 'alignment' => [
            		 	'wrapText' => true, 
            		 	'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
					    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            		],
            		'fill' => [
				        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
				        'color' => [
				            'argb' => 'FF32CD32',
				        ],
				        'endColor' => [
				            'argb' => 'FF32CD32',
				        ],
        			],
        			// 'borders' => [
        			// 	'inside'=> [
        			// 		'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
        			// 		'color' => ['argb' => 'FFFFFF']
        			// 	]
        			// ],         				
        		],        		

            // Styling a specific cell by coordinate.
            // 'B2' => ['font' => ['italic' => true]],

            // Styling an entire column.
            // 'C'  => ['font' => ['size' => 16]],
        ];
    }
}
