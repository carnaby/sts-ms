<h3>Strings</h3>

<p><strong>The String:</strong></p>
<?php
$text = '         How can a clam cram in a clean cream can?    ';
echo($text);
?>

<p><strong>Number of Characters:</strong></p>
<p><?php echo(strlen($text)); ?></p>

<p><strong>Trimming Up:</strong></p>
<p><?php 
	$text = trim($text);
	echo(strlen($text));
?></p>

<p><strong>UPPER CASE:</strong></p>
<p><?php echo(strtoupper($text)); ?></p>

<p><strong>lower case:</strong></p>
<p><?php echo(strtolower($text)); ?></p>

<p><strong>Replacing Text:</strong></p>
<p>
	<?php
		$text = str_replace('can', 'could', $text);
		echo $text;
	?>
</p>

<p><strong>Substrings:</strong></p>
<p><?php echo(substr($text, 2, 6)); ?></p>

<p><strong>Locating Substrings:</strong></p>
<p>'Can': <?php var_dump(strpos($text, 'can')); ?></p>
<p>'Could': <?php var_dump(strpos($text, 'could')); ?></p>
