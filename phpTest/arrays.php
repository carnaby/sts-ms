<h3>Arrays</h3>

<p><strong>Arrays = Lists + Maps</strong></p>
<pre>
	<?php
		$empty1 = [];
		$empty2 = array();
		$names1 = ['Harry', 'Ron', 'Hermione'];
		$names2 = array('Harry', 'Ron', 'Hermione');

		var_dump($names1);
		var_dump($names2);
	?>

	<?php
		$status1 = [
			'name' => 'James Potter',
			'status' => 'dead'
		];
		$status2 = array(
			'name' => 'James Potter',
			'status' => 'dead'
		);

		var_dump($status1);
		var_dump($status2);
	?>

</pre>

<p><strong>Populating Arrays</strong></p>
<pre>
	<?php
		// We'll just use the [] notation from now on since it's my favorite
		$names1[] = 'Neville';
		$status1['age'] = 32;
		
		var_dump($names1);
		var_dump($status1);
	?>
</pre>

<p><strong>Accessing Arrays</strong></p>
<pre>
	<?php
		$names = ['Harry', 'Ron', 'Hermione'];
		$names['badguy'] = 'Voldemort';
		$names[8] = 'Snape';
		$names[] = 'McGonagall';

		var_dump($names);
	?>
</pre>

<p><strong>Empty && Isset</strong></p>
<pre>
	<?php
		$string = '';
		$empty_array = [];
	?>
	<p>Is $string empty? <?php var_dump(empty($string)); ?></p>
	<p>Is $array empty? <?php var_dump(empty($array)); ?></p>
	<p>Is $names empty? <?php var_dump(empty($names)); ?></p>

	<p>Is $names[2] set? <?php var_dump(isset($names[2])); ?></p>
	<p>Is $names[3] set? <?php var_dump(isset($names[3])); ?></p>
</pre>

<p><strong>Searching for Array Elements</strong></p>
<pre>
	<?php
		$more_names = ['Harry', 'Ron', 'Hermione'];
		$contains_Hermione = in_array('Hermione', $more_names);
		$where_is_Hermione = array_search('Hermione', $more_names);
	?>

	<p>Is 'Hermione' in our array? <?php var_dump($contains_Hermione); ?></p>
	<p>WHERE is 'Hermione' in our array? <?php var_dump($where_is_Hermione); ?></p>
	<p>It's important to note that while the array_search method is functionally more useful, it is a lot more resource intensive, so only use it if you have to!</p>

</pre>
