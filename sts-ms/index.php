<pre>
<?php

//$m = new MongoClient(); // connect
//var_dump($m);
//$db = $m->foo;
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "Start";

$mongo = new \MongoDB\Driver\Manager('mongodb://127.0.0.1:27017/db');
var_dump($mongo);

$id           = new \MongoDB\BSON\ObjectId("588c78ce02ac660426003d87");
$filter      = ['_id' => $id];
$options = [];

// $query = new \MongoDB\Driver\Query($filter, $options);
// $rows = $mongo->executeQuery('db.translations', $query);
//
// foreach ($rows as $document) {
//   pr($document);
// }

//print_r($rows);


$listdatabases = new MongoDB\Driver\Command(["listDatabases" => 1]);
$res = $mongo->executeCommand("admin", $listdatabases);

$databases = current($res->toArray());

foreach ($databases->databases as $el) {

    echo $el->name . "\n";
}



$query = new MongoDB\Driver\Query([]);
 $rows = $mongo->executeQuery("test.cars", $query);

foreach ($rows as $row) {

    echo "$row->name : ".print_r($row, true)."\n";
}


echo "END";

phpinfo();
die();


/**
 * @author Marco Troisi
 * @created 03.04.15
 */

require 'vendor/autoload.php';

$f3 = Base::instance();

/**
 * Mongo Connection
 */
$m = new MongoClient();
$db = $m->selectDB('microtranslator');

$locale = (isset($_GET['locale'])) ? $_GET['locale'] : 'en_GB';
$mongoDictionary = new \MicroTranslator\Library\MongoDictionary($locale, $db, 'translations', 'word', 'translation');
$translator = new \Moss\Locale\Translator\Translator($locale, $mongoDictionary);

/**
 * Translation Service
 */
$translationService = new \MicroTranslator\Service\Translation(
    new \MicroTranslator\Repository\Translation($db),
    $translator
);

/**
 * Controllers
 */
$localeController = new \MicroTranslator\Controller\LocaleController($translationService);
$translationController = new \MicroTranslator\Controller\TranslationController($translationService);

/**
 * Routes
 */

// Home
$f3->route('GET /',
    function() use ($translationService) {
        echo 'MicroTranslator';
    }
);

// Gets All Available Locales
$f3->route('GET /locale',
    function() use ($localeController) {
        return $localeController->showAllAvailable();
    }
);

// Gets All Terms
$f3->route('GET /translation',
    function($f3, $params) use ($translationController) {
        return $translationController->show();
    }
);

// Gets or inserts/updates a Term for a specific Locale
$f3->route('GET|POST /translation/@word',
    function($f3, $params) use ($translationController, $locale) {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $translation = $f3->get('POST.translation');
            $word = $params['word'];

            return $translationController->save($word, $locale, $translation);
        }

        return $translationController->show($locale, $params['word']);
    }
);

// Gets Untranslated Terms for a specific Locale

/**
 * Run F3 Application
 */
$f3->run();
