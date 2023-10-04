<?php

namespace App\Exports;
use App\Grupos_usuarios;
use App\Grupos;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Style\Color;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithBackgroundColor;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Sheet;




class UsersExport implements FromView, ShouldAutoSize, WithStyles, WithBackgroundColor, WithDrawings, WithEvents
{
    private $id;
    public function __construct($id) 
    {
        $this->id = $id;
    }

    public function view(): View
    {
        $grupos_usuarios = DB::select("
            SELECT 
                p.id,
                u.name as nombre_usuario,
                u.email,
                u.rut,
                u.telefono,
                u.id as id_usuario,
                (
                    SELECT COUNT(id) 
                    FROM preguntas 
                    WHERE preguntas.id_prueba = p.id_prueba
                    AND preguntas.temario_id in (
                        SELECT temario_id
                        FROM users_temarios
                        WHERE users_temarios.user_id = u.id
                    )
                ) as total_preguntas,
                COUNT(rp.id_pregunta) AS total_respuestas,
                SUM(rp.id_alternativa_correcta = ru.id_alternativa) AS respuestas_correctas,
                SUM(rp.id_alternativa_correcta != ru.id_alternativa) AS respuestas_incorrectas,
                (SUM(rp.id_alternativa_correcta = ru.id_alternativa) / COUNT(rp.id_pregunta)) * 100 AS porcentaje_respuestas_correctas,
                p.created_at,
                p.end_at
            FROM `grupos_usuarios` gu
            LEFT JOIN users u ON gu.users_id = u.id
            LEFT JOIN prueba_rendida_usuarios p ON u.id = p.id_usuario
            LEFT JOIN respuestas_usuarios ru ON ru.id_prueba = p.id_prueba AND ru.id_usuario = p.id_usuario
            LEFT JOIN respuestas_pruebas rp ON rp.id_pregunta = ru.id_pregunta
            WHERE u.deleted_at is null and gu.grupo_id = $this->id
            GROUP BY p.id, u.id
            ORDER BY p.created_at DESC;
        ");
        $grupo = Grupos::select('grupos.*')->where('grupos.id', $this->id)->get();


        return view('reportes.excel',[
            'grupos_usuarios' => $grupos_usuarios,
            'grupo' => $grupo
        
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            '9'  => ['font' => ['size' => 16]],
            '10'  => ['font' => ['size' => 14]],

        ];
    }

     public function backgroundColor()
    {

    }

      public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('/images/logo-dark.png'));
        $drawing->setHeight(60);
        $drawing->setCoordinates('J5');

        return $drawing;
    }

    public function registerEvents(): array
    {
        return [
    AfterSheet::class => function(AfterSheet $event) {
        $event->sheet->getStyle('B17:K17')->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '#000000'],
                ],
            ],
        ]);
        /*$event->sheet->getStyle('B17:K17')->getFill()
          ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
          ->getStartColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLUE);*/
        $event->sheet->getDelegate()->getStyle('B17:K17')
                                ->getFont()
                                ->getColor()
                                ->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
    }
];
    }

}
