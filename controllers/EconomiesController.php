<?php

namespace app\controllers;

use InvalidArgumentException;
use yii\web\Controller;

class EconomiesController extends Controller
{
    /**
     * @param string $slug
     * @return string
     */
    public function actionIndex()
    {
        $dom = new \DOMDocument();
        $dom->loadXML(file_get_contents(\Yii::getAlias('@app/xml/economies.xml')));
        $xpath_economies = new \DOMXPath($dom);
        $economies_nodes = $xpath_economies->query("//economies_list/economy");

        return $this->render('index', [
            'economies' => $economies_nodes,
        ]);
    }

    /**
     * @return string
     */
    public function actionDetails($slug = 'high-tech')
    {
        $dom = new \DOMDocument();
        $dom->loadXML(file_get_contents(\Yii::getAlias('@app/xml/economies.xml')));
        $xpath_economies = new \DOMXPath($dom);
        $economies_nodes = $xpath_economies->query("//economies_list/economy");
        $file = file_get_contents(\Yii::getAlias("@app/xml/$slug.xml"));
        !$file && throw new InvalidArgumentException();
        $dom->loadXML($file);
        $xpath_import_export = new \DOMXPath($dom);
        $economy_node = $xpath_import_export->query("/root/economy")[0]; // economy name node
        $economy = $economy_node->nodeValue;
        $classes = $economy_node->attributes->getNamedItem('classes')->nodeValue; // html classes
        $import_nodes = $xpath_import_export->query("//import/commodity");
        $export_nodes = $xpath_import_export->query("//export/commodity");

        return $this->render('details', [
            'economies' => $economies_nodes,
            'economy' => $economy,
            'classes' => $classes,
            'import' => $import_nodes,
            'export' => $export_nodes
        ]);
    }
}
