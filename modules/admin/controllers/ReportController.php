<?php

namespace app\modules\admin\controllers;

use app\models\EventRegistrations;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use Mpdf\Mpdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**
 * Default controller for the `admin` module
 */
class ReportController extends Controller
{
    public $layout = 'main';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index', 'volunteer-participation'],
                'rules' => [
                    [
                        'actions' => ['index', 'volunteer-participation'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->is_admin == 1;
                        },
                    ],
                    [
                        'actions' => ['index', 'volunteer-participation'],
                        'allow' => false,
                    ],
                ],
            ],
        ];
    }

    /**
     * Renders the index view for the module
     * @return string
     */

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionGeneratePdf()
    {
        $data = EventRegistrations::find()->with('event', 'user')->all();

        $mpdf = new Mpdf();
        $mpdf->WriteHTML($this->renderPartial('volunteer-participation', ['data' => $data]));
        $mpdf->Output('volunteer-participation.pdf', 'D');
    }

    public function actionGenerateExcel()
    {
        ob_start();

        $data = EventRegistrations::find()->with('event', 'user')->all();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Имя');
        $sheet->setCellValue('B1', 'Фамилия');
        $sheet->setCellValue('C1', 'Отчество');
        $sheet->setCellValue('D1', 'Мероприятие');
        $sheet->setCellValue('E1', 'Дата регистрации');
        $sheet->setCellValue('F1', 'Статус');

        $row = 2;
        foreach ($data as $registration) {
            $sheet->setCellValue('A' . $row, $registration->user->name);
            $sheet->setCellValue('B' . $row, $registration->user->surname);
            $sheet->setCellValue('C' . $row, $registration->user->patronymic);
            $sheet->setCellValue('D' . $row, $registration->event->title);
            $sheet->setCellValue('E' . $row, $registration->registration_date);
            $sheet->setCellValue('F' . $row, $registration->getStatusForReport());
            $row++;
        }

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="volunteer_report.xlsx"');
        header('Cache-Control: max-age=0');

        ob_end_clean();
        $writer->save('php://output');
        exit;
    }


}