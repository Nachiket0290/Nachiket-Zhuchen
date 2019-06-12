<?php
$json = file_get_contents('https://openlibrary.org/search.json?q=George+R.+R.+Martin&mode=ebooks&m=edit&m=edit&has_fulltext=true');
$obj = json_decode($json);
echo "<pre>";
print_r($obj);

//echo "$obj->num_found";
//echo "string";
$array = $obj->docs;
foreach ($array as $a)
{
  // code...
  $temp = [];
  $isbn = $a->isbn[0];
  array_push($temp,$isbn);
  array_push($temp,$a->title);
  $author_name = $a->author_name[0];
  array_push($temp,$author_name);
  $publisher = $a->publisher[0];
  array_push($temp,$publisher);

  array_push($csv_body,$temp);
}



$csv_header = ['ISBN','TITLE','AUTHOR','PUBLISHER','NR_PAGES','PUBLISH_DATE'];
$fp = fopen('exam.csv','a');
$header = implode(',', $csv_header) . PHP_EOL;

// $csv_body = [
//     ['8020409262','The Lord of the Rings','George R. R. Martin','Klett-Cotta','1','2009 03']
// ];

$content = '';

foreach ($csv_body as $k => $v) {

    $content .= implode(',', $v) . PHP_EOL;

}
$csv = $header.$content;
fwrite($fp, $csv);
fclose($fp);

 ?>
