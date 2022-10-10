<?php

if (!isset($argv[1])) {echo "Укажите дирректорию c svg файлами\n"; exit;}

$sourse_dir = $argv[1];
if (!file_exists($sourse_dir)) {echo "Дирректорию c svg файлами не найдена\n"; exit;}

$paths = [];
foreach (scandir($sourse_dir) as $file) {
    if($file != '.' &&  $file != '..') {
        preg_match('/(.+).svg/', $file, $matches);
        if (isset($matches[1])) {
            $content = file_get_contents($sourse_dir.'/'.$file);
            preg_match_all('/d="([^"]+)"/im', $content, $matches_path);
            $path = '';
            if (isset($matches_path[1])) {
                foreach ($matches_path[1] as $index => $item) {
                    $path .= $item;
                }
            }

            $number = $matches[1];
            $name = trim($matches[1]);
            $name = str_ireplace('_', '', $name);
            $paths[$number] = [
                'path' => $path,
                'name' => $name,

            ];
            echo "{$file} успешно обработан\n";
        } else {
            echo "Некорректное имя файла {$file}\n";
        }
    }
}
ksort($paths);

file_put_contents($sourse_dir.'/paths.json', array_string($paths));

function array_string($arr,$opts='json') {

    if (is_array($opts)) $opts['depth']++;
    else {
        if (!is_string($opts)) {
            $in = $opts;
            $opts = is_integer($in) ? "json" : 'php';
            if ($in) $opts .= " pretty print";

        }
        $args = preg_split('/[^a-z0-9]/i', $opts);
        if (in_array('json', $args))
            $opts = array('open'=>'{','close'=>'}','sep'=>': ', 'integers'=>false);
        else $opts = array('open'=>'[','close'=>']','sep'=>' => ','integers'=>true);
        if (!in_array('pretty', $args)) $opts = $opts + array('indent'=>'','eol'=>'');
        else $opts = $opts + array('indent'=>'  ','eol'=>"\n" );
        $opts['depth'] = 1; #starts at 1
        $opts['print'] = in_array('print', $args) || in_array('echo', $args) ? true:false;
    }
    end($arr); $last = key($arr);
    $result = "$opts[open]$opts[eol]";

    foreach($arr as $k=>$v){
        $result .= str_repeat($opts['indent'],$opts['depth']);
        if (!$opts['integers']) { $result .= "\n"; $result .= "\"$k\"$opts[sep]";}
        else {$result .= is_integer($k) ? " $k$opts[sep]" : "\"$k\"$opts[sep]"; $result .= "\n";}
        if    (is_array($v))   $result .= array_string($v,$opts);
        elseif(is_bool($v))    $result .= $v ? "true":"false";
        elseif(is_numeric($v)) $result .= $v;
        else                   $result .= "\"".addslashes($v)."\"";
        $result .= $last===$k ? $opts['eol'] : ", $opts[eol]";
        $result .= "\n";
    }
    $opts['depth']--;
    $result .= str_repeat($opts['indent'],$opts['depth']).$opts['close'];
    if ($opts['depth']===0) {
        $result .= $opts['eol'];
        if ($opts['print']) echo $result;
    }
    return $result;
}