<?php
    function exportToExcel($filename, $headers, $dataArray) {
        if(sizeof($dataArray) > 0 ) {
            $filename = "/downloads/{$filename}" . strtotime("now") . '.csv';
            $filenameURL = __DIR__ . "/.." . $filename;
            $fp = fopen($filenameURL, "w");
            $seperator = "Sno.";
            $comma = ",";
            foreach ($headers as $header) {
                $seperator .= $comma . '' . str_replace('', '""', $header);
                $comma = ",";
            }
            $seperator .= "\n";
            fputs($fp, $seperator);

            $row_number = 1;
            foreach($dataArray as $data) {
                $seperator = "{$row_number}";
                foreach($data as $element) {
                    $comma = ",";
                    $seperator .= $comma . '' .str_replace('', '""', $element);
                }
                $row_number++;
                $seperator .= "\n";
                fputs($fp, $seperator);
            }
            fclose($fp);
            return $filename;

        }
        return NULL;
    }
?>