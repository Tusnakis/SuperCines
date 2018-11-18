<?php

include('tcpdf/config/tcpdf_config.php');
include('tcpdf/tcpdf.php');

$documento = new TCPDF();

$documento->setPrintHeader(false);
$documento->setPrintFooter(false);
$documento->SetTitle("Ticket Super Cines");
$documento->AddPage();

$html = '
<img src="imagenes/ticket1.png"/>
<br>
<table style="border: 1px solid black;" width="55.5%">
<tr>
<td style="border: 1px solid black;"><b>PELÍCULA</b></td>
<td style="border: 1px solid black;">' . $_GET["titulo"] . '</td>
</tr>
<tr>
<td style="border: 1px solid black;"><b>FILA</b></td>
<td style="border: 1px solid black;">' . $_GET["fila"] . '</td>
</tr>
<tr>
<td style="border: 1px solid black;"><b>BUTACA</b></td>
<td style="border: 1px solid black;">' . $_GET["silla"] . '</td>
</tr>
<tr>
<td colspan="2" style="border: 1px solid black;">Presente esta entrada en la taquilla</td>
</tr>
</table>
<br>
<img src="imagenes/ticket2.png"/>
';

$documento->WriteHTML($html, true, false, true, false, '');

$documento->Output("ticket.pdf","D");

?>