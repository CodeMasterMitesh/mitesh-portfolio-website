<?php

require_once 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

session_start();
ini_set('display_errors', 1);
$timezone = 'Asia/Calcutta';

//if (function_exists('date_default_timezone_set'))
date_default_timezone_set($timezone);
$error = '';
if ($_SERVER['HTTP_HOST'] == 'localhost') {
    //mysql_connect("localhost", "root", "root");
    //mysql_select_db("miteshprajapati");
} else {
    //mysql_connect("localhost", "root", "root");
    //mysql_select_db("miteshprajapati");
}

//$clink = new mysqli("localhost","","", "miteshprajapati");

if (!function_exists('mysql_query')) {
    $clink = mysqli_connect(
        $_ENV['DB_HOST'],
        $_ENV['DB_USERNAME'],
        $_ENV['DB_PASSWORD'],
        $_ENV['DB_DATABASE']
    );
    // $clink = mysqli_connect("localhost", "root", "", "miteshprajapati");
    function mysql_query($str)
    {
        global $clink;
        return mysqli_query($clink, $str);
    }
    function mysql_fetch_assoc($str)
    {
        global $clink;
        return mysqli_fetch_assoc($str);
    }

    function mysql_fetch_array($str)
    {
        global $clink;
        return mysqli_fetch_array($str);
    }

    function mysql_fetch_row($str)
    {
        global $clink;
        return mysqli_fetch_row($str);
    }

    function mysql_error()
    {
        global $clink;
        return mysqli_error($clink);
    }

    function mysql_num_fields($str)
    {
        global $clink;
        return mysqli_num_fields($str);
    }
    function mysql_num_rows($str)
    {
        global $clink;
        return mysqli_num_rows($str);
    }
    function mysql_insert_id()
    {
        global $clink;
        return mysqli_insert_id($clink);
    }

    function mysql_escape_string($str)
    {
        global $clink;
        return mysqli_escape_string($clink, $str);
    }
    function mysql_real_escape_string($str)
    {
        global $clink;
        return mysqli_real_escape_string($clink, $str);
    }
} else {
    mysqli_connect('localhost', 'root', '');
    mysqli_select_db($connect, 'miteshprajapati');
}

mysql_query('SET SESSION sql_mode="NO_ENGINE_SUBSTITUTION"');
mysql_query('SET GLOBAL sql_mode="NO_ENGINE_SUBSTITUTION"');
mysql_query("SET time_zone = '+5:30'") or die(mysql_error());
mysql_query("SET SESSION time_zone = '+5:30'") or die(mysql_error());
$months = [
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
    'July ',
    'August',
    'September',
    'October',
    'November',
    'December',
];

function getcur($price)
{
    $sql =
        "select * from currency where type like '" .
        $_SESSION['currency'] .
        "' order by date desc";
    ($q = mysql_query($sql)) or die(mysql_error() . $sql);
    $r = mysql_fetch_assoc($q);
    $symb = '₹'; //₹
    if ($_SESSION['currency'] == 'USD') {
        $symb = '$';
    }
    if ($_SESSION['currency'] == 'AUD') {
        $symb = '$';
    }
    if ($_SESSION['currency'] == 'JPY') {
        $symb = '¥';
    }
    if ($_SESSION['currency'] == 'GBP') {
        $symb = '£';
    }
    if ($_SESSION['currency'] == 'SGD') {
        $symb = 'S$';
    }
    if ($_SESSION['currency'] == 'EUR') {
        $symb = '€';
    }
    $price = round($price / $r['inr']);
    return '<span class="woocommerce-Price-currencySymbol"> ' .
        $symb .
        '</span> ' .
        $price;
}
function resize_image($file, $w, $h, $crop = false)
{
    list($width, $height) = getimagesize($file);
    $r = $width / $height;
    if ($crop) {
        if ($width > $height) {
            $width = ceil($width - $width * abs($r - $w / $h));
        } else {
            $height = ceil($height - $height * abs($r - $w / $h));
        }
        $newwidth = $w;
        $newheight = $h;
    } else {
        if ($w / $h > $r) {
            $newwidth = $h * $r;
            $newheight = $h;
        } else {
            $newheight = $w / $r;
            $newwidth = $w;
        }
    }
    $src = imagecreatefromjpeg($file);
    $dst = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresampled(
        $dst,
        $src,
        0,
        0,
        0,
        0,
        $newwidth,
        $newheight,
        $width,
        $height
    );

    return $dst;
}

function resize_imagejpg($file, $w, $h)
{
    list($width, $height) = getimagesize($file);
    $src = imagecreatefromjpeg($file);
    $dst = imagecreatetruecolor($w, $h);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $w, $h, $width, $height);
    return $dst;
}

// for png
function resize_imagepng($file, $w, $h)
{
    list($width, $height) = getimagesize($file);
    $src = imagecreatefrompng($file);
    $dst = imagecreatetruecolor($w, $h);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $w, $h, $width, $height);
    return $dst;
}

// for gif
function resize_imagegif($file, $w, $h)
{
    list($width, $height) = getimagesize($file);
    $src = imagecreatefromgif($file);
    $dst = imagecreatetruecolor($w, $h);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $w, $h, $width, $height);
    return $dst;
}

function formatInIndianStyle($num)
{
    $pos = strpos((string) $num, '.');
    if ($pos === false) {
        $decimalpart = '00';
    }
    if (!($pos === false)) {
        $decimalpart = substr($num, $pos + 1, 2);
        $num = substr($num, 0, $pos);
    }

    if ((strlen($num) > 3) & (strlen($num) <= 12)) {
        $last3digits = substr($num, -3);
        $numexceptlastdigits = substr($num, 0, -3);
        $formatted = makeComma($numexceptlastdigits);
        $stringtoreturn = $formatted . ',' . $last3digits . '.' . $decimalpart;
    } elseif (strlen($num) <= 3) {
        $stringtoreturn = $num . '.' . $decimalpart;
    } elseif (strlen($num) > 12) {
        $stringtoreturn = number_format($num, 2);
    }
    if (substr($stringtoreturn, 0, 2) == '-,') {
        $stringtoreturn = '-' . substr($stringtoreturn, 2);
    }
    return $stringtoreturn;
}

function makeComma($input)
{
    if (strlen($input) <= 2) {
        return $input;
    }
    $length = substr($input, 0, strlen($input) - 2);
    $formatted_input = makeComma($length) . ',' . substr($input, -2);
    return $formatted_input;
}

$page = array_reverse(explode('/', $_SERVER['PHP_SELF']));
if (isset($_GET['logout'])) {
    if ($_GET['logout'] == 'yes') {
        unset($_SESSION);
        session_destroy();
        session_unset();
        header('Location:index.php');
    }
}

function selectopt($opt, $val)
{
    if ($opt == $val) {
        echo ' selected="selected" ';
    }
}

function os($uid)
{
    $sql1 = "select sum(price) from orders where cid='" . $uid . "'";
    ($q1 = mysql_query($sql1)) or die(mysql_error() . $sql1);
    $r2 = mysql_fetch_row($q1);
    $sql1 = "select sum(amount) from `credit` where cname like '" . $uid . "'";
    ($q1 = mysql_query($sql1)) or die(mysql_error() . $sql1);
    $r3 = mysql_fetch_row($q1);
    return $r3[0] - $r2[0];
}

function getdata($url, $fields)
{
    //url-ify the data for the POST
    $fields_string = " ";
    foreach ($fields as $key => $value) {
        $fields_string .= $key . '=' . urlencode($value) . '&';
    }
    rtrim($fields_string, '&');
    //open connection

    $ch = curl_init();
    //set the url, number of POST vars, POST data
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, count($fields));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    //execute post
    $result = curl_exec($ch);
    //close connection
    curl_close($ch);
    return $result;
}

function getoptn(
    $cname,
    $text,
    $value,
    $dbt,
    $class = '',
    $mult = '',
    $selectedvalue = '',
    $all = ''
) {
    $sql =
        'SELECT ' .
        $text .
        ',' .
        $value .
        ' FROM ' .
        $dbt .
        ' order by ' .
        $text;

    ($q = mysql_query($sql)) or die(mysql_error());

    $data = "<select name=\"$cname\" class=\"$class\" $mult>";

    if ($all == 'All') {
        $data .= '<option value="%%">' . $all . '</option>';
    } elseif ($all == 'None') {
        $data .= '<option value="">' . $all . '</option>';
    } else {
        $data .= '';
    }
    while ($row = mysql_fetch_array($q)) {
        if ($selectedvalue == $row[$value]) {
            $data .=
                '<option  value="' .
                $row[$value] .
                '" selected="selected">' .
                $row[$text] .
                '</option>';
        } else {
            $data .=
                '<option  value="' .
                $row[$value] .
                '">' .
                $row[$text] .
                '</option>';
        }
    }

    $data .= '</select>';

    return $data;
}

function getcol($db, $setcol, $setval, $getcol)
{
    $sql =
        'SELECT ' .
        $getcol .
        ' FROM `' .
        $db .
        '` where `' .
        $setcol .
        "`='" .
        $setval .
        "'";

    ($q = mysql_query($sql)) or die(mysql_error() . $sql);

    $row = mysql_fetch_array($q);

    return $row[$getcol];
}

function getcoldetail($db, $setcol, $setval, $getcol, $getcol1, $setcol1)
{
    $sql =
        'SELECT ' .
        $getcol .
        ' FROM ' .
        $db .
        ' where ' .
        $setcol .
        " = '" .
        $setval .
        "' and " .
        $getcol1 .
        " = '" .
        $setcol1 .
        "'";

    ($q = mysql_query($sql)) or die(mysql_error() . $sql);

    $row = mysql_fetch_array($q);

    return $row[$getcol];
}

function sopt($slname, $sloption)
{
    if ($slname == $sloption) {
        echo 'selected="selected"';
    }
}

function xTimeAgo($oldTime, $newTime, $timeType)
{
    $timeCalc = time() - strtotime($newTime); //strtotime($newTime)

    if ($timeType == 'x') {
        if ($timeCalc <= 60) {
            $timeType = 's';
        } elseif ($timeCalc <= 60 * 60) {
            $timeType = 'm';
        } elseif ($timeCalc <= 60 * 60 * 24) {
            $timeType = 'h';
        } else {
            $timeType = 'd';
        }
    }
    if ($timeType == 's') {
        $timeCalc .= ' seconds ago';
    }
    if ($timeType == 'm') {
        $timeCalc = round($timeCalc / 60) . ' minutes ago';
    }
    if ($timeType == 'h') {
        $timeCalc = round($timeCalc / 60 / 60) . ' hours ago';
    }
    if ($timeType == 'd') {
        $timeCalc = round($timeCalc / 60 / 60 / 24) . ' days ago';
    }
    return $timeCalc;
}

function GDD($sStartDate, $sEndDate)
{
    $sStartDate = gmdate('Y-m-d', strtotime($sStartDate));

    $sEndDate = gmdate('Y-m-d', strtotime($sEndDate));

    $aDays[] = $sStartDate;

    $sCurrentDate = $sStartDate;

    while ($sCurrentDate < $sEndDate) {
        $sCurrentDate = gmdate(
            'Y-m-d',
            strtotime('+1 day', strtotime($sCurrentDate))
        );

        $aDays[] = $sCurrentDate;
    }
    return $aDays;
}

function dpt()
{
    $str = $_SESSION['udata']['department'];
    if ($str == 'Technical') {
        return 1;
    }
    if ($str == 'Account') {
        return 2;
    }
    if ($str == 'Sales') {
        return 3;
    }
    if ($str == 'HR') {
        return 4;
    }
    if ($str == 'Management') {
        return 5;
    }
    if ($str == 'Service') {
        return 6;
    }
    if ($str == 'Admin') {
        return 7;
    }
}

function debug($str)
{
    echo '<pre>';
    print_r($str);
    echo '</pre>';
}

function getTextBetweenTags($string, $tagname)
{
    $pattern = "/<$tagname>([\w\W]*?)<\/$tagname>/";
    preg_match($pattern, $string, $matches);
    return $matches[1];
}

function dmy2mysql($input)
{
    $output = false;
    $d = preg_split('#[-/:. ]#', $input);
    if (is_array($d) && count($d) >= 3) {
        if (
            checkdate($d[1], $d[0], $d[2]) ||
            ($d[0] == '00' && $d[1] == '00')
        ) {
            $output = "$d[2]-$d[1]-$d[0]";
        }
        if ($d[3]) {
            $output .= ' ' . $d[3] . ':' . $d[4];
        }
    }
    return $output;
}

function mysql2dmy($input)
{
    $output = false;
    $input1 = $input;
    $input = substr($input, 0, 10);
    $d = explode('-', $input);
    if (is_array($d) && count($d) >= 3) {
        if (
            checkdate($d[1], $d[2], $d[0]) ||
            ($d[2] == '00' && $d[1] == '00')
        ) {
            $output = "$d[2]/$d[1]/$d[0]";
        }
        if (substr($input1, 11)) {
            $output .= ' ' . substr($input1, 11);
        }
    }
    return $output;
}

//products and categories tree view

function getuser($id)
{
    $sql = "select * from users where id='" . $id . "'";
    $q = mysql_query($sql);
    $r = mysql_fetch_assoc($q);
    return $r;
}

function getpeople($id)
{
    $sql = "select * from people where id='" . $id . "'";
    $q = mysql_query($sql);
    $r = mysql_fetch_assoc($q);
    return $r;
}

function getclient($id)
{
    $sql = "select * from clients where id='" . $id . "'";
    ($q = mysql_query($sql)) or die(mysql_error());
    $r = mysql_fetch_assoc($q);
    return $r;
}

function getdboy($id)
{
    $sql = "select * from dboy where id='" . $id . "'";
    ($q = mysql_query($sql)) or die(mysql_error());
    $r = mysql_fetch_assoc($q);
    return $r;
}

function getdboybyarea($area)
{
    $sql = "select * from dboy where ToLB like '%" . $area . "%'";
    ($q = mysql_query($sql)) or die(mysql_error());
    $r = mysql_fetch_assoc($q);
    return $r;
}

function runSQL($rsql)
{
    $db['default']['hostname'] = 'localhost';
    $db['default']['username'] = 'root';
    $db['default']['password'] = 'jigarshah89';
    $db['default']['database'] = 'ijs';

    $db['live']['hostname'] = 'localhost';
    $db['live']['username'] = '';
    $db['live']['password'] = '';
    $db['live']['database'] = '';

    $active_group = 'default';

    $base_url = 'http://' . $_SERVER['HTTP_HOST'];
    $base_url .= str_replace(
        basename($_SERVER['SCRIPT_NAME']),
        '',
        $_SERVER['SCRIPT_NAME']
    );

    ($connect = mysqli_connect(
        $db[$active_group]['hostname'],
        $db[$active_group]['username'],
        $db[$active_group]['password']
    )) or die('Error: could not connect to database');
    $db = mysqli_select_db($connect, $db[$active_group]['database']);

    ($result = mysql_query($rsql)) or die($rsql);
    return $result;
    mysqli_close($connect);
}

function countRec($fname, $tname)
{
    $sql = "SELECT count($fname) FROM $tname ";
    $result = runSQL($sql);
    while ($row = mysql_fetch_array($result)) {
        return $row[0];
    }
}

function constructWhere($s)
{
    $qwery = '';
    //['eq','ne','lt','le','gt','ge','bw','bn','in','ni','ew','en','cn','nc']
    $qopers = [
        'eq' => ' = ',
        'ne' => ' <> ',
        'lt' => ' < ',
        'le' => ' <= ',
        'gt' => ' > ',
        'ge' => ' >= ',
        'bw' => ' LIKE ',
        'bn' => ' NOT LIKE ',
        'in' => ' IN ',
        'ni' => ' NOT IN ',
        'ew' => ' LIKE ',
        'en' => ' NOT LIKE ',
        'cn' => ' LIKE ',
        'nc' => ' NOT LIKE ',
    ];
    if ($s) {
        $jsona = json_decode($s, true);
        if (is_array($jsona)) {
            $gopr = $jsona['groupOp'];
            $rules = $jsona['rules'];
            $i = 0;
            foreach ($rules as $key => $val) {
                $field = $val['field'];
                $op = $val['op'];
                $v = $val['data'];
                if ($v && $op) {
                    $i++;
                    // ToSql in this case is absolutley needed
                    $v = ToSql($field, $op, $v);
                    if ($i == 1) {
                        $qwery = ' AND ';
                    } else {
                        $qwery .= ' ' . $gopr . ' ';
                    }
                    switch ($op) {
                            // in need other thing
                        case 'in':
                        case 'ni':
                            $qwery .= $field . $qopers[$op] . ' (' . $v . ')';
                            break;
                        default:
                            $qwery .= $field . $qopers[$op] . $v;
                    }
                }
            }
        }
    }
    return $qwery;
}

function getStringForGroup($group)
{
    $i_ = '';
    $sopt = [
        'eq' => '=',
        'ne' => '<>',
        'lt' => '<',
        'le' => '<=',
        'gt' => '>',
        'ge' => '>=',
        'bw' => " {$i_}LIKE ",
        'bn' => " NOT {$i_}LIKE ",
        'in' => ' IN ',
        'ni' => ' NOT IN',
        'ew' => " {$i_}LIKE ",
        'en' => " NOT {$i_}LIKE ",
        'cn' => " {$i_}LIKE ",
        'nc' => " NOT {$i_}LIKE ",
        'nu' => 'IS NULL',
        'nn' => 'IS NOT NULL',
    ];
    $s = '(';
    if (
        isset($group['groups']) &&
        is_array($group['groups']) &&
        count($group['groups']) > 0
    ) {
        for ($j = 0; $j < count($group['groups']); $j++) {
            if (strlen($s) > 1) {
                $s .= ' ' . $group['groupOp'] . ' ';
            }
            try {
                $dat = getStringForGroup($group['groups'][$j]);
                $s .= $dat;
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
    }
    // debug($jsona);
    if (isset($group['rules']) && count($group['rules']) > 0) {
        try {
            foreach ($group['rules'] as $key => $val) {
                if (strlen($s) > 1) {
                    $s .= ' ' . $group['groupOp'] . ' ';
                }
                $field = $val['field'];
                $op = $val['op'];
                $v = $val['data'];
                if ($op) {
                    switch ($op) {
                        case 'bw':
                        case 'bn':
                            $s .= $field . ' ' . $sopt[$op] . "'$v%'";
                            break;
                        case 'ew':
                        case 'en':
                            $s .= $field . ' ' . $sopt[$op] . "'%$v'";
                            break;
                        case 'cn':
                        case 'nc':
                            $s .= $field . ' ' . $sopt[$op] . "'%$v%'";
                            break;
                        case 'in':
                        case 'ni':
                            $s .= $field . ' ' . $sopt[$op] . "( '$v' )";
                            break;
                        case 'nu':
                        case 'nn':
                            $s .= $field . ' ' . $sopt[$op] . ' ';
                            break;
                        default:
                            $s .= $field . ' ' . $sopt[$op] . " '$v' ";
                            break;
                    }
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    $s .= ')';
    if ($s == '()') {
        //return array("",$prm); // ignore groups that don't have rules
        return ' 1=1 ';
    } else {
        return $s;
    }
}


function array_is_associative($array)
{
    if (is_array($array) && !empty($array)) {
        for ($iterator = count($array) - 1; $iterator; $iterator--) {
            if (!array_key_exists($iterator, $array)) {
                return true;
            }
        }
        return !array_key_exists(0, $array);
    }
    return false;
}

function numbertotext($number)
{
    if ($number < 0 || $number > 999999999) {
        throw new Exception('Number is out of range');
    }

    $Gn = floor($number / 1000000); /* Millions (giga) */
    $number -= $Gn * 1000000;
    $kn = floor($number / 1000); /* Thousands (kilo) */
    $number -= $kn * 1000;
    $Hn = floor($number / 100); /* Hundreds (hecto) */
    $number -= $Hn * 100;
    $Dn = floor($number / 10); /* Tens (deca) */
    $n = $number % 10; /* Ones */

    $res = '';

    if ($Gn) {
        $res .= numbertotext($Gn) . ' Million';
    }

    if ($kn) {
        $res .= (empty($res) ? '' : ' ') . numbertotext($kn) . ' Thousand';
    }

    if ($Hn) {
        $res .= (empty($res) ? '' : ' ') . numbertotext($Hn) . ' Hundred';
    }

    $ones = [
        '',
        'One',
        'Two',
        'Three',
        'Four',
        'Five',
        'Six',
        'Seven',
        'Eight',
        'Nine',
        'Ten',
        'Eleven',
        'Twelve',
        'Thirteen',
        'Fourteen',
        'Fifteen',
        'Sixteen',
        'Seventeen',
        'Eightteen',
        'Nineteen',
    ];
    $tens = [
        '',
        '',
        'Twenty',
        'Thirty',
        'Fourty',
        'Fifty',
        'Sixty',
        'Seventy',
        'Eigthy',
        'Ninety',
    ];

    if ($Dn || $n) {
        if (!empty($res)) {
            $res .= ' and ';
        }

        if ($Dn < 2) {
            $res .= $ones[$Dn * 10 + $n];
        } else {
            $res .= $tens[$Dn];

            if ($n) {
                $res .= '-' . $ones[$n];
            }
        }
    }

    if (empty($res)) {
        $res = 'zero';
    }

    return $res;
}

function xml2array($contents, $get_attributes = 1, $priority = 'tag')
{
    if (!$contents) {
        return [];
    }

    if (!function_exists('xml_parser_create')) {
        //print "'xml_parser_create()' function not found!";
        return [];
    }

    //Get the XML parser of PHP - PHP must have this module for the parser to work
    $parser = xml_parser_create('');
    xml_parser_set_option($parser, XML_OPTION_TARGET_ENCODING, 'UTF-8'); # http://minutillo.com/steve/weblog/2004/6/17/php-xml-and-character-encodings-a-tale-of-sadness-rage-and-data-loss
    xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
    xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
    xml_parse_into_struct($parser, trim($contents), $xml_values);
    xml_parser_free($parser);

    if (!$xml_values) {
        return;
    } //Hmm...

    //Initializations
    $xml_array = [];
    $parents = [];
    $opened_tags = [];
    $arr = [];

    $current = &$xml_array; //Refference
    //Go through the tags.
    $repeated_tag_index = []; //Multiple tags with same name will be turned into an array
    foreach ($xml_values as $data) {
        unset($attributes, $value); //Remove existing values, or there will be trouble
        //This command will extract these variables into the foreach scope
        // tag(string), type(string), level(int), attributes(array).
        extract($data); //We could use the array by itself, but this cooler.

        $result = [];
        $attributes_data = [];

        if (isset($value)) {
            if ($priority == 'tag') {
                $result = $value;
            } else {
                $result['value'] = $value;
            } //Put the value in a assoc array if we are in the 'Attribute' mode
        }

        //Set the attributes too.
        if (isset($attributes) and $get_attributes) {
            foreach ($attributes as $attr => $val) {
                if ($priority == 'tag') {
                    $attributes_data[$attr] = $val;
                } else {
                    $result['attr'][$attr] = $val;
                } //Set all the attributes in a array called 'attr'
            }
        }

        //See tag status and do the needed.
        if ($type == 'open') {
            //The starting of the tag '<tag>'
            $parent[$level - 1] = &$current;
            if (!is_array($current) or !in_array($tag, array_keys($current))) {
                //Insert New tag
                $current[$tag] = $result;
                if ($attributes_data) {
                    $current[$tag . '_attr'] = $attributes_data;
                }
                $repeated_tag_index[$tag . '_' . $level] = 1;

                $current = &$current[$tag];
            } else {
                //There was another element with the same tag name
                if (isset($current[$tag][0])) {
                    //If there is a 0th element it is already an array
                    $current[$tag][$repeated_tag_index[$tag . '_' . $level]] = $result;
                    $repeated_tag_index[$tag . '_' . $level]++;
                } else {
                    //This section will make the value an array if multiple tags with the same name appear together
                    $current[$tag] = [$current[$tag], $result]; //This will combine the existing item and the new item together to make an array
                    $repeated_tag_index[$tag . '_' . $level] = 2;

                    if (isset($current[$tag . '_attr'])) {
                        //The attribute of the last(0th) tag must be moved as well
                        $current[$tag]['0_attr'] = $current[$tag . '_attr'];
                        unset($current[$tag . '_attr']);
                    }
                }
                $last_item_index = $repeated_tag_index[$tag . '_' . $level] - 1;
                $current = &$current[$tag][$last_item_index];
            }
        } elseif ($type == 'complete') {
            //Tags that ends in 1 line '<tag />'
            //See if the key is already taken.
            if (!isset($current[$tag])) {
                //New Key
                $current[$tag] = $result;
                $repeated_tag_index[$tag . '_' . $level] = 1;
                if ($priority == 'tag' and $attributes_data) {
                    $current[$tag . '_attr'] = $attributes_data;
                }
            } else {
                //If taken, put all things inside a list(array)
                if (isset($current[$tag][0]) and is_array($current[$tag])) {
                    //If it is already an array...
                    // ...push the new element into that array.
                    $current[$tag][$repeated_tag_index[$tag . '_' . $level]] = $result;

                    if (
                        $priority == 'tag' and
                        $get_attributes and
                        $attributes_data
                    ) {
                        $current[$tag][$repeated_tag_index[$tag . '_' . $level] . '_attr'] = $attributes_data;
                    }
                    $repeated_tag_index[$tag . '_' . $level]++;
                } else {
                    //If it is not an array...
                    $current[$tag] = [$current[$tag], $result]; //...Make it an array using using the existing value and the new value
                    $repeated_tag_index[$tag . '_' . $level] = 1;
                    if ($priority == 'tag' and $get_attributes) {
                        if (isset($current[$tag . '_attr'])) {
                            //The attribute of the last(0th) tag must be moved as well
                            $current[$tag]['0_attr'] = $current[$tag . '_attr'];
                            unset($current[$tag . '_attr']);
                        }

                        if ($attributes_data) {
                            $current[$tag][$repeated_tag_index[$tag . '_' . $level] .
                                '_attr'] = $attributes_data;
                        }
                    }
                    $repeated_tag_index[$tag . '_' . $level]++; //0 and 1 index is already taken
                }
            }
        } elseif ($type == 'close') {
            //End of tag '</tag>'
            $current = &$parent[$level - 1];
        }
    }

    return $xml_array;
}

##imap funcations

function flattenParts(
    $messageParts,
    $flattenedParts = [],
    $prefix = '',
    $index = 1,
    $fullPrefix = true
) {
    foreach ($messageParts as $part) {
        $flattenedParts[$prefix . $index] = $part;
        if (isset($part->parts)) {
            if ($part->type == 2) {
                $flattenedParts = flattenParts(
                    $part->parts,
                    $flattenedParts,
                    $prefix . $index . '.',
                    0,
                    false
                );
            } elseif ($fullPrefix) {
                $flattenedParts = flattenParts(
                    $part->parts,
                    $flattenedParts,
                    $prefix . $index . '.'
                );
            } else {
                $flattenedParts = flattenParts(
                    $part->parts,
                    $flattenedParts,
                    $prefix
                );
            }
            unset($flattenedParts[$prefix . $index]->parts);
        }
        $index++;
    }

    return $flattenedParts;
}

function getPart($connection, $messageNumber, $partNumber, $encoding)
{
    $data = imap_fetchbody($connection, $messageNumber, $partNumber);
    switch ($encoding) {
        case 0:
            return $data; // 7BIT
        case 1:
            return $data; // 8BIT
        case 2:
            return $data; // BINARY
        case 3:
            return base64_decode($data); // BASE64
        case 4:
            return quoted_printable_decode($data); // QUOTED_PRINTABLE
        case 5:
            return $data; // OTHER
    }
}

function getFilenameFromPart($part)
{
    $filename = '';

    if ($part->ifdparameters) {
        foreach ($part->dparameters as $object) {
            if (strtolower($object->attribute) == 'filename') {
                $filename = $object->value;
            }
        }
    }

    if (!$filename && $part->ifparameters) {
        foreach ($part->parameters as $object) {
            if (strtolower($object->attribute) == 'name') {
                $filename = $object->value;
            }
        }
    }

    return $filename;
}

function getenvvar($str)
{
    ($myfile = fopen('.env', 'r')) or die('Unable to open file!');
    $data = fread($myfile, filesize('.env'));
    fclose($myfile);
    $lines = explode("\r\n", $data);
    $var = [];
    foreach ($lines as $l) {
        $d = explode('=', $l);
        $var[trim($d[0])] = trim($d[1]);
    }
    return $var[$str];
}
