<?php
//require __DIR__ . '/vendor/autoload.php';

//use Soosyze\Components\Paginate\Paginator;

//$offset = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, [ 'options' => [
//        'default'   => 0,
//        'min_range' => 0
//    ] ]);
//
//$paginator = (new Paginator('?page=:key', 200, 10, $offset))
//    ->setRule('first');

class Foo
{
    public $var = '3.14159265359';
}

$time_start = microtime(true);
for ($i = 0; $i <= 100000; $i++) {
    $a = new Foo;
    $a->self = $a;
}
$time_end = microtime(true);
$time = $time_end - $time_start;

echo 'Durée : ' . $time . ' secondes<br/>';
echo memory_get_peak_usage(), "\n";
