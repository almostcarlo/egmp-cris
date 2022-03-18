<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Export extends MY_Controller{

    public function test(){
        $data['filename'] = "test.xls";
        $data['title'] = "sample export report";
        $data['header'][] = "principal name here";
        $data['header'][] = "date here";
        $data['column_header'] = array('name', 'age', 'address');
        $data['body'][0] = array('carlo', '1', 'makati');
        $data['body'][1] = array('jose', '2', 'taguig');
        $data['body'][2] = array('bonifacio', '3', 'pasig');
        // //export_to_excel($data);
        var_dump($data);
        exit();
        //$this->load->model();
        $this->load->library('excel');

        $object = new PHPExcel();

        $object->SetActiveSheetIndex(0);

        $col = array('name', 'age', 'address');
        $col_no = 0;

        /*HEADER*/
        foreach ($col as $c){
            $object->getActiveSheet()->setCellValueByColumnAndRow($col_no, 1, $c);
            //$object->getActiveSheet()->getStyle('A1:Z1')->getFont()->setBold(TRUE);
            $object->getActiveSheet()->getStyle('A1:Z1')->getFill()->getStartColor()->setRGB('FF0000');
            $col_no++;
        }
        /*END HEADER*/

        /*MERGE COLUMNS*/
        $object->getActiveSheet()->setCellValueByColumnAndRow(0, 2, "test long title merge");
        $object->getActiveSheet()->mergeCells('A2:C2');

        /*BODY*/
        $row_no = 4;

        foreach ($col as $c){
            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $row_no, $c."_".$row_no);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $row_no, $c."_".$row_no);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $row_no, $c."_".$row_no);
            $row_no++;
        }
        /*END BODY*/

        $object->SetActiveSheetIndex(0);
        

        // Sending headers to force the user to download the file
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.'export_test.xls"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        $objWriter->save('php://output');
    }
}
