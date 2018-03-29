<?php
session_start();
date_default_timezone_set('America/Santiago');

require_once($path_."/mysql_class.php");

class Charts{
    
    public $con = null;
    
    public function __construct(){
        $this->con = new Conexion();
    }
    
    public function render(){
        $accion = $_POST['accion'];
        if($accion == "llamados"){
            return $this->llamados();
        }
        if($accion == "sample2"){
            return $this->sample2();
        }
        if($accion == "sample3"){
            return $this->sample3();
        }
        if($accion == "sample4"){
            return $this->sample4();
        }
    }
    
    private function crear_grafico(){
        
        $conf['type'] = 'line';
        $conf['title'] = 'Buena Nelson';
        $conf['subtitle'] = 'Buena Nelson';
        $this->get_code($conf);
        
        
    }
    
    private function get_code($conf){
        
        if(isset($conf['type'])){
            $info['chart']['chart']['type'] = $conf['type'];
        }
        if(isset($conf['title'])){
            $info['chart']['title']['text'] = 'Solar Employment Growth by Sector, 2010-2016';
        }
        if(isset($conf['subtitle'])){
            $info['chart']['subtitle']['text'] = 'Source: thesolarfoundation.com';
        }
        return $info;
        
    }
    private function responsive($type){
        
        if($type == 1){
            $aux['rules'][0]['condition']['maxWidth'] = 500;
            $aux['rules'][0]['chartOptions']['legend']['layout'] = 'horizontal';
            $aux['rules'][0]['chartOptions']['legend']['align'] = 'center';
            $aux['rules'][0]['chartOptions']['legend']['verticalAlign'] = 'bottom';
        }
        return $aux;
    }
    private function get_series($type){
        if($type == 1){
            $info[0]['name'] = 'Installation';
            $info[0]['data'] = Array(43934, 52503, 57177, 69658, 97031, 119931, 137133, 154175);
            $info[1]['name'] = 'Manufacturing';
            $info[1]['data'] = Array(24916, 24064, 29742, 29851, 32490, 30282, 38121, 40434);
            $info[2]['name'] = 'Sales & Distribution';
            $info[2]['data'] = Array(11744, 17722, 16005, 19771, 20185, 24377, 32147, 39387);
            $info[3]['name'] = 'Project Development';
            $info[3]['data'] = Array(null, null, 7988, 12169, 15112, 22452, 34400, 34227);
            $info[4]['name'] = 'Other';
            $info[4]['data'] = Array(12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111);
        }
        if($type == 2){
            $info[0]['name'] = 'Tokyo';
            $info[0]['data'] = Array(7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6);
            $info[1]['name'] = 'London';
            $info[1]['data'] = Array(0.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8);
        }
        if($type == 3){
            $info[0]['name'] = 'Tokyo';
            $info[0]['colorByPoint'] = true;

            $info[0]['data'][0]['name'] = 'IE';
            $info[0]['data'][0]['y'] = 56.33;
            $info[0]['data'][0]['color'] = '#000';

            $info[0]['data'][1]['name'] = 'Chrome';
            $info[0]['data'][1]['y'] = 24.03;
            $info[0]['data'][1]['color'] = '#333';
            $info[0]['data'][1]['sliced'] = true;
            $info[0]['data'][1]['selected'] = true;

            $info[0]['data'][2]['name'] = 'Firefox';
            $info[0]['data'][2]['y'] = 10.38;

            $info[0]['data'][3]['name'] = 'Safari';
            $info[0]['data'][3]['y'] = 4.77;

            $info[0]['data'][4]['name'] = 'Opera';
            $info[0]['data'][4]['y'] = 0.91;

            $info[0]['data'][5]['name'] = 'Other';
            $info[0]['data'][5]['y'] = 0.2;
        }
        return $info;
    }
    private function get_plotoptions($type){
        if($type == 1){
            $info['series']['label']['connectorAllowed'] = false;
            $info['series']['pointStart'] = 2010;
        }
        if($type == 2){
            $info['line']['dataLabels']['enabled'] = true;
            $info['line']['enableMouseTracking'] = false;
        }
        return $info;
    }
    private function get_xAxis_category($type){
        if($type == 1){
            $info['categories'] = Array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
        }
        return $info;
    }
    
    
    
    private function llamados(){
        
        /* POSTS */
        $f_ini = $_POST['f_ini'];
        $f_fin = $_POST['f_fin'];
        $tipo = $_POST['tipo'];
        
        
        /* CONFIG */
        $type = '';
        $title = 'Llamados';
        
        $yAxis_title = 'Buena Ernertor';
        /* CONFIG */
        
        
        if($tipo == 1){
            
            $subtitle = 'Porcentaje de Llamados';
            
            $leyend['layout'] = 'vertical';
            $leyend['align'] = 'right';
            $leyend['verticalAlign'] = 'middle';
            $info['chart']['legend'] = (isset($leyend)) ? $leyend : '';
            
            $info['chart']['plotOptions'] = $this->get_plotoptions(1);
            $info['chart']['series'] = $this->get_series(1);
            $info['chart']['responsive'] = $this->responsive(1);
            
        }
        if($tipo == 2){
            
            $subtitle = 'Lineas Acumuladas';
            
            $info['chart']['plotOptions'] = $this->get_plotoptions(2);
            $info['chart']['xAxis'] = $this->get_xAxis_category(1);
            $info['chart']['series'] = $this->get_series(2);
            
        }
        if($tipo == 3){
            
            $subtitle = 'Total Actos';
            
            $type = 'pie';
            $info['chart']['chart']['plotBackgroundColor'] = null;
            $info['chart']['chart']['plotBorderWidth'] = null;
            $info['chart']['chart']['plotShadow'] = false;
            $info['chart']['title']['text'] = 'Monthly Average Temperature';
            $info['chart']['tooltip']['pointFormat'] = '{series.name}: <b>{point.percentage:.1f}%</b>';

            $info['chart']['plotOptions']['pie']['allowPointSelect'] = true;
            $info['chart']['plotOptions']['pie']['cursor'] = 'pointer';
            $info['chart']['plotOptions']['pie']['dataLabels']['enabled'] = true;
            $info['chart']['plotOptions']['pie']['dataLabels']['format'] = '<b>{point.name}</b>: {point.percentage:.1f} %';
            $info['chart']['series'] = $this->get_series(3);
            
        }
        
        $info['chart']['chart']['type'] = ($type != '') ? $type : null;
        $info['chart']['title']['text'] = ($title != '') ? $title : null;
        $info['chart']['subtitle']['text'] = ($subtitle != '') ? $subtitle : null;
        $info['chart']['yAxis']['title']['text'] = ($yAxis_title != '') ? $yAxis_title : null;
        
        return $info;
        
    }
    private function sample2(){
        
        /* CONFIG */
        $type = '';
        $title = 'Diegomez Analitics';
        $subtitle = 'Buena Ernertor';
        $yAxis_title = 'Buena Ernertor';
        /* CONFIG */
        
        $info['chart']['chart']['type'] = ($type != '') ? $type : null;
        $info['chart']['title']['text'] = ($title != '') ? $title : null;
        $info['chart']['subtitle']['text'] = ($subtitle != '') ? $subtitle : null;
        $info['chart']['yAxis']['title']['text'] = ($yAxis_title != '') ? $yAxis_title : null;
        $info['chart']['plotOptions'] = $this->get_plotoptions(2);
        
        $info['chart']['xAxis'] = $this->get_xAxis_category(1);
        $info['chart']['series'] = $this->get_series(2);
        //$info['chart']['responsive'] = $this->responsive(1);
        
        $info['op'] = 1;
        return $info;
        
    }
    private function sample3(){
        
        $info['op'] = 1;
        $info['chart']['chart']['type'] = 'pie';
        $info['chart']['chart']['plotBackgroundColor'] = null;
        $info['chart']['chart']['plotBorderWidth'] = null;
        $info['chart']['chart']['plotShadow'] = false;
        
        
        $info['chart']['title']['text'] = 'Monthly Average Temperature';
        $info['chart']['tooltip']['pointFormat'] = '{series.name}: <b>{point.percentage:.1f}%</b>';
        
        $info['chart']['plotOptions']['pie']['allowPointSelect'] = true;
        $info['chart']['plotOptions']['pie']['cursor'] = 'pointer';
        $info['chart']['plotOptions']['pie']['dataLabels']['enabled'] = true;
        $info['chart']['plotOptions']['pie']['dataLabels']['format'] = '<b>{point.name}</b>: {point.percentage:.1f} %';
        
        $info['chart']['series'] = $this->get_series(3);
        

        
        return $info;
        
    }
    private function sample4(){
        
        $info['op'] = 1;
        
        $info['chart']['chart']['type'] = 'column';
        $info['chart']['chart']['backgroundColor'] = 'rgba(255, 255, 255, 0.0)';
        $info['chart']['chart']['options3d']['enabled'] = true;
        $info['chart']['chart']['options3d']['alpha'] = 10;
        $info['chart']['chart']['options3d']['beta'] = 25;
        $info['chart']['chart']['options3d']['depth'] = 70;
        
        
        $info['chart']['title']['text'] = '3D chart with null values';
        //$info['chart']['subtitle']['text'] = 'Notice the difference between a 0 value and a null point';
        
        $info['chart']['legend']['enabled'] = false;
        $info['chart']['plotOptions']['column']['depth'] = 25;
        $info['chart']['xAxis']['categories'] = Array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
        
        $info['chart']['xAxis']['labels']['skew3d'] = true;
        $info['chart']['xAxis']['labels']['style']['fontSize'] = '1em';
        
        $info['chart']['yAxis']['title']['text'] = null;
        
        $info['chart']['series'][0]['name'] = 'Sales';
        $info['chart']['series'][0]['data'] = Array(2, 3, null, 4, 1, 5, 1, 4, 6, 3, 5, 2);

        
        return $info;
        
    }
    
    
    private function sample(){
        
        $info['chart']['chart']['type'] = 'pie';
        $info['chart']['chart']['plotBackgroundColor'] = null;
        $info['chart']['chart']['plotBorderWidth'] = null;
        $info['chart']['chart']['plotShadow'] = false;
        
        $info['chart']['chart']['options3d']['enabled'] = true;
        $info['chart']['chart']['options3d']['alpha'] = 10;
        $info['chart']['chart']['options3d']['beta'] = 25;
        $info['chart']['chart']['options3d']['depth'] = 70;
        
    }
    
    
    
}
?>

