<?php

namespace Imankubbil\TraceTracking\Controller;
use DOMDocument;

class HomeController {

    function index() {
        header("Content-Type: text/plain");
        $html = file_get_contents("https://gist.githubusercontent.com/nubors/eecf5b8dc838d4e6cc9de9f7b5db236f/raw/d34e1823906d3ab36ccc2e687fcafedf3eacfac9/jne-awb.html");

        $htmlToObj = $this->html_to_obj($html);
        $processObj = $this->process_obj($htmlToObj);
        // $modifyObj = $this->modify_obj($processObj);

        echo json_encode($htmlToObj, JSON_PRETTY_PRINT);
    }

    function html_to_obj($html) {

        $received = '';
        $histories = [];
        
        $table = [];

        $status = [
            'code' => '060101',
            'message' => 'Delivery tracking detail fetched successfully'
        ];
      
        $dom = simplexml_load_string($html);
        $section = $dom->section->div;

        foreach($section->table as $val) {
            foreach($val->tbody->tr as $val2) {
                array_push($table, $val2);
            }
        }

        foreach(array_reverse($table) as $key => $val) {
            
            for ($i=0; $i < count($val->td) ; $i++) { 
                $pos = strpos($val->td[$i], 'DELIVERED TO');
                if ($pos !== false) {
                    $exp = explode('[', $val->td[$i]);
                    $exp2 = explode('|', $exp[1]);
                    $received .= $exp2[0];
                }

            }

            $toArray = (array) $val->td;

            $checks  = ['INFINIA', 'OTTEN', '3452440'];

            $notIn = $this->multi_strpos($toArray[0], $checks);

            if($notIn !== 0) {
                $itemData = [
                    'description' => $toArray[1],
                    'createdAt' => $toArray[0],
                    'formatted' => [
                        'createdAt' => date("d-F-Y H:i:s", strtotime($toArray[0]))
                    ]
                    ];
                array_push($histories, $itemData);
            }
        };

        $data = [
            'status' => $status,
            'data' => [
                'receivedBy' => $received,
                'histories' => $histories
            ]
        ];
        
        echo json_encode($data, true);die();
    }

    function multi_strpos($string, $check, $getResults = false)
    {
        $result = array();
        $check = (array) $check;

        foreach ($check as $s)
        {
            $pos = strpos($string, $s);

            if ($pos !== false) {
                if ($getResults) {
                    $result[$s] = $pos;
                } else {
                    return $pos;          
                }
            }
        }

        return empty($result) ? false : $result;
    }
}

?>