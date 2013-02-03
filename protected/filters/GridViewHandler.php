<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GridViewHandler
 *
 * @author sanzhar
 */
class GridViewHandler extends CFilter
{
    protected function preFilter($filterChain)
    {
        if (Yii::app()->request->getIsAjaxRequest() && isset($_GET["ajax"]) && !Yii::app()->request->getIsPostRequest())
        {
            $selectedTable = $_GET["ajax"];
            $method='_getGridView'.$selectedTable;
            if(method_exists($filterChain->controller,$method))
            {
                $filterChain->controller->$method();
                Yii::app()->end();
            }
            else
            {
                throw new CHttpException(400,"CGridView handler function {$method} not defined in controller ".get_class($filterChain->controller));
            }
        }
        return true;
    }
}

?>
