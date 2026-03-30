<?php
/**
 * Docx Text Extractor for VIVA Engineering
 */

function read_docx($filename) {
    if (!file_exists($filename)) return "File not found.";
    
    $zip = new ZipArchive;
    if ($zip->open($filename) === true) {
        if (($index = $zip->locateName('word/document.xml')) !== false) {
            $data = $zip->getFromIndex($index);
            $zip->close();
            
            // Basic XML stripping to get text
            $xml = new DOMDocument();
            $xml->loadXML($data);
            return $xml->textContent;
        }
        $zip->close();
    }
    return "Could not read docx content.";
}

$content = read_docx('D:\\PHOTO\\VIVA\\Product group.docx');
file_put_contents(__DIR__ . '/docx_content.txt', $content);
echo "Extraction complete. Content saved to docx_content.txt\n";
?>
