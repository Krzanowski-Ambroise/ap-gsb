<table>
  <tr>
    <th><?= __('Mr.X')?></th>
    <td><?= $sheet->doctor ?></td>
  </tr>
</table>
<?php 
foreach($sheets as $sheet){
  echo $sheet;
}
?>