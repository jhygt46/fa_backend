<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<script>

    showchart('chart1', 'sample1');
    showchart('chart2', 'sample2');
    showchart('chart3', 'sample3');
    showchart('chart4', 'sample4');

</script>
<style>
    .charts{
        width: 50%;
        height: 350px;
        float: left;
    }
    .charts .chart{
        width: 500px;
        height: 290px;
        margin: 25px auto;
        background: #eee;
        padding: 5px 0px;
    }
</style>
<div class="clearfix">
    <div class="charts"><div id="chart1" class="chart"></div></div>
    <div class="charts"><div id="chart2" class="chart"></div></div>
    <div class="charts"><div id="chart3" class="chart"></div></div>
    <div class="charts"><div id="chart4" class="chart"></div></div>
</div>