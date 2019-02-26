<p>Your Workflow</p>
<?php
var_dump($this->user->info);

$query = $this->db->get('users');
foreach ($query->result() as $row)
{
        echo $row->title;
}
?>

