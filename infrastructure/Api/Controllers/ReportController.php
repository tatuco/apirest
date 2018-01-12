<?php
/**
 * Created by PhpStorm.
 * User: luis
 * Date: 26/11/17
 * Time: 08:25 PM
 */

namespace Infrastructure\Api\Controllers;


use Api\Users\Models\User;
use Api\Utils\Reports\src\ReportGenerator;
use Api\Utils\Reports\src\ReportMedia\ExcelReport;
use Api\Utils\Reports\src\ReportMedia\PdfReport;
use Infrastructure\Http\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    // PdfReport Aliases
  // use PdfReport;
    public $pdf;
    public $xls;

    public function __construct(PdfReport $pdf, ExcelReport $xls)
    {
        $this->$pdf = $pdf;
        $this->$xls = $xls;
    }


    /**
     * @param Request $request
     * @return mixed
     */
    public function displayReport(Request $request) {
        // Retrieve any filters
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $sortBy = $request->input('sort_by');
        $formatType = $request->input('formatType');

        // Report title
        $title = 'Reporte Usuarios Registrados';

        // For displaying filters description on header
        $meta = [
            'Desde' => $fromDate . ' Hasta ' . $toDate,
            'Por' => $sortBy
        ];

        // Do some querying..
        $queryBuilder = (new User)->select(['name', 'email', 'created_at']);
            //->whereBetween('created_at', [$fromDate, $toDate])
            //->orderBy($sortBy);

        // Set Column to be displayed
        $columns = [
            'Name' => 'name',
            'Email' => 'email',
            'Registered At' => 'created_at', // if no column_name specified, this will automatically seach for snake_case of column name (will be registered_at) column from query result

           // 'Status' => function($result) { // You can do if statement or any action do you want inside this closure
          //      return ($result->balance > 100000) ? 'Rich Man' : 'Normal Guy';
           // }
        ];

        /*
            Generate Report with flexibility to manipulate column class even manipulate column value (using Carbon, etc).

            - of()         : Init the title, meta (filters description to show), query, column (to be shown)
            - editColumn() : To Change column class or manipulate its data for displaying to report
            - editColumns(): Mass edit column
            - showTotal()  : Used to sum all value on specified column on the last table (except using groupBy method). 'point' is a type for displaying total with a thousand separator
            - groupBy()    : Show total of value on specific group. Used with showTotal() enabled.
            - limit()      : Limit record to be showed
            - make()       : Will producing DomPDF / SnappyPdf instance so you could do any other DomPDF / snappyPdf method such as stream() or download()
        */
        //return (new PdfReport())->of($title, $meta, $queryBuilder, $columns)
        return (new ReportGenerator())->format('pdf')->of($title, $meta, $queryBuilder, $columns)
          /*  ->editColumn('Registered At', [
                'displayAs' => function($result) {
                    return $result->registered_at;
                }
            ])
            ->editColumn('Total Balance', [
                'displayAs' => function($result) {
                    return thousandSeparator($result->balance);
                }
            ])
            ->editColumns(['Total Balance', 'Status'], [
                'class' => 'right bold'
            ])
            ->showTotal([
                'Total Balance' => 'point' // if you want to show dollar sign ($) then use 'Total Balance' => '$'
            ])*/
            //->setOrientation('landscape')
            ->limit(20)
            //->setPaper('a6')
            ->stream(); // or download('filename here..') to download pdf
            //->download('/');
    }

}