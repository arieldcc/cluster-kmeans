<?php

include "jpgraph-4.2.6/src/jpgraph.php";
include "jpgraph-4.2.6/src/jpgraph_scatter.php";	
	
include "titik.php";


include "centroid.php";
 
$graph = new Graph(1000,800);
$graph->SetScale("linlin");
 
$graph->img->SetMargin(40,40,40,40);        
$graph->SetShadow();
 
$graph->title->Set("Biru : C1 , Merah : C2, Kuning : C3 | Biru  : Laris, Merah : Kurang Laris , Kuning : Tidak Laris");
$graph->title->SetFont(FF_FONT1,FS_BOLD);
 
$sp2 = new ScatterPlot($datay,$datax);
$sp2->mark->SetFillColor("blue");
$sp2->mark->SetWidth(8);

$sp1 = new ScatterPlot($daty,$datx); 
$sp1->mark->SetFillColor("red");
$sp1->mark->SetWidth(8);

$sp3 = new ScatterPlot($datyz,$datxz);
$sp3->mark->SetFillColor("yellow");
$sp3->mark->SetWidth(8);
 
$graph->Add($sp3);
$graph->Add($sp2);
$graph->Add($sp1);
$graph->Stroke();
?>